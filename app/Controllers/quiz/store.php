<?php
require_once "../app/Core/DBConnect.php"; 
require_once "../app/Models/quizModel.php"; 

// Start session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if data is being sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizModel = new QuizModel();

    // Validate POST values
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $questions = isset($_POST['question_text']) ? $_POST['question_text'] : [];
    $types = isset($_POST['question_type']) ? $_POST['question_type'] : [];
    $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
    $is_correct = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];

    // Check if title and questions are provided
    if ($title && !empty($questions)) {
        // Create the quiz
        $quiz_id = $quizModel->createQuiz($title, $description, $_SESSION['user']['user_id']);

        // Save questions and answers
        foreach ($questions as $index => $question_text) {
            if (!empty($question_text)) {
                // Create each question
                $question_id = $quizModel->createQuestion($quiz_id, $question_text, $types[$index]);

                // Handle answers for each question
                foreach ($answers[$index] as $answer_index => $answer_text) {
                    if (!empty($answer_text)) {
                        $correct = isset($is_correct[$index][$answer_index]) ? 1 : 0;
                        $quizModel->createAnswer($question_id, $answer_text, $correct);
                    }
                }
            }
        }

        // Redirect to the dashboard after successful save
        header("Location: /project");
        exit();
    } else {
        echo "Quiz title and questions are required.";
    }
} else {
    // If data is not sent via POST, redirect to the create form
    header("Location: /quiz/create");
    exit();
}
?>
