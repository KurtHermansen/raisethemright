<?php
// VideoController.php

require_once __DIR__ . '/../models/VideoModel.php';
require_once __DIR__ . '/../models/QuoteModel.php';

class VideoController
{
    private $videoModel;
    private $quoteModel;

    public function __construct($pdo)
    {
        $this->quoteModel = new QuoteModel($pdo);
        $this->videoModel = new VideoModel($pdo);
    }
    private function checkAccess() {
        // Check if the user is logged in and has paid
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || 
            !isset($_SESSION['has_paid']) || $_SESSION['has_paid'] !== true) {
            header('Location: /rthemr/login-user');
            exit;
        }
    }

    // List videos by category
    public function listValueVideos($request, $response, $args)
    {
        $this->checkAccess();
        $category = 'values'; // Get the category from route parameters
        $videos = $this->videoModel->getVideosByCategory($category);
        $quote = $this->quoteModel->getRandomQuote(); // If you're including a random quote

        ob_start();
        include __DIR__ . '/../views/' . $category . '_videos.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);

        return $response;
    }
    // List videos by category
    public function listPrincipleVideos($request, $response, $args)
    {
        $this->checkAccess();
        $category = 'principles'; // Get the category from route parameters
        $videos = $this->videoModel->getVideosByCategory($category);
        $quote = $this->quoteModel->getRandomQuote(); // If you're including a random quote

        ob_start();
        include __DIR__ . '/../views/' . $category . '_videos.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);

        return $response;
    }
    // List videos by category
    public function listCharacterVideos($request, $response, $args)
    {
        $this->checkAccess();
        $category = 'character'; // Get the category from route parameters
        $videos = $this->videoModel->getVideosByCategory($category);
        $quote = $this->quoteModel->getRandomQuote(); // If you're including a random quote

        ob_start();
        include __DIR__ . '/../views/' . $category . '_videos.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);

        return $response;
    }


    // Show a specific video
    public function showVideo($request, $response, $args)
    {
        $this->checkAccess();
        $videoID = $args['videoID'];
        $video = $this->videoModel->getVideoDetails($videoID);
        $relatedVideos = $this->videoModel->getRelatedVideos($video['category'], $videoID);
        $comments = $this->videoModel->getVideoComments($videoID);
        $quote = $this->quoteModel->getRandomQuote(); // If you're including a random quote

        if (!$video) {
            $response->getBody()->write("Video not found");
            return $response->withStatus(404);
        }

        ob_start();
        include __DIR__ . '/../views/video_detail.php'; // Adjust the path as necessary
        $output = ob_get_clean();
        $response->getBody()->write($output);

        return $response;
    }

    // Additional methods as necessary
}
