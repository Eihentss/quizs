<?php

require_once "../app/Models/QuizModel.php";

class QuizController {

    public function show($quiz_id) {
        $quizModel = new QuizModel();
        $quiz = $quizModel->getQuizById($quiz_id);
        $questions = $quizModel->getQuestionsByQuizId($quiz_id);

        require_once "../app/Views/quiz/show.php";
    }
}
