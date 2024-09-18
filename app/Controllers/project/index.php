<?php

require_once "../app/Core/DBConnect.php";
require_once "../app/Models/project.php";

$projectModel = new projectModel();
$title = "Quiz";

if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    if (isset($loggedInUser['user_id'])) {
        $userId = $loggedInUser['user_id'];

        require_once "../app/Views/project/index.view.php";
    } else {
        echo "user_id not found in session";
    }
} else {
    header("Location: /");
    exit();
}
?> 