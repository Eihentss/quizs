<?php

require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";

$quizModel = new QuizModel();

// Check if the quiz_id parameter is provided
if (isset($_GET['quiz_id'])) {
    $quizId = $_GET['quiz_id'];

    // Get the quiz and its questions
    $quiz = $quizModel->getQuizById($quizId);
    $questions = $quizModel->getQuestionsByQuizId($quizId);

    // Initialize session variables if not set
    if (!isset($_SESSION['current_question_index'])) {
        $_SESSION['current_question_index'] = 0;
        $_SESSION['correct_answers'] = 0; // Store correct answers
        $_SESSION['total_questions'] = count($questions); // Total number of questions
    }

    // Check if the answer form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if there's an answer submitted for the current question
        $submittedAnswer = $_POST['question_' . $questions[$_SESSION['current_question_index']]['question_id']];
        $correctAnswer = $quizModel->getCorrectAnswerByQuestionId($questions[$_SESSION['current_question_index']]['question_id']);

        // If the answer is correct, increment the correct answers count
        if ($submittedAnswer == $correctAnswer['answer_id']) {
            $_SESSION['correct_answers']++;
        }

        // Move to the next question
        $_SESSION['current_question_index']++;
    }

    // If all questions have been answered
    if ($_SESSION['current_question_index'] >= $_SESSION['total_questions']) {
        $correctAnswers = $_SESSION['correct_answers'];
        $totalQuestions = $_SESSION['total_questions'];

        $record = $quizModel->createRecord($_SESSION['user']['user_id'], $quizId, $correctAnswers);

        // Reset only the score-related session variables
        unset($_SESSION['correct_answers']);
        unset($_SESSION['total_questions']);
        unset($_SESSION['current_question_index']); // Optional

        // Check if the user is logged in and display results
        if (isset($_SESSION['user'])) {
            // Display the results
            $title = "Quiz Results";
            require_once "../app/Views/quiz/results.view.php";
        } else {
            // If the user is not logged in, redirect to the login page
            header("Location: /login");
            exit;
        }
    } else {
        // Show the next question
        $title = $quiz['title'];
        $currentQuestion = $questions[$_SESSION['current_question_index']];
        require_once "../app/Views/quiz/question.view.php";
    }
} else {
    echo "No quiz ID provided.";
}
