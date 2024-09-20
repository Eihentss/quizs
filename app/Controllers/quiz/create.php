<?php
require_once "../app/Core/DBConnect.php"; // Savienojums ar DB
require_once "../app/Models/quizModel.php"; // Ielādē viktorīnas modeli

$quizModel = new QuizModel();
$title = "Quiz";

if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    if (isset($loggedInUser['user_id'])) {
        $userId = $loggedInUser['user_id'];

        // Ja dati tiek iesniegti ar POST metodi, saglabā viktorīnu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $questions = isset($_POST['question_text']) ? $_POST['question_text'] : [];
            $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
            $is_correct = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];

            if ($title && !empty($questions)) {
                // Izveido viktorīnu
                $quiz_id = $quizModel->createQuiz($title, $description, $userId);

                // Saglabā jautājumus un atbildes
                foreach ($questions as $index => $question_text) {
                    // Izveido jautājumu
                    $question_id = $quizModel->createQuestion($quiz_id, $question_text, 'multiple_choice');

                    // Saglabā atbildes
                    foreach ($answers[$index] as $answer_index => $answer_text) {
                        // Pārbauda, vai šī ir pareizā atbilde
                        $correct = ($is_correct[$index] == $answer_index) ? 1 : 0;
                        $quizModel->createAnswer($question_id, $answer_text, $correct);
                    }
                }

                // Pēc veiksmīgas saglabāšanas, novirza uz viktorīnas sarakstu
                header("Location: /project");
                exit();

            } else {
                echo "Quiz title and questions are required.";
            }
        } else {
            // Ja dati nav iesniegti, rāda veidlapu
            require_once "../app/Views/quiz/create.php";
        }
    } else {
        echo "User ID not found in session";
    }
} else {
    // Ja lietotājs nav pieteicies, novirza uz pieteikšanās lapu
    header("Location: /user/login");
    exit();
}
