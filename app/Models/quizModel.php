<?php
require_once "../app/Core/DBConnect.php";

class QuizModel {

    private $db;

    public function __construct() {
        $this->db = new DBConnect();
    }

    public function createQuiz($title, $description, $created_by) {
        $query = $this->db->dbconn->prepare("INSERT INTO Quizzes (title, description, created_by) VALUES (:title, :description, :created_by)");
        $query->execute([':title' => $title, ':description' => $description, ':created_by' => $created_by]);
        return $this->db->dbconn->lastInsertId(); // Atgriež jauno quiz_id
    }

    public function createQuestion($quiz_id, $question_text, $question_type) {
        $query = $this->db->dbconn->prepare("INSERT INTO Questions (quiz_id, question_text, question_type) VALUES (:quiz_id, :question_text, :question_type)");
        $query->execute([':quiz_id' => $quiz_id, ':question_text' => $question_text, ':question_type' => $question_type]);
        return $this->db->dbconn->lastInsertId(); // Atgriež jauno question_id
    }

    public function createAnswer($question_id, $answer_text, $is_correct) {
        $query = $this->db->dbconn->prepare("INSERT INTO Answers (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)");
        $query->execute([':question_id' => $question_id, ':answer_text' => $answer_text, ':is_correct' => $is_correct]);
    }
    public function getAllQuizzes() {
        $query = $this->db->dbconn->prepare("SELECT * FROM Quizzes");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    // public function getQuizById($quiz_id) {
    //     $stmt = $this->db->dbconn->prepare("SELECT * FROM Quizzes WHERE id = :quiz_id");
    //     $stmt->execute([':quiz_id' => $quiz_id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // public function getQuestionsByQuizId($quiz_id) {
    //     $stmt = $this->db->dbconn->prepare("SELECT * FROM Questions WHERE quiz_id = :quiz_id");
    //     $stmt->execute([':quiz_id' => $quiz_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getAnswersByQuestionId($question_id) {
    //     $stmt = $this->db->dbconn->prepare("SELECT * FROM Answers WHERE question_id = :question_id");
    //     $stmt->execute([':question_id' => $question_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}
