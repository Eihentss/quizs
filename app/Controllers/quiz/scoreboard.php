<?php
require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";

$quizModel = new QuizModel();
$title = "Create or Edit a Quiz";

if (!isset($_SESSION['user'])) {
    header("Location: /user/login");


    exit();
}

if (isset($_GET['quiz_id'])) {
    $quizId = $_GET['quiz_id'];
    $score = $quizModel->getAllRecords($quiz_id);
}