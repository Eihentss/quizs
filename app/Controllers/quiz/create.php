<?php 
require_once "../app/Core/DBConnect.php"; // Database connection
require_once "../app/Models/quizModel.php"; // Quiz model


$quizModel = new QuizModel();
$title = "Create or Edit a Quiz";

if (!isset($_SESSION['user'])) {
    header("Location: /user/login");
    exit();
}

$loggedInUser = $_SESSION['user'];
$userId = $loggedInUser['user_id'] ?? null;

// Get all quizzes from the database
$quizzes = $quizModel->getAllQuizzes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_selection = $_POST['quiz_selection'] ?? null;

    if ($quiz_selection === 'new_quiz') {
        // Creating a new quiz
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $questions = $_POST['question_text'] ?? [];
        $answers = $_POST['answers'] ?? [];
        $is_correct = $_POST['is_correct'] ?? [];

        if ($title && !empty($questions)) {
            // Create the quiz
            $quiz_id = $quizModel->createQuiz($title, $description, $userId);

            // Save questions and answers
            foreach ($questions as $index => $question_text) {
                $question_id = $quizModel->createQuestion($quiz_id, $question_text, 'multiple_choice');

                foreach ($answers[$index] as $answer_index => $answer_text) {
                    $correct = ($is_correct[$index] == $answer_index) ? 1 : 0;
                    $quizModel->createAnswer($question_id, $answer_text, $correct);
                }
            }

            header("Location: /project");
            exit();
        } else {
            echo "Quiz title and questions are required.";
        }
    } 
    // Logic for editing existing quizzes can be added here
} else {
    require_once "../app/Views/quiz/create.php"; // Load the form view
}
?>
