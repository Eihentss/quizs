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
    $totalQuestions = count($questions);

    // Get current question index from URL or default to 0
    $currentQuestionIndex = isset($_GET['question_index']) ? (int) $_GET['question_index'] : 0;
    $correctAnswers = isset($_GET['correct_answers']) ? (int) $_GET['correct_answers'] : 0;

    // Check if the quiz is completed
    if (isset($_GET['completed']) && $_GET['completed'] === 'true') {
        // Display the results view
        $title = "Quiz Results";
        require_once "../app/Views/quiz/results.view.php";
    } else {
        // Check if the answer form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if an answer was submitted for the current question
            if (isset($_POST['question_' . $questions[$currentQuestionIndex]['question_id']])) {
                $submittedAnswer = $_POST['question_' . $questions[$currentQuestionIndex]['question_id']];
            } else {
                $submittedAnswer = null; // No answer submitted
            }

            // Fetch the correct answer for the current question
            $correctAnswer = $quizModel->getCorrectAnswerByQuestionId($questions[$currentQuestionIndex]['question_id']);

            // Compare submitted answer with correct answer
            if ($correctAnswer && $submittedAnswer == $correctAnswer['answer_id']) {
                $correctAnswers++;
            }

            // Move to the next question
            $currentQuestionIndex++;
            if ($currentQuestionIndex >= $totalQuestions) {


                $records = $quizModel->createRecord($_SESSION["user"]['user_id'], $quizId, $correctAnswers);

                // All questions answered, redirect to results
                header("Location: ?quiz_id=$quizId&completed=true&correct_answers=$correctAnswers");
                exit;
            } else {
                // Redirect to the next question
                header("Location: ?quiz_id=$quizId&question_index=$currentQuestionIndex&correct_answers=$correctAnswers");
                exit;
            }
        }

        // Display the current question
        if ($currentQuestionIndex < $totalQuestions) {
            $title = $quiz['title'];
            $currentQuestion = $questions[$currentQuestionIndex];
            require_once "../app/Views/quiz/question.view.php";
        } else {
            // Handle the case where there are no questions
            echo "No questions found for this quiz.";
        }
    }
} else {
    echo "No quiz ID provided.";
}
