<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .progress-bar {
            height: 10px;
            background-color: #4CAF50;
            width: <?php 
                if (isset($totalQuestions) && $totalQuestions > 0) {
                    echo ($currentQuestionIndex + 1) / $totalQuestions * 100; 
                } else {
                    echo 0;
                }
            ?>%;
            border-radius: 5px;
            transition: width 0.5s ease; /* Smooth transition */
        }

        /* Style for the Submit button */
        .submit-btn {
            background: linear-gradient(to right, #a7c5eb, #89b0e4, #72a0e0);
            color: white;
            font-weight: bold;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(to right, #89b0e4, #72a0e0, #5a90dc);
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Radio button container style */
        .radio-container:hover {
            background-color: #e3f2fd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
    </style>

<body class="bg-gradient-to-b from-[#89CFF0] to-white flex justify-center items-center min-h-screen">

<div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full transform hover:scale-105 transition-transform duration-300 ease-in-out">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
        <?php echo htmlspecialchars($title); ?>
    </h1>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>
    <p class="text-center text-gray-700 mb-4">
        Question <?php echo ($currentQuestionIndex + 1); ?> of <?php echo htmlspecialchars($totalQuestions); ?>
    </p>

    <form action="" method="POST">  
    <div class="mb-10">
        <h3 class="text-2xl font-semibold mb-6 text-gray-700">
            Question <?php echo ($currentQuestionIndex + 1); ?>: <?php echo htmlspecialchars($currentQuestion['question_text']); ?>
        </h3>

        <?php
        $answers = $quizModel->getAnswersByQuestionId($currentQuestion['question_id']);

        if (empty($answers)) {
            echo '<p class="text-red-500">No answers available for this question.</p>';
        } else {
            shuffle($answers);
            echo '<div class="space-y-4">';
            foreach ($answers as $answer): ?>
                <label class="flex items-center p-4 bg-gray-100 rounded-lg shadow-inner radio-container transition-colors cursor-pointer">
                    <input type="radio" name="question_<?php echo $currentQuestion['question_id']; ?>" value="<?php echo $answer['answer_id']; ?>" class="mr-4 h-6 w-6 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="text-lg text-gray-800"><?php echo htmlspecialchars($answer['answer_text']); ?></span>
                </label>
            <?php endforeach;
            echo '</div>'; // Close the space-y-4 div
        }
        ?>
    </div>

    <!-- Submit button -->
    <div class="flex justify-center mt-8">
        <button type="submit" class="submit-btn">
            Submit Answer
        </button>
    </div>
</form>

</div>

<script>
    // Disable the browser's back button
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        window.history.go(1);
    };
</script>

</body>
</html>
