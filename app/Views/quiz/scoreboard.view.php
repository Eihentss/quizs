<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex justify-center items-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-5xl w-full">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
            <?php echo htmlspecialchars($title); ?>
        </h1>

        <?php if (!empty($scores)): ?>
            <div class="overflow-x-auto rounded-xl">
                <table class="min-w-full bg-white border border-gray-300 rounded-xl">
                    <thead>
                        <tr class="w-full bg-blue-500 text-white text-left">
                            <th class="py-3 px-6 font-bold uppercase text-sm">Rank</th>
                            <th class="py-3 px-6 font-bold uppercase text-sm">User Name</th>
                            <th class="py-3 px-6 font-bold uppercase text-sm">Score</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($scores as $index => $score): ?>
                            <tr class="<?php echo $index % 2 === 0 ? 'bg-blue-50' : 'bg-white'; ?>">
                                <td class="py-4 px-6 border-b border-gray-300 text-center">
                                    <?php echo htmlspecialchars($index + 1); ?>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-300">
                                    <?php echo htmlspecialchars($score['username']); ?>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-300 text-center">
                                    <?php echo htmlspecialchars($score['score']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600 mt-8">No scores available for this quiz.</p>
        <?php endif; ?>
    </div>

</body>

</html>