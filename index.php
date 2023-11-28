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




try {
    $stmt = $pdo->query("SELECT quote, author FROM quotes ORDER BY RAND() LIMIT 1");
    $quote = $stmt->fetch(PDO::FETCH_ASSOC);

    // Convert the result to JSON
    $jsonQuote = json_encode($quote);

    // Print a script tag to log this in the console
    echo "<script>console.log('DB Result: ', $jsonQuote);</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    // Optionally, log the error in the console as well
    $errorMessage = json_encode($e->getMessage());
    echo "<script>console.log('DB Error: ', $errorMessage);</script>";
}


// Define session middleware
$sessionMiddleware = function (Request $request, $handler) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    return $handler->handle($request);
};


// Add session middleware to the app
$app->add($sessionMiddleware);


// Home page route
$app->get('/', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/home.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// About Us page route
$app->get('/about', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/about.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// welcome page route
$app->get('/welcome', function (Request $request, Response $response, array $args) use ($quote) { // Use the $quote variable here
    ob_start();
    // Make $quote available in the scope of this callback
    include __DIR__ . '../app/views/welcome.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->get('/forum', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    // SQL to fetch forum topics from the database
    $sql = "SELECT * FROM forum";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $forumTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start output buffering
    ob_start();

    // Include the forum view file here
    include __DIR__ . '../app/views/forum.php';

    // Get the contents of the buffer and write them to the response
    $output = ob_get_clean();
    $response->getBody()->write($output);

    return $response;
});

$app->get('/forum/{forumID}', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    $forumID = $args['forumID'];

    // Fetch forum topic details from database
    $forumSql = "SELECT * FROM forum WHERE forumID = :forumID";
    $forumStmt = $pdo->prepare($forumSql);
    $forumStmt->bindParam(':forumID', $forumID, PDO::PARAM_INT);
    $forumStmt->execute();
    $forumTopic = $forumStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch comments for the current forum topic
    $commentSql = "SELECT fc.forumcommentText, u.username FROM forumcomments fc JOIN user u ON fc.userID = u.userID WHERE fc.forumID = :forumID";
    $commentStmt = $pdo->prepare($commentSql);
    $commentStmt->bindParam(':forumID', $forumID, PDO::PARAM_INT);
    $commentStmt->execute();
    $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$forumTopic) {
        // Handle case where forum topic is not found
        $response->getBody()->write("Forum topic not found");
        return $response->withStatus(404);
    }

    // Render detailed forum page
    ob_start();
    include __DIR__ . '../app/views/forum_detail.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->post('/submit-forumcomment', function (Request $request, Response $response, array $args) use ($pdo) {
    $data = $request->getParsedBody();

    $commentText = filter_var($data['commentText'], FILTER_SANITIZE_STRING);
    $userID = $_SESSION['userID'];
    $forumID = filter_var($data['forumID'], FILTER_SANITIZE_NUMBER_INT);

    // Insert comment into the database
    $sql = "INSERT INTO forumcomments (forumcommentText, userID, forumID) VALUES (:commentText, :userID, :forumID)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':commentText', $commentText);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':forumID', $forumID);
    $stmt->execute();

    // Redirect back to the forum topic detail page
    return $response->withHeader('Location', '/rthemr/forum/' . $forumID)->withStatus(302);
});




// Services page route
$app->get('/services', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/service.php';  // Note: you've named your file `service.php`
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// Contact page route
$app->get('/contact', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/contact.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});
$app->get('/values', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    $category = 'values'; // This should match the ID of your <a> tag

    // SQL to fetch videos from the database
    $sql = "SELECT * FROM video WHERE category = :category";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start output buffering
    ob_start();

    // Include your view file here, where you will loop through the videos and display them
    include __DIR__ . '../app/views/value_videos.php';

    // Get the contents of the buffer and write them to the response
    $output = ob_get_clean();
    $response->getBody()->write($output);

    return $response;
});
$app->get('/principles', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    $category = 'principles'; // This should match the ID of your <a> tag

    // SQL to fetch videos from the database
    $sql = "SELECT * FROM video WHERE category = :category";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start output buffering
    ob_start();

    // Include your view file here, where you will loop through the videos and display them
    include __DIR__ . '../app/views/principle_videos.php';

    // Get the contents of the buffer and write them to the response
    $output = ob_get_clean();
    $response->getBody()->write($output);

    return $response;
});

$app->get('/character', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    $category = 'character'; // This should match the ID of your <a> tag

    // SQL to fetch videos from the database
    $sql = "SELECT * FROM video WHERE category = :category";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start output buffering
    ob_start();

    // Include your view file here, where you will loop through the videos and display them
    include __DIR__ . '../app/views/character_videos.php';

    // Get the contents of the buffer and write them to the response
    $output = ob_get_clean();
    $response->getBody()->write($output);

    return $response;
});

