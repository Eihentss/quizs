<?php
require "../app/Models/user.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usermodel = new userModel;

    // Pārbauda, vai lietotājvārds un parole ir norādīti
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        $errors[] = "All fields are required";
    }

    // Attīra ievadītos datus
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Validē lietotājvārdu un paroli
    if (!Validator::String($username)) {
        $errors[] = "Username is invalid";
    }

    if (!Validator::String($password)) {
        $errors[] = "Password is invalid";
    }

    // Ja nav kļūdu, turpina ar autentifikāciju
    if (empty($errors)) {
        $user = $usermodel->loginUser($username, $password);

        if ($user != false) {
            // Saglabā lietotāja datus sesijā
            $_SESSION["user"] = [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'role' => $user['role'] // Saglabā arī lomu, ja tāda ir pieejama
            ];

            // Veiksmīgas pieteikšanās gadījumā novirza uz projekta lapu
            header("Location: /project");
            exit(); // Nodrošina, ka pēc header nosūtīšanas netiek izvadīta cita informācija
        } else {
            $errors[] = "Invalid username or password";
        }
    }
}

// Ielādē pieteikšanās skatu
$title = "Login";
require_once "../app/Views/user/login.view.php";
?>
