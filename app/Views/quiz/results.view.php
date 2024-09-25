    <?php require_once "../app/Views/Components/head.php"; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($title); ?></title>
        <style>
            /* Style for the Submit button */
            .submit-btn {
                background: linear-gradient(to right, #a7c5eb, #89b0e4, #72a0e0); /* Baby blue gradient */
                color: white;
                font-weight: bold;
                border-radius: 50px;
                padding: 12px 30px;
                font-size: 1.25rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .submit-btn:hover {
                background: linear-gradient(to right, #89b0e4, #72a0e0, #5a90dc); /* Darker baby blue on hover */
                transform: translateY(-5px); /* Lifting effect */
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow */
            }
        </style>
    </head>
    <body class="bg-gradient-to-r from-[#89CFF0] to-white flex justify-center items-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
            Congratulations!
        </h1>

        <p class="text-center text-2xl text-gray-700">You got <strong class="text-green-400"><?php echo $correctAnswers; ?></strong> correct out of <strong><?php echo $totalQuestions; ?></strong> questions.</p>

        <div class="bg-white shadow-xl rounded-2xl p-10 max-w-3xl w-full mt-8">
            <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">RESULTS</h1>
            
            <div class="flex justify-center mt-12 space-x-4">
                <a href="/quiz/start?quiz_id=<?php echo $quizId; ?>" class="submit-btn">
                    Restart Quiz
                </a>
                <a href="/project" class="submit-btn">
                    Choose Another Quiz
                </a>
            </div>
        </div>  
    </div>

    </body>
    </html>
