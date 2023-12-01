<?php
// ForumController.php

require_once __DIR__ . '/../models/ForumModel.php';
require_once __DIR__ . '/../models/QuoteModel.php';

class ForumController {
    private $forumModel;
    private $quoteModel;

    public function __construct($pdo) {
        $this->quoteModel = new QuoteModel($pdo);
        $this->forumModel = new ForumModel($pdo);
    }
    private function checkAccess() {

        // Check if the user is logged in and has paid
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || 
            !isset($_SESSION['has_paid']) || $_SESSION['has_paid'] !== true) {
            header('Location: /rthemr/login-user');
            exit;
        }
    }

    // List all forum topics
    public function listForums($request, $response, $args) {
        $this->checkAccess();
        $quote = $this->quoteModel->getRandomQuote();
        if ($quote) {
            $jsonQuote = json_encode($quote);
            echo "<script>console.log('DB Result: ', $jsonQuote);</script>";
        }

        $forumTopics = $this->forumModel->getForumTopics();
        ob_start();
        include __DIR__ . '/../views/forum.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Display a specific forum topic and its comments
    public function showForum($request, $response, $args) {
        $this->checkAccess();
        $quote = $this->quoteModel->getRandomQuote();
        if ($quote) {
            $jsonQuote = json_encode($quote);
            echo "<script>console.log('DB Result: ', $jsonQuote);</script>";
        }

        $forumID = $args['forumID'];
        $forumTopic = $this->forumModel->getForumTopic($forumID);
        $comments = $this->forumModel->getForumComments($forumID);

        if (!$forumTopic) {
            // Handle case where forum topic is not found
            $response->getBody()->write("Forum topic not found");
            return $response->withStatus(404);
        }

        ob_start();
        include __DIR__ . '/../views/forum_detail.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);
        return $response;
    }

    // Handle submission of a new forum comment
    public function submitForumComment($request, $response, $args) {
        $this->checkAccess();
        $data = $request->getParsedBody();
        $commentText = filter_var($data['commentText'], FILTER_SANITIZE_STRING);
        $userID = $_SESSION['userID']; // Ensure session is started and userID is set
        $forumID = filter_var($data['forumID'], FILTER_SANITIZE_NUMBER_INT);

        $this->forumModel->addForumComment($commentText, $userID, $forumID);

        // Redirect back to the forum topic detail page
        return $response->withHeader('Location', '/rthemr/forum/' . $forumID)->withStatus(302);
    }

    // Additional methods for other forum actions can be added here
}
