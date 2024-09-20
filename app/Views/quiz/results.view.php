<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body class="bg-gradient-to-r from-green-50 to-green-100 flex justify-center items-center min-h-screen">

<div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
        Congratulations!
    </h1>

    <p class="text-center text-2xl text-gray-700">You got <strong class="text-green-600"><?php echo $correctAnswers; ?></strong> correct out of <strong><?php echo $totalQuestions; ?></strong> questions.</p>

    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Results</h1>
    <div class="flex justify-center mt-8">
        <a href="/quiz/start?quiz_id=<?php echo $quizId; ?>" class="px-8 py-4 bg-blue-600 text-white rounded-full">Restart Quiz</a>
    </div>
</div>  
</div>

</body>
</html>
