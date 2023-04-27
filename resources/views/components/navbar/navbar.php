<?php

require_once 'middleware/Logout.php';
if(isset($_POST['logout'])){
  $logout = new Logout();
  $logout ->logout();
  exit();
}

if(isset($_POST['get-started'])){
  header('location: /openai/sign-in');
  exit();
}
?>
<nav class="gradient__bg">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">OpenAI</span>
    </a>
    <div class="flex items-center md:order-2">
      <?php
      if (empty($email)) {
        echo '
        <form action="" method="post">
          <button type="submit" name="get-started" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">Get Started</button>
        </form>';
      } else {
        echo '
        <div class="border px-2 py-1 rounded-full border-gray-400 cursor-pointer" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom" data-tooltip-target="tooltip-left" data-tooltip-placement="left">
          <i class="fa-regular fa-user text-gray-400"></i>
        </div>
        <div id="tooltip-left" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-[#012349]">
          '.$email.'
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-300">'.$email.'</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          
          <li>
            <form action="" method="post">
              <button type="submit" name="logout" class="block text-start w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</button>
            </form>
          </li>
        </ul>
      </div>
        ';
      }
      ?>

      
      <button data-collapse-toggle="mobile-menu-2" type="button"
        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="mobile-menu-2" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
      <ul
        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 md:mt-0 md:border-0  dark:bg-transparent dark:border-gray-700">
        <li>
          <a href="#home"
            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
            x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Home</a>
        </li>
        <li>
          <a href="#wgpt3"
            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
            x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">What
            is GPT3?</a>
        </li>
        <li>
          <a href="#openai"
            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
            x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">OpenAI</a>
        </li>
        <li>
          <a href="#case_studies"
            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
            x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Case
            Studies</a>
        </li>
      </ul>
    </div>

  </div>
</nav>