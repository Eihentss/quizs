<?php

require_once "../app/Core/DBConnect.php";
require_once "../app/Models/quizModel.php";


$quizModel = new QuizModel();
$title = "All Quizzes";

// Pārbauda, vai lietotājs ir pieteicies
if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];

    if (isset($loggedInUser['user_id'])) {
        $userId = $loggedInUser['user_id'];
        $userRole = $loggedInUser['role']; // Saglabājām lomu sesijā pieteikšanās laikā

        // Iegūst visus viktorīnas no datubāzes
        $quizzes = $quizModel->getAllQuizzes();

        // Ielādē skatu, lai parādītu visus viktorīnas
        require_once "../app/Views/project/index.view.php";
    } else {
        echo "user_id not found in session";
    }
} else {
    // Novirza uz sākumlapu, ja nav pieteicies
    header("Location: /");
    exit();
}


