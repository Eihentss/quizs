<?php
require "../app/Models/user.php";


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usermodel = new userModel;

    if(!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["password"])){
        $errors[] = "All fields are required";
    }

    // Retrieve form data
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if(!Validator::Email($email)){
        $errors[] = "Email is not valid";
    }

    if(!Validator::Password($password)){
        $errors[] = "Password is not valid";
    }

    if(!Validator::String($username)){
        $errors[] = "Username is not valid";
    }

    if(!$usermodel->checkIfUserExsistsByUsername($username)){
        $errors[] = "User already exists with that username";
    }

    if(!$usermodel->checkIfUserExsistsByEmail($email)){
        $errors[] = "User already exists with that email";
    }

    if(empty($errors)){
        // Hash the password for security
        $password = password_hash($password, PASSWORD_DEFAULT);

        $return = $usermodel->createUser($email, $password, $username);
        header("Location: /user/login");
    }

}

$title = "Register";
require_once "../app/Views/user/register.view.php";
?>