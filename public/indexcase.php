<?php
// This is the main controller

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/rthemr/config/connection.php';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){
    case 'template':
        include 'app/views/template.php';     
     break;    
    default:
     include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/home.php';
   }

   unset($_SESSION['message']);