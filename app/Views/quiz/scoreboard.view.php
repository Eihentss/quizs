<?php require_once "../app/Views/Components/head.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex justify-center items-center min-h-screen">

    <form action="/project" method="POST" class="absolute left-5 top-5 z-50	">
        <button type="submit"
            class="flex items-center hover:scale-105 hover:shadow-3xl bg-white text-black font-semibold py-2 px-5 rounded-lg hover:bg-gray-200 transition-transform duration-300 ease-in-out shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20"
                height="20" viewBox="0 0 256 256" xml:space="preserve">

                <defs>
                </defs>
                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                    <path
                        d="M 68.045 89.028 l 3.93 -4.264 c 1.129 -1.225 1.051 -3.132 -0.174 -4.261 l -37.4 -34.473 c -0.602 -0.555 -0.602 -1.505 0 -2.06 l 37.4 -34.473 c 1.225 -1.129 1.302 -3.037 0.174 -4.261 l -3.93 -4.263 c -1.129 -1.225 -3.037 -1.302 -4.261 -0.174 l -45.609 42.04 c -1.263 1.164 -1.263 3.159 0 4.323 l 45.609 42.04 C 65.008 90.331 66.916 90.253 68.045 89.028 z"
                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                </g>
            </svg>
            <p> back</p>
        </button>
    </form>

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