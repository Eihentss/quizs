<?php require_once "../app/Views/Components/head.php"; ?>
<div class="h-screen flex justify-center items-center bg-gradient-to-r from-orange-400 via-orange-300 to-white">
    <div class="bg-white shadow-2xl rounded-lg p-10 w-96 border border-orange-300">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-bold text-black-800 mb-8">Register</h1>
            <p class="text-lg text-orange-700">Join us and elevate your experience!</p>
        </div>

        <form class="space-y-8" method="post">
            <div>
                <label for="username" class="block text-sm font-semibold text-orange-600">Username</label>
                <input type="text" id="username" name="username" value="<?= $_POST["username"] ?? null ?>" required
                    class="w-full px-4 py-3 mt-2 text-gray-800 bg-orange-50 border border-orange-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-200 shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-orange-600">Email</label>
                <input type="email" id="email" name="email" value="<?= $_POST["email"] ?? null ?>" required
                    class="w-full px-4 py-3 mt-2 text-gray-800 bg-orange-50 border border-orange-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-200 shadow-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-orange-600">Password</label>
                <input type="password" id="password" name="password" value="<?= $_POST["password"] ?? null ?>" required
                    class="w-full px-4 py-3 mt-2 text-gray-800 bg-orange-50 border border-orange-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-200 shadow-sm">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-gradient-to-r hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-500 focus:ring-opacity-50 transition-transform transform hover:scale-105 ease-in-out duration-300 shadow-md">Register</button>
        </form>

        <?php if (isset($errors) && $errors != []): ?>
            <div class="mt-6 text-center text-red-500">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-6">
            <a href="/user/login" class="text-orange-600 font-semibold hover:underline">Already have an account? Log in!</a>
        </div>
    </div>
</div>
