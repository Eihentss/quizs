<?php require_once "../app/Views/Components/head.php"; ?>
<div class="h-screen flex justify-center items-center bg-gradient-to-r from-purple-500 via-pink-500 to-red-500">
    <div class="bg-gradient-to-br from-gray-900 to-gray-700 backdrop-blur-lg backdrop-opacity-70 shadow-lg rounded-lg p-8 w-96">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white mb-4">Login</h1>
            <p class="text-gray-300">Welcome back! Ready to continue the game?</p>
        </div>

        <form class="space-y-6" method="post">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
                <input type="text" id="username" name="username" value="<?= $_POST["username"] ?? null ?>" required
                    class="w-full px-4 py-2 mt-2 text-gray-900 bg-white border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition ease-in-out duration-150">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" value="<?= $_POST["password"] ?? null ?>" required
                    class="w-full px-4 py-2 mt-2 text-gray-900 bg-white border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition ease-in-out duration-150">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-500 text-white font-bold py-2 px-4 rounded-md hover:bg-gradient-to-r hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-4 focus:ring-pink-500 focus:ring-opacity-50 transition-transform transform hover:scale-105 ease-in-out duration-300">Login</button>
        </form>

        <?php if (isset($errors) && $errors != []): ?>
            <div class="mt-4 text-center text-red-500">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="/user/register" class="text-pink-300 hover:underline">Don't have an account? Register here!</a>
        </div>
    </div>
</div>