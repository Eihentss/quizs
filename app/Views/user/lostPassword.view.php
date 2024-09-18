<?php require_once "../app/Views/Components/head.php"; ?>
<?php require_once "../app/Views/Components/navbar.php"; ?>


<div class="h-screen content-center items-center grid bg-gradient-to-r from-blue-200 from-20% via-gray-100 via%60 to-blue-300 bg-cover bg-no-repeat backdrop-blur-2xl bckdrop-rounded-3xl" >
    <div class="container mx-auto w-4/12  ">
    <div class="backdrop-blur-xl p-4 bg-white/30 shadow-inner shadow-xl ...">
        <div class="text-center mb-8">
            <h1 class="text-3xl mb-4 p-4 font-bold">Lost Password?</h1>
            </div>
            <p class="text-align-right text-center "> Type in Email you've remeber login in with </p>
            <form class="max-w-md mx-auto" method="post"?>
                <div class="mb-4 ">
                    <label for="email" class="block text-sm font-semibold mb-2">Email:</label>
                    <input type="email" value="<?= $_POST["email"] ?? null?>" id="email" name="email" required class="w-full px-4 py-2 border border-black rounded-md focus:outline-none focus:border-blue-500">
                    <button class=" mt-1 w-full bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline" href="" type="submit">Submit</button>
            </div>
            </form>
            <?php
                if (isset($errors) && $errors != []) {
                    foreach ($errors as $error) {
                        echo "<p class='text-red-500'>$error   yo balls are black like</p>";
                    }
                }
            ?>
        </div>
        </div>
        
        <p>GG</p>
    </div>
</div>


    </div>
</div>

<?php require_once "../app/Views/Components/footer.php"; ?>