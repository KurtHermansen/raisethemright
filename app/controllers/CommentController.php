<?php
// CommentController.php

require_once __DIR__ . '/../models/CommentModel.php';

class CommentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new CommentModel($pdo);
    }
    private function checkAccess() {
        // Check if the user is logged in and has paid
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || 
            !isset($_SESSION['has_paid']) || $_SESSION['has_paid'] !== true) {
            header('Location: /rthemr/login-user');
            exit;
        }
    }

    // Submit a comment on a forum topic
    public function submitForumComment($request, $response, $args) {
        $this->checkAccess();
        $data = $request->getParsedBody();
        $commentText = filter_var($data['commentText'], FILTER_SANITIZE_STRING);
        $userID = $_SESSION['userID']; // Ensure the user is logged in and session is started
        $forumID = filter_var($data['forumID'], FILTER_SANITIZE_NUMBER_INT);

        $this->model->addForumComment($commentText, $userID, $forumID);

        // Redirect back to the forum detail page
        return $response->withHeader('Location', '/rthemr/forum/' . $forumID)->withStatus(302);
    }

    // Submit a comment on a video
    public function submitVideoComment($request, $response, $args) {
        $this->checkAccess();
        $data = $request->getParsedBody();
        $commentText = filter_var($data['commentText'], FILTER_SANITIZE_STRING);
        $userID = $_SESSION['userID']; // Ensure the user is logged in and session is started
        $videoID = filter_var($data['videoID'], FILTER_SANITIZE_NUMBER_INT);

        $this->model->addVideoComment($commentText, $userID, $videoID);

        // Redirect back to the video detail page
        return $response->withHeader('Location', '/rthemr/video/' . $videoID)->withStatus(302);
    }

    // Additional methods for other comment actions can be added here
}
