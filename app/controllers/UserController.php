<?php
// UserController.php

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/QuoteModel.php';

class UserController {
    private $userModel;
    private $quoteModel;
    private $googleClient;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
        $this->quoteModel = new QuoteModel($pdo);
        $this->googleClient = $this->createGoogleClient();
    }
    
    private function createGoogleClient() {
        $client = new \Google_Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->addScope("email");
        $client->addScope("profile");
    
        return $client;
    }
    

    // Show the Sign Up page
    public function showSignup($request, $response, $args)
    {
        ob_start();
        include __DIR__ . '/../views/signup.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Show the Login page
    public function showLogin($request, $response, $args)
    {
        ob_start();
        include __DIR__ . '/../views/login_user.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Handle user registration
    public function registerUser($request, $response, $args)
    {
        $data = $request->getParsedBody();

        $fname = filter_var($data['fname'] ?? '', FILTER_SANITIZE_STRING);
        $lname = filter_var($data['lname'] ?? '', FILTER_SANITIZE_STRING);
        $username = filter_var($data['username'] ?? '', FILTER_SANITIZE_STRING);
        $email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = filter_var($data['password'] ?? '', FILTER_SANITIZE_STRING);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Perform additional validation as needed

        if ($this->userModel->emailExists($email)) {
            // Handle case where email already exists
            return $response->withHeader('Location', '/rthemr/login-user')->withStatus(302);
        }

        $userID = $this->userModel->register($fname, $lname, $username, $email, $hashed_password);

        if ($userID) {
            // Correct password or Google user
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['userID'] = $userID;
            $_SESSION['logged_in'] = true;
            $_SESSION['has_paid'] = true;
            // ... other session variables as needed

            return $response->withHeader('Location', '/rthemr/success')->withStatus(302);
        } else {
            // Handle registration error
            return $response->withStatus(500);
        }
    }

    // Handle user login
    public function loginUser($request, $response, $args)
    {
        $data = $request->getParsedBody();

        $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $data['password'] ?? '';

        $userID = $this->userModel->authenticate($email, $password);

        if ($userID) {
            // Correct password or Google user
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            $_SESSION['userID'] = $userID;
            $_SESSION['logged_in'] = true;
            $_SESSION['has_paid'] = true;
            // ... other session variables as needed

            return $response->withHeader('Location', '/rthemr/welcome')->withStatus(302);

        } else {
            return $response->withHeader('Location', '/rthemr/login-user')->withStatus(401); // Unauthorized
        }
    }

    public function redirectToGoogleAuth($request, $response, $args) {
        $authUrl = $this->googleClient->createAuthUrl();
        return $response->withHeader('Location', $authUrl)->withStatus(302);
    }

    public function googleAuthCallback($request, $response, $args) {
        $client = $this->createGoogleClient(); 
        $code = $request->getQueryParams()['code'] ?? null;

        if ($code) {
            try {
                // Fetch and validate access token
                $token = $client->fetchAccessTokenWithAuthCode($code);
                if (!$token || isset($token['error'])) {
                    throw new Exception('Error fetching access token');
                }
                $client->setAccessToken($token);

                // Fetch user information
                $google_oauth = new Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
                $email = $google_account_info->email;
                $name = $google_account_info->name;
                if (!$email) {
                    throw new Exception('Invalid email address from Google.');
                }

                // Split name into first and last name
                $names = explode(' ', $name, 2);
                $fname = $names[0] ?? '';
                $lname = $names[1] ?? '';

                // Check if user exists in the database
                if ($this->userModel->emailExists($email)) {
                    // Existing user - log in
                    $userID = $this->userModel->authenticate($email, ''); // Password is not needed for Google users
                } else {
                    // New user - register
                    $username = $email; // or generate based on the name or email
                    $userID = $this->userModel->register($fname, $lname, $username, $email, null); // Password is null for Google users
                }

                // Start or resume a session
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }

                // Session variable settings based on whether the user is new or existing

                $_SESSION['userID'] = $userID;
                $_SESSION['logged_in'] = true;
                $_SESSION['has_paid'] = true;

                // Redirect to a success page
                return $response->withHeader('Location', '/rthemr/success')->withStatus(302);
            } catch (Exception $e) {
                // Handle exceptions more thoroughly
                $error_message = 'Error: ' . $e->getMessage();
                error_log($error_message); // Log the error
                $response->getBody()->write($error_message);
                return $response->withStatus(500);
            }
        } else {
            // Redirect to login if no code provided
            return $response->withHeader('Location', '/rthemr/login')->withStatus(302);
        }
    }

    public function logout($request, $response, $args)
    {
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
    }

    // Additional methods as necessary
}
