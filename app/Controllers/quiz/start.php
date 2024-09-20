<?php

require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";



$quizModel = new QuizModel();

// Pārbaudām, vai ir nodots quiz_id parametrs
if (isset($_GET['quiz_id'])) {
    $quizId = $_GET['quiz_id'];

    // Iegūstam viktorīnu un tās jautājumus
    $quiz = $quizModel->getQuizById($quizId);  
    $questions = $quizModel->getQuestionsByQuizId($quizId);  

    // Iniciējam sesijas mainīgos
    if (!isset($_SESSION['current_question_index'])) {
        $_SESSION['current_question_index'] = 0;
        $_SESSION['correct_answers'] = 0; // Saglabās pareizās atbildes
        $_SESSION['total_questions'] = count($questions); // Cik kopā jautājumu
    }

    // Pārbaudām, vai ir iesniegts atbildes veidlapa
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Pārbaudām, vai ir atbilde uz iesniegto jautājumu
        $submittedAnswer = $_POST['question_' . $questions[$_SESSION['current_question_index']]['question_id']];
        $correctAnswer = $quizModel->getCorrectAnswerByQuestionId($questions[$_SESSION['current_question_index']]['question_id']);


        // Ja atbilde ir pareiza, palielinām pareizo atbilžu skaitu
        if ($submittedAnswer == $correctAnswer['answer_id']) {
            $_SESSION['correct_answers']++;
        }

        // Pārejam pie nākamā jautājuma
        $_SESSION['current_question_index']++;
    }

    // Ja ir atbildēti visi jautājumi
    if ($_SESSION['current_question_index'] >= $_SESSION['total_questions']) {
        $correctAnswers = $_SESSION['correct_answers'];
        $totalQuestions = $_SESSION['total_questions'];

        // Resetējam sesijas mainīgos pēc viktorīnas beigām
        session_unset();
        session_destroy();

        // Parādam rezultātu
        $title = "Quiz Results";
        require_once "../app/Views/quiz/results.view.php";
    } else {
        // Rādām nākamo jautājumu
        $title = $quiz['title'];
        $currentQuestion = $questions[$_SESSION['current_question_index']];
        require_once "../app/Views/quiz/question.view.php";
    }
} else {
    echo "No quiz ID provided.";
}
