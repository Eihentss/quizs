<?php 
require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";

$quizModel = new QuizModel();
$title = "Edit a Quiz";

if (!isset($_SESSION['user'])) {
    header("Location: /user/login");
    exit();
}

$loggedInUser = $_SESSION['user'];
$userId = $loggedInUser['user_id'] ?? null;

$quizzes = $quizModel->getAllQuizzes();
$existingQuiz = null;
$existingQuestions = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_selection = $_POST['quiz_selection'] ?? null;

    if ($quiz_selection) {
        // Logic for editing existing quizzes
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $questions = $_POST['question_text'] ?? [];
        $answers = $_POST['answers'] ?? [];
        $is_correct = $_POST['is_correct'] ?? [];

        if ($title && !empty($questions)) {
            // Update quiz title and description
            $quizModel->updateQuiz($quiz_selection, $title, $description);

            foreach ($questions as $index => $question_text) {
                $question_id = $_POST['question_ids'][$index] ?? null;
                if ($question_id) {
                    // Update existing question
                    $quizModel->updateQuestion($question_id, $question_text);
                } else {
                    // Create a new question if it doesn't exist
                    $question_id = $quizModel->createQuestion($quiz_selection, $question_text, 'multiple_choice');
                }

                // Update or create answers
                foreach ($answers[$index] as $answer_index => $answer_text) {
                    $correct = ($is_correct[$index] == $answer_index) ? 1 : 0;
                    $answer_id = $_POST['answer_ids'][$index][$answer_index] ?? null;
                    if ($answer_id) {
                        $quizModel->updateAnswer($answer_id, $answer_text, $correct);
                    } else {
                        $quizModel->createAnswer($question_id, $answer_text, $correct);
                    }
                }
            }

            header("Location: /project");
            exit();
        } else {
            echo "Quiz title and questions are required.";
        }
    } else {
        echo "Please select a quiz.";
    }
} else if (isset($_GET['quiz_id'])) {
    $quiz_selection = $_GET['quiz_id'];
    $existingQuiz = $quizModel->getQuizById($quiz_selection);
    $existingQuestions = $quizModel->getQuestionsByQuizId($quiz_selection);
    foreach ($existingQuestions as &$question) {
        $question['answers'] = $quizModel->getAnswersByQuestionId($question['question_id']);
    }
}

require_once "../app/Views/quiz/edit.view.php";
?>
