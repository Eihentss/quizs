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
<body class="bg-blue-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">
    <div class="mb-6">
        <a href="/project" class="text-blue-500 font-semibold hover:underline">Back to Quizzes</a>
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
            <input type="text" name="title" value="<?= htmlspecialchars($existingQuiz['title']) ?>" required class="w-full p-2 border border-gray-300 rounded mb-4">

            <!-- Quiz Description -->
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
            <textarea name="description" class="w-full p-2 border border-gray-300 rounded mb-4"><?= htmlspecialchars($existingQuiz['description']) ?></textarea>

            <!-- Questions -->
            <h3 class="text-xl font-semibold mb-4">Questions</h3>
            <div id="questions-container">
                <?php foreach ($existingQuestions as $index => $question): ?>
                    <div class="question mb-4 p-4 border border-gray-300 rounded bg-blue-50">
                        <input type="hidden" name="question_ids[<?= $index ?>]" value="<?= $question['question_id'] ?>">

                        <!-- Question Text -->
                        <label for="question_text[]" class="block text-gray-700 font-semibold mb-2">Question:</label>
                        <input type="text" name="question_text[]" value="<?= htmlspecialchars($question['question_text']) ?>" required class="w-full p-2 border border-gray-300 rounded mb-2">

                        <!-- Answers -->
                        <label class="block text-gray-700 font-semibold mb-2">Answer Options:</label>
                        <div class="answers-container mb-2">
                            <?php foreach ($question['answers'] as $answer_index => $answer): ?>
                                <div class="answer flex items-center mb-2">
                                    <input type="hidden" name="answer_ids[<?= $index ?>][<?= $answer_index ?>]" value="<?= $answer['answer_id'] ?>">
                                    <input type="text" name="answers[<?= $index ?>][<?= $answer_index ?>]" value="<?= htmlspecialchars($answer['answer_text']) ?>" required class="flex-1 p-2 border border-gray-300 rounded mr-2">
                                    <input type="radio" name="is_correct[<?= $index ?>]" value="<?= $answer_index ?>" <?= $answer['is_correct'] ? 'checked' : '' ?>> Correct
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Save Changes" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 w-full">
        </form>
    <?php endif; ?>
</div>

</body>
</html>
