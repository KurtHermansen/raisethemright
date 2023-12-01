<?php
// VideoModel.php

class VideoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get videos by category
    public function getVideosByCategory($category) {
        $sql = "SELECT * FROM video WHERE category = :category";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific video by ID
    public function getVideoDetails($videoID) {
        $sql = "SELECT * FROM video WHERE videoID = :videoID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get related videos excluding the current one
    public function getRelatedVideos($category, $excludeVideoID) {
        $sql = "SELECT * FROM video WHERE category = :category AND videoID != :videoID LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':videoID', $excludeVideoID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get comments for a specific video
    public function getVideoComments($videoID) {
        $sql = "SELECT c.commentText, u.username FROM comments c JOIN user u ON c.userID = u.userID WHERE c.videoID = :videoID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Additional methods as necessary
}
