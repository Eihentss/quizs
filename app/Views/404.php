<?php
require_once "../app/Views/Components/head.php";
?>

<div
  class="h-screen flex flex-col justify-center items-center bg-gradient-to-r from-orange-400 via-orange-300 to-white text-black-600">
  <div class="text-center">
    <h1 class="text-8xl font-extrabold mb-6 animate-pulse">404</h1>
    <p class="mb-6 text-2xl">Oops! The page you are looking for doesn't exist.</p>

    <div class="flex justify-center mb-6">
      <svg class="h-24 w-24 text-orange-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
        </path>
      </svg>
    </div>

    <p class="mb-4 text-lg text-gray-700">It seems you've hit a broken link or the page no longer exists.</p>
    <a href="/project"
      class="bg-orange-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-orange-600 transition ease-in-out duration-300">Go
      back to Home</a>
  </div>
</div>