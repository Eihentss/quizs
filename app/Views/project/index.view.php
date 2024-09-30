<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-[#89CFF0] to-white min-h-screen flex items-center justify-center relative">

    <form action="/user/logout" method="POST" class="absolute right-5 top-5 z-50">
        <button type="submit"
            class="hover:scale-105 hover:shadow-3xl bg-red-500 hover:bg-red-700 transition-transform duration-300 ease-in-out text-white font-bold py-2 px-4 rounded-xl shadow-lg">
            Logout
        </button>
    </form>

    <div class="backdrop-filter backdrop-blur-lg bg-white/50 p-12 rounded-2xl shadow-3xl border border-white/20 w-full h-full max-w-2xl mx-auto flex flex-col items-center justify-center">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <div class="mb-6 text-right w-full">
                <a href="/quiz/create">
                    <button class="hover:scale-105 hover:shadow-3xl bg-white text-black font-semibold py-3 px-6 rounded-full hover:bg-gray-100 transition-transform duration-300 ease-in-out shadow-lg">
                        Create Quiz
                    </button>
                </a>
                <a href="/quiz/edit">
                    <button
                        class="hover:scale-105 hover:shadow-3xl bg-white text-black font-semibold py-2 px-5 rounded-lg hover:bg-gray-200 transition-transform duration-300 ease-in-out shadow-lg">
                        Edit Quizes
                    </button>
                </a>
            </div>
        <?php endif; ?>

        <h1 class="text-6xl font-extrabold text-center mb-8 text-gray-800 drop-shadow-lg" style="font-family: 'Poppins', sans-serif;">
            <?php echo htmlspecialchars($title); ?>
        </h1>

        <?php if (isset($quizzes) && !empty($quizzes)): ?>
            <div class="flex flex-col space-y-6 w-full">
                <form method="GET" action="/quiz/start" class="bg-white/70 p-10 rounded-lg shadow-lg w-full backdrop-filter backdrop-blur-md border border-gray-200">
                    <label for="quiz-select" class="block text-gray-800 font-medium mb-4 text-lg" style="font-family: 'Poppins', sans-serif;">Choose a quiz:</label>
                    <select id="quiz-select" name="quiz_id" class="w-full p-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out text-lg">
                        <?php foreach ($quizzes as $quiz): ?>
                            <option value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">
                                <?php echo htmlspecialchars($quiz['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="mt-6 w-full bg-white text-black font-bold py-4 px-6 rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:bg-gray-100 text-lg">
                        Start Quiz
                    </button>
                </form>

                <form method="GET" action="/quiz/scores" class="bg-white/70 p-10 rounded-lg shadow-lg w-full backdrop-filter backdrop-blur-md border border-gray-200">
                    <label for="quiz-select" class="block text-gray-800 font-medium mb-4 text-lg" style="font-family: 'Poppins', sans-serif;">Choose a quiz:</label>
                    <select id="quiz-select" name="quiz_id" class="w-full p-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out text-lg">
                        <?php foreach ($quizzes as $quiz): ?>
                            <option value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">
                                <?php echo htmlspecialchars($quiz['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="mt-6 w-full bg-white text-black font-bold py-4 px-6 rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:bg-gray-100 text-lg">
                        Scoreboard
                    </button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600 font-light">No quizzes available.</p>
        <?php endif; ?>
    </div>

</body>

</html>
