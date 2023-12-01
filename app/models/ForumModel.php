<?php
// ForumModel.php

class ForumModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all forum topics
    public function getForumTopics() {
        $sql = "SELECT * FROM forum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific forum topic by ID
    public function getForumTopic($forumID) {
        $sql = "SELECT * FROM forum WHERE forumID = :forumID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':forumID', $forumID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get comments for a specific forum topic
    public function getForumComments($forumID) {
        $sql = "SELECT fc.forumcommentText, u.username 
                FROM forumcomments fc 
                JOIN user u ON fc.userID = u.userID 
                WHERE fc.forumID = :forumID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':forumID', $forumID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new comment to a forum topic
    public function addForumComment($commentText, $userID, $forumID) {
        $sql = "INSERT INTO forumcomments (forumcommentText, userID, forumID) 
                VALUES (:commentText, :userID, :forumID)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':commentText', $commentText);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':forumID', $forumID, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Additional methods for other forum data operations can be added here
}
