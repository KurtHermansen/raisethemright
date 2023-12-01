<?php
// UserModel.php

class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    

    // Authenticate a user
    public function authenticate($email, $password) {

        $sql = 'SELECT userID, password FROM user WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $isPasswordCorrect = password_verify($password, $user['password']);
            error_log('Password verification result: ' . $isPasswordCorrect);
            if ($isPasswordCorrect || $user['password'] === null) {
                return $user['userID'];
            }else{
                return false;
            }
        }
        return false; // Authentication failed
    }

    // Register a new user
    public function register($fname, $lname, $username, $email, $password) {

        $sql = 'INSERT INTO user (fname, lname, username, password, email, login) VALUES (:fname, :lname, :username, :password, :email, 1)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        return $this->pdo->lastInsertId(); // Return the ID of the newly created user
    }

    // Check if email exists for a user
    public function emailExists($email) {
        $sql = 'SELECT email FROM user WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            return true; // Email exists
        }

        return false; // Email does not exist
    }
    //Stripe user update.
    public function setUserAsPaid($email) {
        $sql = "UPDATE user SET paid = 1 WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Additional methods for other user operations can be added here
}
