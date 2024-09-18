<?php
require_once "../app/Views/Components/head.php";
?>

<div class="h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">
  <div class="text-center">
    <h1 class="text-8xl font-bold mb-4 animate-pulse">404</h1>
    <p class="mb-6 text-2xl">Oops! The page you are looking for doesn't exist.</p>

    <div class="flex justify-center mb-6">
      <svg class="h-24 w-24 text-red-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
      </svg>
    </div>

    <p class="mb-4 text-lg text-gray-200">It seems you've hit a broken link or the page no longer exists.</p>
    <a href="/" class="bg-white text-blue-600 font-bold py-2 px-4 rounded-md shadow-md hover:bg-blue-100 transition ease-in-out duration-300">Go back to Home</a>
  </div>
</div>