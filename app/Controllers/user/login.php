<?php
require "../app/Models/user.php";


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usermodel = new userModel;

    if(!isset($_POST["username"]) || !isset($_POST["password"])){
        $errors[] = "All fields are required";
    }

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if(!Validator::String($username)){
        $errors[] = "Username is invalid";
    }

    if(!Validator::String($password)){
        $errors[] = "Password is invalid";
    }

    if(empty($errors)){
        $user = $usermodel->loginUser($username , $password);

        if($user != false){
            $_SESSION["user"] = $user;
            // Redirect after successful login
            header("Location: /project");
            exit; // Ensure that no other output interferes with the header redirect
        } else {
            $errors[] = "Invalid password";
        }
    }
}

// Load the login view file
$title = "Login";
require_once "../app/Views/user/login.view.php";
?>