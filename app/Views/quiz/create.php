<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or Edit a Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-[#89CFF0] to-white min-h-screen flex items-center justify-center relative">

    <!-- Navigation button -->
    <div class="absolute top-5 right-5 z-50">
        <a href="/project">
            <button
                class="w-full bg-blue-100 text-black font-bold py-2 px-3 rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:bg-blue-200 text-lg">
                Quiz
            </button>
        </a>
    </div>

    <!-- Form container -->
    <div
        class="backdrop-filter backdrop-blur-lg bg-white/50 p-12 rounded-2xl shadow-3xl border border-white/20 w-full h-full max-w-2xl mx-auto flex flex-col items-center justify-center">
        <form action="/quiz/store" method="POST" class="w-full">
            <!-- New quiz container (visible by default) -->
            <div id="new-quiz-container" class="w-full">
                <label for="title" class="block text-gray-800 font-semibold mb-4 text-lg"
                    style="font-family: 'Poppins', sans-serif;">Quiz Title:</label>
                <input type="text" name="title" required
                    class="w-full p-4 border border-gray-300 rounded-md shadow-sm mb-6 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">

                <label for="description" class="block text-gray-800 font-semibold mb-4 text-lg"
                    style="font-family: 'Poppins', sans-serif;">Description:</label>
                <textarea name="description"
                    class="w-full p-4 border border-gray-300 rounded-md shadow-sm mb-6 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"></textarea>

                <h3 class="text-2xl font-semibold mb-4 text-gray-800 drop-shadow-lg"
                    style="font-family: 'Poppins', sans-serif;">Questions</h3>
                <div id="questions-container">
                    <div
                        class="question mb-6 p-6 border border-gray-300 rounded-lg backdrop-filter backdrop-blur-md bg-white/70 shadow-sm">
                        <label for="question_text[]"
                            class="block text-gray-800 font-semibold mb-2 text-lg">Question:</label>
                        <input type="text" name="question_text[]" required
                            class="w-full p-4 border border-gray-300 rounded-md shadow-sm mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">

                        <label class="block text-gray-800 font-semibold mb-2 text-lg">Answer Options:</label>
                        <div class="answers-container mb-4">
                            <!-- Correct answer -->
                            <div class="answer flex items-center mb-2">
                                <input type="text" name="answers[0][0]" required placeholder="Correct answer"
                                    class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                <input type="hidden" name="is_correct[0]" value="0">
                            </div>
                            <!-- Wrong answers -->
                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                <div class="answer flex items-center mb-2">
                                    <input type="text" name="answers[0][<?= $i ?>]" required placeholder="Wrong answer"
                                        class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <!-- Add another question button -->
                <button type="button" id="add-question"
                    class="bg-blue-500 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-600 transition-transform duration-300 ease-in-out shadow-lg hover:scale-105 mb-6">
                    Add Another Question
                </button>
            </div>

            <!-- Submit button -->
            <input type="submit" value="Submit"
                class="bg-blue-200 text-black font-bold py-3 px-6 rounded-lg hover:bg-blue-300 w-full transition-transform duration-300 ease-in-out hover:scale-105">
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        let questionCount = 1;

        // Add another question dynamically
        document.getElementById('add-question').addEventListener('click', function () {
            const container = document.getElementById('questions-container');
            const questionHTML = `
            <div class="question mb-6 p-6 border border-gray-300 rounded-lg backdrop-filter backdrop-blur-md bg-white/70 shadow-sm">
                <label for="question_text[]" class="block text-gray-800 font-semibold mb-2 text-lg">Question:</label>
                <input type="text" name="question_text[]" required class="w-full p-4 border border-gray-300 rounded-md shadow-sm mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">

                <label class="block text-gray-800 font-semibold mb-2 text-lg">Answer Options:</label>
                <div class="answers-container mb-4">
                    <div class="answer flex items-center mb-2">
                        <input type="text" name="answers[${questionCount}][0]" required placeholder="Correct answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        <input type="hidden" name="is_correct[${questionCount}]" value="0">
                    </div>
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                                <div class="answer flex items-center mb-2">
                                    <input type="text" name="answers[${questionCount}][<?= $i ?>]" required placeholder="Wrong answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                </div>
                    <?php endfor; ?>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', questionHTML);
            questionCount++;
        });
    </script>
</body>

</html>