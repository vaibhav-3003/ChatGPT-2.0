<?php
//This code checks if the user is logged in
session_start();

if (!isset($_SESSION['loggedin'])) {
  header('location: /openai/sign-in');
  exit();
}

$content = array(
  'examples' => array(
    'Explain quantum computing in simple terms',
    'Got any creative ideas for a 10 year old’s birthday?',
    'How do I make an HTTP request in Javascript?',
  ),
  'capabilities' => array(
    'Remembers what user said earlier in the conversation',
    'Allows user to provide follow-up corrections',
    'Trained to decline inappropriate requests',
  ),
  'limitations' => array(
    'May occasionally generate incorrect information',
    'May occasionally produce harmful instructions or biased content',
    'Limited knowledge of world and events after 2021',
  ),
)
  ?>



  <div class="bg-gradient-to-r from-purple-300 to-orange-300 h-screen w-screen flex justify-center items-center p-5">
    <div id="app" class="w-full h-full bg-gray-800 flex flex-col items-center justify-between rounded-lg">
      <div id="chat_container"
        class="flex-1 w-full h-full overflow-y-scroll flex flex-col gap-2.5 scrollbar-none scroll-smooth justify-center items-center">

        <div
          class="sm:visible md:visible lg:visible invisible flex flex-col justify-center items-center mx-auto mt-10 p-4 w-11/12 lg:w-3/4"
          id="info">
          <h2 class="gradient__text text-4xl text-center font-bold">ChatGPT-2.0</h2>
          <div class="w-full p-3 flex justify-between mt-4">
            <?php

            foreach ($content as $key => $value) {
              $idPrefix = ($key == "examples") ? "example_" : '';
              $cursor = ($key == "examples") ? 'cursor-pointer' : '';
              $hover = ($key == "examples") ? 'hover:bg-gray-900' : '';
              $arrow = ($key == "examples") ? '&rarr;' : '';
              echo '<div class="w-1/3">
            <h3 class="text-center text-xl text-orange-500 mt-2 mb-6 capitalize">' . $key . '</h3>
            <div class="w-4/5 mx-auto bg-gray-700 py-3 my-3 rounded-lg ' . $cursor . ' ' . $hover . '" id ="' . $idPrefix . '1">
              <p class="text-gray-200 text-center w-full px-3 mx-auto text-sm">"' . $value[0] . '"' . $arrow . '</p>
            </div>
            <div class="w-4/5 mx-auto bg-gray-700 px-2 py-3 my-3 rounded-lg ' . $cursor . ' ' . $hover . '" id="' . $idPrefix . '2">
              <p class="text-gray-200 text-center w-full px-3 mx-auto text-sm">"' . $value[1] . '"' . $arrow . '</p>
            </div>
            <div class="w-4/5 mx-auto bg-gray-700 px-2 py-3 my-3 rounded-lg ' . $cursor . ' ' . $hover . '" id="' . $idPrefix . '3">
              <p class="text-gray-200 text-center w-full px-3 mx-auto text-sm">"' . $value[2] . '"' . $arrow . '</p>
            </div>
          </div>';

            }

            ?>
          </div>
        </div>

      </div>

      <form class="w-11/12 bg-gray-700 rounded-md my-3 p-0.5 drop-shadow-2xl relative z-20" id="form">
        <div class="flex items-end rounded-md bg-gray-50 dark:bg-gray-700 py-0.5 z-10">
          <textarea id="chat" rows="1" name="prompt"
            class="block overflow-y-auto resize-none w-full p-2.5 text-md text-gray-700 bg-white rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-0 dark:placeholder-gray-400 dark:text-white dark:focus:ring-0 dark:focus:border-0 flex-grow"
            placeholder="Send a message..."></textarea>
          <button type="submit"
            class="inline-flex justify-end items-end p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
            <svg aria-hidden="true" class="w-5 h-5 rotate-90 fill-orange-400" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
              </path>
            </svg>
            <span class="sr-only">Send message</span>
          </button>
        </div>
      </form>
    </div>
  </div>


<script src="..\resources\js\script.js"></scrip>
<script>

  let example_1 = document.getElementById('example_1');
  let example_2 = document.getElementById('example_2');
  let example_3 = document.getElementById('example_3');

  let chat = document.getElementById('chat');

  example_1.addEventListener('click', function () {
    chat.value = "Explain quantum computing in simple terms";
  });
  example_2.addEventListener('click', function () {
    chat.value = "Got any creative ideas for a 10 year old’s birthday?";
  });
  example_3.addEventListener('click', function () {
    chat.value = "How do I make an HTTP request in Javascript?";
  });
</script>