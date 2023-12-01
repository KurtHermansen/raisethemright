<?php
// QuoteModel.php

class QuoteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRandomQuote() {
        try {
            $stmt = $this->pdo->query("SELECT quote, author FROM quotes ORDER BY RAND() LIMIT 1");
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle exception or log error
            return null;
        }
    }
}
