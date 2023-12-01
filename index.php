<?php
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

// Get the database connection file
require_once __DIR__ . '/config/connection.php';

require_once __DIR__ . '/app/controllers/CommentController.php';
require_once __DIR__ . '/app/controllers/ForumController.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/VideoController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/StripeController.php';


require_once __DIR__ . '/app/models/CommentModel.php';
require_once __DIR__ . '/app/models/ForumModel.php';
require_once __DIR__ . '/app/models/UserModel.php';
require_once __DIR__ . '/app/models/VideoModel.php';


use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

// Define session middleware
$sessionMiddleware = function (Request $request, $handler) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    return $handler->handle($request);
};


$app = AppFactory::create();
$app->setBasePath('/rthemr');

// Add session middleware to the app
$app->add($sessionMiddleware);

// Establish database connection
$pdo = createConnection(); // Ensure this function properly sets up your PDO connection

// Instantiate controllers with dependencies
$homeController = new HomeController($pdo);
$forumController = new ForumController($pdo);
$commentController = new CommentController($pdo);
$videoController = new VideoController($pdo);
$userController = new UserController($pdo);
$stripeController = new StripeController($pdo);

// Define routes
// Home routes
$app->get('/', [$homeController, 'index']);
$app->get('/about', [$homeController, 'about']);
// $app->get('/services', [$homeController, 'services']);
$app->get('/contact', [$homeController, 'contact']);
$app->get('/welcome', [$homeController, 'welcome']);
$app->get('/success', [$homeController, 'success']);

//Video Routes
$app->get('/values', [$videoController, 'listValueVideos']);
$app->get('/principles', [$videoController, 'listPrincipleVideos']);
$app->get('/character', [$videoController, 'listCharacterVideos']);
$app->get('/video/{videoID}', [$videoController, 'showVideo']);

//User Routes
$app->get('/signup', [$userController, 'showSignup']);
$app->get('/login-user', [$userController, 'showLogin']);
$app->post('/login-user', [$userController, 'loginUser']);
$app->post('/signup', [$userController, 'registerUser']);
$app->get('/logout', [$userController, 'logout']);

//Google Route (in UserController.php)
$app->get('/login', [$userController, 'redirectToGoogleAuth']);
$app->get('/oauth2callback', [$userController, 'googleAuthCallback']);

// Forum routes
$app->get('/forum', [$forumController, 'listForums']);
$app->get('/forum/{forumID}', [$forumController, 'showForum']);
$app->post('/submit-forumcomment', [$forumController, 'submitForumComment']);

// Comment routes (example for video comments)
$app->post('/submit-videocomment', [$commentController, 'submitVideoComment']);

//stripe, if used..
$app->post('/stripe-webhook', 'StripeController:stripeWebhook');
// Run the app
$app->run();

$pdo = createConnection();

