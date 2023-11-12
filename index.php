<?php

require_once 'vendor/autoload.php';

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

$checkUserMiddleware = function (Request $request, $handler) use ($pdo) {
    // Start session if not started
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Assume a default value (e.g., not logged in, not paid)
    $_SESSION['logged_in'] = false;
    $_SESSION['has_paid'] = false;

    // Here, for the sake of example, I'll assume you're getting a username from the request or session.
    // Modify as needed based on where you store the username when the user logs in.
    $username = $_SESSION['username'] ?? null;

    if ($username) {

        $sql = 'SELECT paid FROM user WHERE username = :username LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['logged_in'] = true;
            $_SESSION['has_paid'] = (bool) $user['paid'];
        }
    }

    return $handler->handle($request);
};


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

// foundations Us page route
$app->get('/foundations', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/foundations.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
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

// Sign Up page route
$app->get('/signup', function (Request $request, Response $response, array $args) {
    ob_start();
    include __DIR__ . '../app/views/signup.php';
    $output = ob_get_clean();
    $response->getBody()->write($output);
    return $response;
});

// Test route remains unchanged as it doesn't use an external file.
$app->get('/test', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Test route");
    return $response;
});



$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->run();
