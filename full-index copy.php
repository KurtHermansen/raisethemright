<?php

require_once 'vendor/autoload.php';

function getClient()
{
    $client = new Google_Client();
    $client->setClientId('526706136331-tmuipjhi7ejk4ubrjbm4icdf3nb60b2g.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/rthemr/oauth2callback');
    $client->addScope("email");
    $client->addScope("profile");

    return $client;
}

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/rthemr/config/connection.php';

$app = AppFactory::create();
$app->setBasePath('/rthemr');

$pdo = createConnection();






$app->get('/login', function (Request $request, Response $response, array $args) {
    $client = getClient();
    $authUrl = $client->createAuthUrl();
    return $response->withHeader('Location', $authUrl)->withStatus(302);
});

$app->get('/oauth2callback', function (Request $request, Response $response, array $args) {
    $client = getClient();
    $code = $request->getQueryParams()['code'] ?? null;

    if ($code) {
        try {
            $token = $client->fetchAccessTokenWithAuthCode($code);
            $client->setAccessToken($token);
            if (!$token || isset($token['error'])) {
                throw new Exception('Error fetching access token');
            }

            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;

            if (!$email) {
                throw new Exception('Invalid email address from Google.');
            }

            $pdo = createConnection();
            $sql = 'SELECT * FROM user WHERE email = :email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Existing user - Start a session
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['logged_in'] = true;
                $_SESSION['has_paid'] = true;

                // Optionally, update user's name if needed
                $updateSql = 'UPDATE user SET fname = :fname, lname = :lname WHERE email = :email';
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->bindParam(':fname', $fname);
                $updateStmt->bindParam(':lname', $lname);
                $updateStmt->bindParam(':email', $email);
                $updateStmt->execute();
            } else {
                // New user - Insert into database and start a session
                // Split name into first and last name
                $names = explode(' ', $name, 2);
                $fname = $names[0] ?? '';
                $lname = $names[1] ?? '';

                $pdo = createConnection();
                $sql = 'SELECT * FROM user WHERE email = :email';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $sql = 'UPDATE user SET fname = :fname, lname = :lname WHERE email = :email';
                } else {
                    $sql = 'INSERT INTO user (fname, lname, email, login) VALUES (:fname, :lname, :email, 1)';
                }

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':fname', $fname);
                $stmt->bindParam(':lname', $lname);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                // Existing user - Start a session
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['logged_in'] = true;
                $_SESSION['has_paid'] = true;
            }

            // Redirect to a success page or login page
            return $response->withHeader('Location', '/rthemr/success')->withStatus(302);
        } catch (Exception $e) {
            $response->getBody()->write('Error: ' . $e->getMessage());
            return $response;
        }
    }
});


$app->post('/stripe-webhook', function (Request $request, Response $response, array $args) use ($pdo) { // Make sure $pdo is accessible inside this function
    $payload = $request->getBody()->getContents();
    $endpoint_secret = 'your_stripe_endpoint_secret';
    $signature = $request->getHeaderLine('Stripe-Signature');

    try {
        $event = \Stripe\Webhook::constructEvent($payload, $signature, $endpoint_secret);

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                // Extract email from the session (assuming you have it as metadata)
                // You might need to adjust this based on how you store the email in the session
                $userEmail = $session->customer_email;

                if ($userEmail) {
                    $sql = "UPDATE user SET paid = 1 WHERE email = :email";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
                    $stmt->execute();
                }

                break;
                // ... handle other event types
        }

        return $response->withStatus(200);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        // Log the error and respond with an error status
        return $response->withStatus(400)->write("Invalid signature");
    } catch (\UnexpectedValueException $e) {
        // Log the error and respond with an error status
        return $response->withStatus(400)->write("Invalid payload");
    } catch (\PDOException $e) {
        // Handle database exceptions
        return $response->withStatus(500)->write("Database error: " . $e->getMessage());
    } catch (\Exception $e) {
        // Handle other exceptions
        return $response->withStatus(500)->write("Internal Server Error: " . $e->getMessage());
    }
});

$app->get('/logout', function (Request $request, Response $response, array $args) {
    // Start session if not already started
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Unset all session variables
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();

    // Redirect to home page
    return $response->withHeader('Location', '/rthemr')->withStatus(302);
});


$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->run();
