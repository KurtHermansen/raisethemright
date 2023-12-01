<?php
// CommentModel.php

class CommentModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get comments for a specific video
    public function getVideoComments($videoID) {
        $sql = "SELECT c.commentText, u.username 
                FROM comments c 
                JOIN user u ON c.userID = u.userID 
                WHERE c.videoID = :videoID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new comment to a video
    public function addVideoComment($commentText, $userID, $videoID) {
        $sql = "INSERT INTO comments (commentText, userID, videoID) 
                VALUES (:commentText, :userID, :videoID)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':commentText', $commentText);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Additional methods for other comment data operations can be added here
}
