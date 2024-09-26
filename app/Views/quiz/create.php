
<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or Edit a Quiz</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">
<div style="position: absolute; top: 20px; right: 20px;">
    <a href="/project">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Quiz
        </button>
    </a>
</div>
    <form action="/quiz/store" method="POST">
        <label for="quiz_selection" class="block text-gray-700 font-semibold mb-2">Select a Quiz:</label>
        <select name="quiz_selection" id="quiz_selection" class="w-full p-2 border border-gray-300 rounded mb-4" required>
            <option value="">Choose a quiz...</option>
            <?php foreach ($quizzes as $quiz): ?>
                <option value="<?= htmlspecialchars($quiz['quiz_id']) ?>"><?= htmlspecialchars($quiz['title']) ?></option>
            <?php endforeach; ?>
            <option value="new_quiz">Create New Quiz</option>
        </select>

        <div id="new-quiz-container" style="display: none;">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Quiz Title:</label>
            <input type="text" name="title" required class="w-full p-2 border border-gray-300 rounded mb-4">

            <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
            <textarea name="description" class="w-full p-2 border border-gray-300 rounded mb-4"></textarea>

            <h3 class="text-xl font-semibold mb-4">Questions</h3>
            <div id="questions-container">
                <div class="question mb-4 p-4 border border-gray-300 rounded">
                    <label for="question_text[]" class="block text-gray-700 font-semibold mb-2">Question:</label>
                    <input type="text" name="question_text[]" required class="w-full p-2 border border-gray-300 rounded mb-2">

                    <label class="block text-gray-700 font-semibold mb-2">Answer Options:</label>
                    <div class="answers-container mb-2">
                        <div class="answer flex items-center mb-2">
                            <input type="text" name="answers[0][0]" required placeholder="Correct answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                            <input type="radio" name="is_correct[0]" value="0" checked> Correct
                        </div>
                        <div class="answer flex items-center mb-2">
                            <input type="text" name="answers[0][1]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                            <input type="radio" name="is_correct[0]" value="1"> Incorrect
                        </div>
                        <div class="answer flex items-center mb-2">
                            <input type="text" name="answers[0][2]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                            <input type="radio" name="is_correct[0]" value="2"> Incorrect
                        </div>
                        <div class="answer flex items-center mb-2">
                            <input type="text" name="answers[0][3]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                            <input type="radio" name="is_correct[0]" value="3"> Incorrect
                        </div>
                    </div>

                </div>
            </div>

            <button type="button" id="add-question" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 mb-4">Add Another Question</button>
        </div>

        <input type="submit" value="Submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-600 w-full">
    </form>
</div>

<script>
    const quizSelection = document.getElementById('quiz_selection');
    const newQuizContainer = document.getElementById('new-quiz-container');

    quizSelection.addEventListener('change', function() {
        newQuizContainer.style.display = this.value === 'new_quiz' ? 'block' : 'none';
    });

    let questionCount = 1;
    document.getElementById('add-question').addEventListener('click', function() {
        const container = document.getElementById('questions-container');
        const questionHTML = `
        <div class="question mb-4 p-4 border border-gray-300 rounded">
            <label for="question_text[]" class="block text-gray-700 font-semibold mb-2">Question:</label>
            <input type="text" name="question_text[]" required class="w-full p-2 border border-gray-300 rounded mb-2">

            <label class="block text-gray-700 font-semibold mb-2">Answer Options:</label>
            <div class="answers-container mb-2">
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][0]" required placeholder="Correct answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                    <input type="radio" name="is_correct[${questionCount}]" value="0" checked> Correct
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][1]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                    <input type="radio" name="is_correct[${questionCount}]" value="1"> Incorrect
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][2]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                    <input type="radio" name="is_correct[${questionCount}]" value="2"> Incorrect
                </div>
                <div class="answer flex items-center mb-2">
                    <input type="text" name="answers[${questionCount}][3]" required placeholder="Wrong answer" class="flex-1 p-2 border border-gray-300 rounded mr-2">
                    <input type="radio" name="is_correct[${questionCount}]" value="3"> Incorrect
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', questionHTML);
        questionCount++;
    });
</script>

</body>
</html>
