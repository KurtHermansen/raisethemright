<?php
// HomeController.php

require_once __DIR__ . '/../models/QuoteModel.php';


class HomeController
{
    private $quoteModel;

    public function __construct($pdo)
    {
        $this->quoteModel = new QuoteModel($pdo);
    }

    private function checkAccess() {

        // Check if the user is logged in and has paid
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || 
            !isset($_SESSION['has_paid']) || $_SESSION['has_paid'] !== true) {
            header('Location: /rthemr/login-user');
            exit;
        }
    }
    //Display the Welcome page
    public function welcome($request, $response, $args)
    {
        $this->checkAccess();
        $quote = $this->quoteModel->getRandomQuote();
        if ($quote) {
            $jsonQuote = json_encode($quote);
            echo "<script>console.log('DB Result: ', $jsonQuote);</script>";
        }

        ob_start();
        include __DIR__ . '/../views/welcome.php'; // Adjust path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    //Display the Success page
    public function success($request, $response, $args)
    {
        $this->checkAccess();
        $quote = $this->quoteModel->getRandomQuote();
        if ($quote) {
            $jsonQuote = json_encode($quote);
            echo "<script>console.log('DB Result: ', $jsonQuote);</script>";
        }

        ob_start();
        include __DIR__ . '/../views/success.php'; // Adjust path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Display the home page
    public function index($request, $response, $args)
    {
        ob_start();
        include __DIR__ . '/../views/home.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Display the about page
    public function about($request, $response, $args)
    {
        ob_start();
        include __DIR__ . '/../views/about.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Display the contact page
    public function contact($request, $response, $args)
    {
        ob_start();
        include __DIR__ . '/../views/contact.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Additional methods for other static pages can be added here
}
