<?php require_once "../app/Views/Components/head.php"; ?>
<body>

<h1><?php echo htmlspecialchars($title); ?></h1>

<?php if (isset($quizzes) && !empty($quizzes)): ?>
    <ul>
        <?php foreach ($quizzes as $quiz): ?>
            <li>
                <strong><?php echo htmlspecialchars($quiz['title']); ?></strong><br>
                <?php echo nl2br(htmlspecialchars($quiz['description'])); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No quizzes available.</p>
<?php endif; ?>

</body>
</html>
