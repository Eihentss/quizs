<?php require_once "../app/Views/Components/head.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        width: 80%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }

    input[type="text"], 
    textarea, 
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    .question {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
    }

    .answers-container {
        margin: 10px 0;
    }

    .answers-container input[type="text"] {
        width: calc(100% - 50px);
        display: inline-block;
    }

    .answers-container input[type="radio"] {
        margin-right: 5px;
    }

    button {
        background-color: #5cb85c;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        display: block;
        width: 100%;
    }

    button:hover {
        background-color: #4cae4c;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin: 10px 0;
    }
</style>

<body>

<div class="container">

    <?php
    // Pārbauda, vai lietotājs ir administrators
    if (!isset($_SESSION['user'])) {
        // Ja lietotājs nav pieteicies, novirza uz pieteikšanās lapu
        header('Location: /user/login');
        exit();
    }

    // Pārbauda, vai lietotājam ir 'admin' loma
    if ($_SESSION['user']['role'] !== 'admin') {
        // Ja lietotājs nav administrators, novirza uz paneļa lapu
        header('Location: /dashboard');
        exit();
    }
    ?>

    <h1>Create a New Quiz</h1>
    <form action="/quiz/store" method="POST">
        <label for="title">Quiz Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <!-- Questions can be dynamically added with JS -->
        <div id="questions-container">
            <h3>Questions</h3>
            <div class="question">
                <label for="question_text[]">Question:</label>
                <input type="text" name="question_text[]" required>

                <label for="question_type[]">Type:</label>
                <select name="question_type[]">
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="true_false">True/False</option>
                    <option value="short_answer">Short Answer</option>
                </select>

                <div class="answers-container">
                    <!-- Placeholder for 4 answers -->
                    <div class="answer">
                        <input type="text" name="answers[0][]" required>
                        <input type="radio" name="is_correct[0]" value="0" checked> No
                        <input type="radio" name="is_correct[0]" value="1"> Yes
                    </div>
                    <div class="answer">
                        <input type="text" name="answers[0][]" required>
                        <input type="radio" name="is_correct[0]" value="0" checked> No
                        <input type="radio" name="is_correct[0]" value="1"> Yes
                    </div>
                    <div class="answer">
                        <input type="text" name="answers[0][]" required>
                        <input type="radio" name="is_correct[0]" value="0" checked> No
                        <input type="radio" name="is_correct[0]" value="1"> Yes
                    </div>
                    <div class="answer">
                        <input type="text" name="answers[0][]" required>
                        <input type="radio" name="is_correct[0]" value="0" checked> No
                        <input type="radio" name="is_correct[0]" value="1"> Yes
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="add-question">Add Another Question</button>

        <input type="submit" value="Create Quiz">
    </form>

</div>

<script>
    let questionCount = 1;
    document.getElementById('add-question').addEventListener('click', function() {
        const container = document.getElementById('questions-container');
        const questionHTML = `
        <div class="question">
            <label for="question_text[]">Question:</label>
            <input type="text" name="question_text[]" required>

            <label for="question_type[]">Type:</label>
            <select name="question_type[]">
                <option value="multiple_choice">Multiple Choice</option>
                <option value="true_false">True/False</option>
                <option value="short_answer">Short Answer</option>
            </select>

            <div class="answers-container">
                <div class="answer">
                    <input type="text" name="answers[\${questionCount}][]" required>
                    <input type="radio" name="is_correct[\${questionCount}]" value="0" checked> No
                    <input type="radio" name="is_correct[\${questionCount}]" value="1"> Yes
                </div>
                <div class="answer">
                    <input type="text" name="answers[\${questionCount}][]" required>
                    <input type="radio" name="is_correct[\${questionCount}]" value="0" checked> No
                    <input type="radio" name="is_correct[\${questionCount}]" value="1"> Yes
                </div>
                <div class="answer">
                    <input type="text" name="answers[\${questionCount}][]" required>
                    <input type="radio" name="is_correct[\${questionCount}]" value="0" checked> No
                    <input type="radio" name="is_correct[\${questionCount}]" value="1"> Yes
                </div>
                <div class="answer">
                    <input type="text" name="answers[\${questionCount}][]" required>
                    <input type="radio" name="is_correct[\${questionCount}]" value="0" checked> No
                    <input type="radio" name="is_correct[\${questionCount}]" value="1"> Yes
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', questionHTML);
        questionCount++;
    });
</script>

</body>
