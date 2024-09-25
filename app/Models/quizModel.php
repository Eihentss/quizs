<?php
require_once "../app/Core/DBConnect.php";

class QuizModel
{

    private $db;

    public function __construct()
    {
        $this->db = new DBConnect();
    }

    public function createQuiz($title, $description, $created_by)
    {
        $query = $this->db->dbconn->prepare("INSERT INTO Quizzes (title, description, created_by) VALUES (:title, :description, :created_by)");
        $query->execute([':title' => $title, ':description' => $description, ':created_by' => $created_by]);
        return $this->db->dbconn->lastInsertId(); // Atgriež jauno quiz_id
    }

    public function createQuestion($quiz_id, $question_text, $question_type)
    {
        $query = $this->db->dbconn->prepare("INSERT INTO Questions (quiz_id, question_text, question_type) VALUES (:quiz_id, :question_text, :question_type)");
        $query->execute([':quiz_id' => $quiz_id, ':question_text' => $question_text, ':question_type' => $question_type]);
        return $this->db->dbconn->lastInsertId(); // Atgriež jauno question_id
    }

    public function createAnswer($question_id, $answer_text, $is_correct)
    {
        $query = $this->db->dbconn->prepare("INSERT INTO Answers (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)");
        $query->execute([':question_id' => $question_id, ':answer_text' => $answer_text, ':is_correct' => $is_correct]);
    }

    public function createRecord($user_id, $quiz_id, $score)
    {
        $query = $this->db->dbconn->prepare("INSERT INTO UserQuizRecords (user_id, quiz_id, score) VALUES (:user_id, :quiz_id, :score)");
        $query->execute([':user_id' => $user_id, ':quiz_id' => $quiz_id, ':score' => $score]);
    }


    public function getAllQuizzes()
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM Quizzes");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRecords($quiz_id)
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM UserQuizRecords WHERE quiz_id = :quiz_id  ORDER BY score");
        $query->execute([':quiz_id' => $quiz_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuizById($quiz_id)
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM Quizzes WHERE quiz_id = :quiz_id");
        $query->execute([':quiz_id' => $quiz_id]);
        return $query->fetch(PDO::FETCH_ASSOC);  // Atgriež vienu viktorīnu
    }

    // Iegūst visus jautājumus, kas saistīti ar konkrēto viktorīnu
    public function getQuestionsByQuizId($quiz_id)
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM Questions WHERE quiz_id = :quiz_id");
        $query->execute([':quiz_id' => $quiz_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);  // Atgriež jautājumu masīvu
    }
    public function getAnswersByQuestionId($question_id)
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM Answers WHERE question_id = :question_id");
        $query->execute([':question_id' => $question_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);  // Atgriež atbilžu masīvu
    }


    public function getCorrectAnswerByQuestionId($questionId)
    {
        $query = "SELECT answer_id FROM Answers WHERE question_id = :question_id AND is_correct = 1";
        $stmt = $this->db->dbconn->prepare($query); // Izmanto dbconn, nevis db
        $stmt->execute(['question_id' => $questionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




}
