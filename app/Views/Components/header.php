<?php
    $isLoggedIn = isset($_SESSION['user']); // Check if user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Site</title>
    <link href="/public/css/tailwind.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-green-600 text-white px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold">QuizMaster</a>

        <!-- Links -->
        <ul id="nav-links" class="hidden md:flex space-x-4">
            <?php if ($isLoggedIn): ?>
                <li><a href="/" class="hover:bg-green-700 px-3 py-2 rounded">Home</a></li>
                <li><a href="/quiz/list" class="hover:bg-green-700 px-3 py-2 rounded">Quizzes</a></li>
                <li><a href="/user/results" class="hover:bg-green-700 px-3 py-2 rounded">Results</a></li>
                <li><a href="/user/logout" class="hover:bg-green-700 px-3 py-2 rounded">Logout</a></li>
            <?php else: ?>
                <li><a href="/user/login" class="hover:bg-green-700 px-3 py-2 rounded">Login</a></li>
                <li><a href="/user/register" class="hover:bg-green-700 px-3 py-2 rounded">Register</a></li>
            <?php endif; ?>
        </ul>

        <!-- Hamburger Menu (for mobile) -->
        <div id="mobile-menu" class="md:hidden flex flex-col cursor-pointer space-y-1">
            <div class="w-6 h-0.5 bg-white"></div>
            <div class="w-6 h-0.5 bg-white"></div>
            <div class="w-6 h-0.5 bg-white"></div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu-content" class="md:hidden fixed inset-0 bg-green-600 text-white flex flex-col items-center space-y-4 pt-16 hidden">
        <?php if ($isLoggedIn): ?>
            <a href="/" class="hover:bg-green-700 px-3 py-2 rounded">Home</a>
            <a href="/quiz/list" class="hover:bg-green-700 px-3 py-2 rounded">Quizzes</a>
            <a href="/user/results" class="hover:bg-green-700 px-3 py-2 rounded">Results</a>
            <a href="/user/logout" class="hover:bg-green-700 px-3 py-2 rounded">Logout</a>
        <?php else: ?>
            <a href="/user/login" class="hover:bg-green-700 px-3 py-2 rounded">Login</a>
            <a href="/user/register" class="hover:bg-green-700 px-3 py-2 rounded">Register</a>
        <?php endif; ?>
    </div>

    <script>
        // Toggle the mobile menu
        const menuToggle = document.getElementById('mobile-menu');
        const menuContent = document.getElementById('mobile-menu-content');

        menuToggle.addEventListener('click', function() {
            menuContent.classList.toggle('hidden');
        });
    </script>
    
</body>
</html>
