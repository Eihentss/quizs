<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Quiz</title>
    <script>
        function loadQuiz() {
            const quizId = document.getElementById('quiz_selection').value;
            if (quizId) {
                window.location.href = `/quiz/edit?quiz_id=${quizId}`;
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-[#89CFF0] to-white flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">
        <div class="absolute top-5 right-5 z-50">
            <a href="/project">
                <button
                    class="w-full bg-blue-100 text-black font-bold py-2 px-3 rounded-lg shadow-lg transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:bg-blue-200 text-lg">
                    Quiz
                </button>
            </a>
        </div>

        <!-- Quiz Selection Dropdown -->
        <div class="mb-6">
            <label for="quiz_selection" class="block text-gray-700 font-semibold mb-2">Select a Quiz to Edit:</label>
            <select id="quiz_selection" class="w-full p-2 border border-gray-300 rounded mb-4" onchange="loadQuiz()">
                <option value="">-- Choose a quiz --</option>
                <?php foreach ($quizzes as $quiz): ?>
                    <option value="<?= htmlspecialchars($quiz['quiz_id']) ?>" <?= isset($existingQuiz['quiz_id']) && $existingQuiz['quiz_id'] == $quiz['quiz_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($quiz['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if (isset($existingQuiz)): ?>
            <!-- Quiz Editing Form -->
            <form action="/quiz/edit?quiz_id=<?= htmlspecialchars($existingQuiz['quiz_id']) ?>" method="POST">
                <input type="hidden" name="quiz_selection" value="<?= htmlspecialchars($existingQuiz['quiz_id']) ?>">

                <!-- Quiz Title -->
                <label for="title" class="block text-gray-700 font-semibold mb-2">Quiz Title:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($existingQuiz['title']) ?>" required
                    class="w-full p-2 border border-gray-300 rounded mb-4">

                <!-- Quiz Description -->
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                <textarea name="description"
                    class="w-full p-2 border border-gray-300 rounded mb-4"><?= htmlspecialchars($existingQuiz['description']) ?></textarea>

                <!-- Questions -->
                <h3 class="text-xl font-semibold mb-4">Questions</h3>
                <div id="questions-container">
                    <?php foreach ($existingQuestions as $index => $question): ?>
                        <div class="question mb-4 p-4 border border-gray-300 rounded bg-blue-50">
                            <input type="hidden" name="question_ids[<?= $index ?>]" value="<?= $question['question_id'] ?>">

                            <!-- Question Text -->
                            <label for="question_text[]" class="block text-gray-700 font-semibold mb-2">Question:</label>
                            <input type="text" name="question_text[]"
                                value="<?= htmlspecialchars($question['question_text']) ?>" required
                                class="w-full p-2 border border-gray-300 rounded mb-2">

                            <!-- Answers -->
                            <label class="block text-gray-700 font-semibold mb-2">Answer Options:</label>
                            <div class="answers-container mb-2">
                                <?php foreach ($question['answers'] as $answer_index => $answer): ?>
                                    <div class="answer flex items-center mb-2">
                                        <input type="hidden" name="answer_ids[<?= $index ?>][<?= $answer_index ?>]"
                                            value="<?= $answer['answer_id'] ?>">
                                        <input type="text" name="answers[<?= $index ?>][<?= $answer_index ?>]"
                                            value="<?= htmlspecialchars($answer['answer_text']) ?>" required
                                            class="flex-1 p-2 border border-gray-300 rounded mr-2">
                                        <input type="radio" name="is_correct[<?= $index ?>]" value="<?= $answer_index ?>"
                                            <?= $answer['is_correct'] ? 'checked' : '' ?>> Correct
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="add-question"
                    class="bg-blue-500 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-600 transition-transform duration-300 ease-in-out shadow-lg hover:scale-105 mb-6">
                    Add Another Question
                </button>

                <!-- Submit Button -->
                <input type="submit" value="Save Changes"
                    class="bg-blue-200 text-black font-bold py-3 px-6 rounded-lg hover:bg-blue-300 w-full transition-transform duration-300 ease-in-out hover:scale-105">
            </form>
        <?php endif; ?>
    </div>

</body>
<script>
    let questionCount = <?= count($existingQuestions) ?>;

    document.getElementById('add-question').addEventListener('click', function () {
        const container = document.getElementById('questions-container');
        const questionHTML = `
        <div class="question mb-6 p-6 border border-gray-300 rounded-lg backdrop-filter backdrop-blur-md bg-white/70 shadow-sm">
            <label for="question_text[]" class="block text-gray-800 font-semibold mb-2 text-lg">Question:</label>
            <input type="text" name="question_text[]" required class="w-full p-4 border border-gray-300 rounded-md shadow-sm mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">

            <label class="block text-gray-800 font-semibold mb-2 text-lg">Answer Options:</label>
            <div class="answers-container mb-4">
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][0]" required placeholder="Answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <input type="radio" name="is_correct[${questionCount}]" value="0" class="ml-2"> Correct
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][1]" required placeholder="Answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <input type="radio" name="is_correct[${questionCount}]" value="1" class="ml-2"> Correct
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][2]" required placeholder="Answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <input type="radio" name="is_correct[${questionCount}]" value="2" class="ml-2"> Correct
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][3]" required placeholder="Answer" class="flex-1 p-4 border border-gray-300 rounded-md shadow-sm mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <input type="radio" name="is_correct[${questionCount}]" value="3" class="ml-2"> Correct
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', questionHTML);
        questionCount++;
    });

</script>

</html>