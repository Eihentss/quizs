<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex justify-center items-center min-h-screen">

<div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full transform hover:scale-105 transition-transform duration-300 ease-in-out">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
        <?php echo htmlspecialchars($title); ?>
    </h1>

    <form action="/quiz/start?quiz_id=<?php echo $quizId; ?>" method="POST">
        <div class="mb-10">
            <h3 class="text-2xl font-semibold mb-6 text-gray-700">
                Question <?php echo $_SESSION['current_question_index'] + 1; ?>: <?php echo htmlspecialchars($currentQuestion['question_text']); ?>
            </h3>

            <?php
            // Iegūstam atbildes šim jautājumam
            $answers = $quizModel->getAnswersByQuestionId($currentQuestion['question_id']);

            // Shuffle answers
            shuffle($answers);
            ?>

            <!-- Pārbaudām, vai atbildes eksistē -->
            <?php if (!empty($answers)): ?>
                <div class="space-y-4">
                    <?php foreach ($answers as $answer): ?>
                        <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-inner hover:bg-blue-50 transition-colors">
                            <input type="radio" name="question_<?php echo $currentQuestion['question_id']; ?>" value="<?php echo $answer['answer_id']; ?>" class="mr-4 h-6 w-6 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                            <label class="text-lg text-gray-800"><?php echo htmlspecialchars($answer['answer_text']); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-red-500">No answers available for this question.</p>
            <?php endif; ?>
        </div>

        <!-- Poga viktorīnas iesniegšanai -->
        <div class="flex justify-center mt-8">
            <button type="submit" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-1">
                Submit Answer
            </button>
        </div>
    </form>
</div>

</body>
</html>
