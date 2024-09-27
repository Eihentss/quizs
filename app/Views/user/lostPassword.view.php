<?php require_once "../app/Views/Components/head.php"; ?>
<?php require_once "../app/Views/Components/navbar.php"; ?>

<?php require_once "../app/Views/Components/head.php"; ?>
<div class="h-screen flex justify-center items-center bg-gradient-to-r from-orange-400 via-orange-300 to-white">
    <div class="bg-white shadow-2xl rounded-lg p-10 w-96 border border-orange-300">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-bold text-black-800 mb-6">Login</h1>
            <p class="text-lg text-orange-700">Welcome back! Ready to continue?</p>
        </div>

        <form class="max-w-md mx-auto" method="post"?>
                <div class="mb-4 ">
                    <label for="email" class="block text-sm font-semibold mb-2">Email:</label>
                    <input type="email" value="<?= $_POST["email"] ?? null?>" id="email" name="email" required class="w-full px-4 py-2 border border-black rounded-md focus:outline-none focus:border-blue-500">
                    <button class=" mt-1 w-full bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline" href="" type="submit">Submit</button>
            </div>
            </form>

        <?php if (isset($errors) && $errors != []): ?>
            <div class="mt-6 text-center text-red-500">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-6">
            <a href="/user/register" class="text-orange-600 font-semibold hover:underline">Don't have an account? Register here!</a>
        </div>
    </div>
</div>  

<?php require_once "../app/Views/Components/footer.php"; ?>