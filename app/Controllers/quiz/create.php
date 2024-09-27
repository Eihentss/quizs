<?php 
require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";

$quizModel = new QuizModel();
$title = "Create or Edit a Quiz";

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /user/login");
    exit();
}

$loggedInUser = $_SESSION['user'];
$userId = $loggedInUser['user_id'] ?? null;

// Get all quizzes from the database
$quizzes = $quizModel->getAllQuizzes();

// Handle form submission for quiz creation or editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_selection = $_POST['quiz_selection'] ?? null;

    if ($quiz_selection === 'new_quiz') {
        // Logic for creating a new quiz
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $questions = $_POST['question_text'] ?? [];
        $answers = $_POST['answers'] ?? [];
        $is_correct = $_POST['is_correct'] ?? [];

        // Validate required fields
        if ($title && !empty($questions)) {
            $quiz_id = $quizModel->createQuiz($title, $description, $userId);

            foreach ($questions as $index => $question_text) {
                // Check for non-empty question text
                if (!empty($question_text)) {
                    $question_id = $quizModel->createQuestion($quiz_id, $question_text, 'multiple_choice');

                    foreach ($answers[$index] as $answer_index => $answer_text) {
                        // Ensure answer text is not empty before saving
                        if (!empty($answer_text)) {
                            $correct = ($is_correct[$index] == $answer_index) ? 1 : 0; // Determine if the answer is correct
                            $quizModel->createAnswer($question_id, $answer_text, $correct);
                        }
                    }
                }
            }

            header("Location: /project"); // Redirect after creation
            exit();
        } else {
            echo "Quiz title and at least one question are required.";
        }
    } else {
        // Logic for editing existing quizzes
        // Fetch existing quiz data and questions to prepopulate the form
        $existingQuiz = $quizModel->getQuizById($quiz_selection);
        $existingQuestions = $quizModel->getQuestionsByQuizId($quiz_selection);

        // Check if existing quiz was found
        if ($existingQuiz && $existingQuestions) {
            require_once "../app/Views/quiz/edit.php"; // Load the edit form view
        } else {
            echo "Quiz not found.";
        }
    }
} else {
    // Show the create form for new quiz
    require_once "../app/Views/quiz/create.php"; 
}
?>
