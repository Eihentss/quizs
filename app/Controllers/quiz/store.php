<?php
require_once "../app/Models/quizModel.php"; 

// Pārbauda, vai dati tiek nosūtīti ar POST metodi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizModel = new QuizModel();

    // Pārbauda POST vērtības un izmanto noklusējumus, ja tukšs
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $questions = isset($_POST['question_text']) ? $_POST['question_text'] : [];
    $types = isset($_POST['question_type']) ? $_POST['question_type'] : [];
    $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
    $is_correct = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];

    if ($title && !empty($questions)) {
        // Izveido viktorīnu
        $quiz_id = $quizModel->createQuiz($title, $description, $_SESSION['user']['user_id']);

        // Saglabā jautājumus un atbildes
        foreach ($questions as $index => $question_text) {
            $question_id = $quizModel->createQuestion($quiz_id, $question_text, $types[$index]);

            foreach ($answers[$index] as $answer_index => $answer_text) {
                $correct = isset($is_correct[$index][$answer_index]) ? 1 : 0;
                $quizModel->createAnswer($question_id, $answer_text, $correct);
            }
        }

        // Pēc veiksmīgas saglabāšanas pāradresē uz vadības paneli
        header("Location: /project");
        exit();
    } else {
        // Ja ir problēma ar datiem, izvada kļūdu
        echo "Quiz title and questions are required.";
    }
} else {
    // Ja dati netiek nosūtīti ar POST metodi, pāradresē uz veidlapas lapu
    header("Location: /quiz/create");
    exit();
}
