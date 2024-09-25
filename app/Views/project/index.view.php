<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- TailwindCSS (jau esošais) -->
</head>
<<<<<<< HEAD

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
=======
<body class="bg-gradient-to-b from-[#89CFF0] to-white min-h-screen flex items-center justify-center">

<div class="backdrop-filter backdrop-blur-lg bg-white/30 p-8 rounded-xl shadow-2xl border border-white/10 max-w-lg mx-auto">
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <div class="mb-6 text-right">
            <a href="/quiz/create">
                <button class="bg-white text-black font-semibold py-2 px-5 rounded-lg hover:bg-gray-200 transition-transform duration-300 ease-in-out shadow-lg">
                    Create Quiz
                </button>
            </a>
        </div>
    <?php endif; ?>

    <h1 class="text-4xl font-extrabold text-center mb-8 text-gray-800 drop-shadow-lg" style="font-family: 'Poppins', sans-serif;">
        <?php echo htmlspecialchars($title); ?>
    </h1>

    <?php if (isset($quizzes) && !empty($quizzes)): ?>
        <div class="flex justify-center items-center">
            <form method="GET" action="/quiz/start" class="bg-white/70 p-8 rounded-lg shadow-lg w-full max-w-md backdrop-filter backdrop-blur-md border border-gray-200">
                <label for="quiz-select" class="block text-gray-800 font-medium mb-3" style="font-family: 'Poppins', sans-serif;">Choose a quiz:</label>
                <select id="quiz-select" name="quiz_id" class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <?php foreach ($quizzes as $quiz): ?>
                        <option value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">
                            <?php echo htmlspecialchars($quiz['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="mt-6 w-full bg-white text-black font-bold py-3 px-6 rounded-lg shadow-2xl transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-3xl hover:bg-gray-200">
                    Start Quiz
                </button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 font-light">No quizzes available.</p>
    <?php endif; ?>
</div>
>>>>>>> 94d633b1bc1538ea32655207f83611de9f649d03

</body>

</html>