$app->get('/video/{videoID}', function (Request $request, Response $response, array $args) use ($pdo, $quote) {
    $videoID = $args['videoID'];

    // Fetch video details from database
    $videoSql = "SELECT * FROM video WHERE videoID = :videoID";
    $videoStmt = $pdo->prepare($videoSql);
    $videoStmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
    $videoStmt->execute();
    $video = $videoStmt->fetch(PDO::FETCH_ASSOC);

    if (!$video) {
        // Handle case where video is not found
        $response->getBody()->write("Video not found");
        return $response->withStatus(404);
    }

    // Fetch related videos
    $currentCategory = $video['category'];
    $relatedVideosSql = "SELECT * FROM video WHERE category = :category AND videoID != :videoID LIMIT 5";
    $relatedVideosStmt = $pdo->prepare($relatedVideosSql);
    $relatedVideosStmt->bindParam(':category', $currentCategory, PDO::PARAM_STR);
    $relatedVideosStmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
    $relatedVideosStmt->execute();
    $relatedVideos = $relatedVideosStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch comments for the current video
    $commentSql = "SELECT c.commentText, u.username FROM comments c JOIN user u ON c.userID = u.userID WHERE c.videoID = :videoID";
    $commentStmt = $pdo->prepare($commentSql);
    $commentStmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
    $commentStmt->execute();
    $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

    // Render detailed video page
    ob_start();
    include __DIR__ . '../app/views/video_detail.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->post('/submit-comment', function (Request $request, Response $response, array $args) use ($pdo) {
    $data = $request->getParsedBody();

    $commentText = filter_var($data['commentText'], FILTER_SANITIZE_STRING);
    $userID = $_SESSION['userID'];
    $videoID = filter_var($data['videoID'], FILTER_SANITIZE_NUMBER_INT);

    // Insert comment into database
    $sql = "INSERT INTO comments (commentText, userID, videoID) VALUES (:commentText, :userID, :videoID)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':commentText', $commentText);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':videoID', $videoID);
    $stmt->execute();

    // Redirect back to the video detail page
    return $response->withHeader('Location', '/rthemr/video/' . $videoID)->withStatus(302);
});




// success page route
$app->get('/success', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/success.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// Sign Up page route
$app->get('/signup', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/signup.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// Login User page route
$app->get('/login-user', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/login_user.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

$app->post('/login-user', function (Request $request, Response $response, array $args) use ($pdo) {
    $data = $request->getParsedBody();

    $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $data['password'] ?? '';

    // Check if the email exists in the database
    $sql = 'SELECT userID, password FROM user WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, now check if the password matches or if it's a Google user
        if (password_verify($password, $user['password']) || $user['password'] === null) {
            // Correct password or Google user
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['logged_in'] = true;
            $_SESSION['has_paid'] = true;

            // Redirect to a success page or user dashboard
            return $response->withHeader('Location', '/rthemr/welcome')->withStatus(302);
        } else {
            // Invalid password
            return $response->withHeader('Location', '/rthemr/login-user')->withStatus(401); // Unauthorized
        }
    } else {
        // User not found
        return $response->withHeader('Location', '/rthemr/login-user')->withStatus(401); // Unauthorized
    }
});


$app->post('/signup', function (Request $request, Response $response, array $args) use ($pdo) {


    // Extract form data from request
    $postData = $request->getParsedBody();

    $fname = filter_var($postData['fname'] ?? '', FILTER_SANITIZE_STRING);
    $lname = filter_var($postData['lname'] ?? '', FILTER_SANITIZE_STRING);
    $username = filter_var($postData['username'] ?? '', FILTER_SANITIZE_STRING);
    $password = filter_var($postData['password'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($postData['email'] ?? '', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        // Handle invalid email
        $response->getBody()->write('Invalid email address.');
        return $response->withStatus(400); // Bad request
    }
    // Check if the email already exists in the database
    $emailCheckSql = 'SELECT email FROM user WHERE email = :email';
    $emailCheckStmt = $pdo->prepare($emailCheckSql);
    $emailCheckStmt->bindParam(':email', $email);
    $emailCheckStmt->execute();

    if ($emailCheckStmt->fetch()) {
        // Email already exists, handle this case
        return $response->withHeader('Location', '/rthemr/login-user')->withStatus(302);
    }

    if (strlen($password) < 8) {
        // Handle short password
        $response->getBody()->write('Password must be at least 8 characters.');
        return $response->withStatus(400); // Bad request
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = 'INSERT INTO user (fname, lname, username, password, email, login) VALUES (:fname, :lname, :username, :password, :email, 1)';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $userID = $pdo->lastInsertId(); // Get the last inserted user ID

        // Start session and set session variables after successful registration
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['userID'] = $userID;
        $_SESSION['logged_in'] = 1;
        $_SESSION['has_paid'] = 1;
        echo '<pre>' . print_r($_SESSION, true) . '</pre>';

        // Redirect to a success page or login page
        return $response->withHeader('Location', '/rthemr/success')->withStatus(302);
    } catch (PDOException $e) {
        // Handle SQL error
        $response->getBody()->write("Error: " . $e->getMessage());
        return $response->withStatus(500); // Internal server error
    }
});
// Test route remains unchanged as it doesn't use an external file.
$app->get('/test', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Test route");
    return $response;
});

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



            // Implement your session logic here

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
