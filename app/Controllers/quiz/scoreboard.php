<?php
require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";

$quizModel = new QuizModel();
$title = "Create or Edit a Quiz";

if (!isset($_SESSION['user'])) {
    header("Location: /login");


    exit();
}

if (isset($_GET['quiz_id'])) {
    $quizId = $_GET['quiz_id'];
    $scores = $quizModel->getAllRecords($quizId);



    $title = "Quiz Results";
    require_once "../app/Views/quiz/scoreboard.view.php";
} else {
    echo "No quiz ID provided.";
}
