<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex justify-center items-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
            <?php echo htmlspecialchars($title); ?>
        </h1>
    </div>

</body>

</html>