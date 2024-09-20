<body>

<?php
// Pārbauda, vai lietotājs ir "admin"
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
<!-- Add a button for creating a new quiz for admins only -->
<div style="position: absolute; top: 20px; right: 20px;">
    <a href="/quiz/create">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Create Quiz
        </button>
    </a>
</div>
<?php endif; ?>

<h1><?php echo htmlspecialchars($title); ?></h1>

<?php if (isset($quizzes) && !empty($quizzes)): ?>
    <form method="GET" action="/quiz/start">
        <label for="quiz-select">Choose a quiz:</label>
        <select id="quiz-select" name="quiz_id">
            <?php foreach ($quizzes as $quiz): ?>
                <option value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">
                    <?php echo htmlspecialchars($quiz['title']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Start Quiz
        </button>
    </form>
<?php else: ?>
    <p>No quizzes available.</p>
<?php endif; ?>

</body>
</html>
