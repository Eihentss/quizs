<?php

require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php"; // Izmanto quizModel, nevis projectModel

$quizModel = new QuizModel();
$title = "All Quizzes";

if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    if (isset($loggedInUser['user_id'])) {
        $userId = $loggedInUser['user_id'];

        // Iegūst visus viktorīnas no datubāzes
        $quizzes = $quizModel->getAllQuizzes();

        // Ielādē skatu, lai parādītu visus viktorīnas
        require_once "../app/Views/project/index.view.php";
    } else {
        echo "user_id not found in session";
    }
} else {
    header("Location: /");
    exit();
}
?>
