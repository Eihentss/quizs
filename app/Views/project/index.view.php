<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <div class="mb-4 text-right">
                <a href="/quiz/create">
                    <button class="bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-600 transition">
                        Create Quiz
                    </button>
                </a>
            </div>
        <?php endif; ?>

        <?php if (isset($quizzes) && !empty($quizzes)): ?>


            <h1 class="text-3xl font-bold text-center mb-6"><?php echo htmlspecialchars($title); ?></h1>

            <div class="flex justify-center items-center min-h-screen">
                <form method="GET" action="/quiz/start" class="bg-white p-6 rounded-lg shadow-md w-96">
                    <label for="quiz-select" class="block text-gray-700 font-semibold mb-2">Choose a quiz:</label>
                    <select id="quiz-select" name="quiz_id"
                        class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <?php foreach ($quizzes as $quiz): ?>
                            <option value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">
                                <?php echo htmlspecialchars($quiz['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit"
                        class="mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition">
                        Start Quiz
                    </button>
                </form>
            </div>

        <?php else: ?>
            <p class="text-center text-gray-600">No quizzes available.</p>
        <?php endif; ?>

    </div>

</body>

</html>