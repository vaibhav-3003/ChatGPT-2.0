<?php
//This code checks if the user is logged in
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('location: /openai/chat');
    exit();
}

require_once 'middleware\LoginErrorHandler.php';
require_once 'database\dbConnection.php';

$errorHandler = new LoginErrorHandler();
$errors = $errorHandler->error($conn);
$email_err = '';
$password_err = '';

if (!empty($errors)) {
    $email_err = $errors[0];
    $password_err = $errors[1];
    $err = $errors[2];
}
?>


<!-- Navbar -->
<nav class="gradient__bg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center">
            <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">OpenAI</span>
        </a>
    </div>
</nav>

<form class="flex flex-col justify-center items-center mb-10" action="" method="post">
    <div class="w-11/12 md:w-3/4 lg:w-1/2 bg-gradient-to-br from-blue-900 to-gray-900 mt-10 rounded-md p-4">
        <h2
            class="text-4xl font-bold bg-gradient-to-r text-center my-3 from-pink-500 to-orange-400 bg-clip-text text-transparent mt-5">
            Sign In to Your Account.</h2>
        <p class="text-xl text-[#FF8A71] text-center my-3 mt-5">Let's get you signed in and straight to the chat.
        </p>
        <div class="mt-16 mb-5 w-11/12 mx-auto">
            <label for="email" class="block mb-2 text-md font-medium text-[#81AFDD]">Email address</label>
            <div class="relative mb-2 mt-3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>

                <input type="email" id="email" name="email" required autocomplete="off"
                    class="block pl-10 w-full rounded-lg border-blue-600 border-2 p-3 bg-transparent focus:border-2 text-white"
                    placeholder="john@example.com">
            </div>
            <p class="text-red-600 text-md font-medium">
                <?php echo !empty($err) ? $err : $email_err ?>
            </p>
        </div>

        <div class="my-10 w-11/12 mx-auto">
            <label for="password" class="block mb-2 text-md font-medium text-[#81AFDD]">Password</label>
            <div class="relative mb-2 mt-3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i class="fa-solid fa-lock text-[#9ca3af]"></i>
                </div>

                <input type="password" id="password" name="password" required autocomplete="off"
                    class="block pl-10 w-full rounded-lg border-blue-600 border-2 p-3 bg-transparent focus:border-2 text-white"
                    placeholder="•••••••••">
            </div>
            <p class="text-red-600 text-md font-medium">
                <?php echo $password_err ?>
            </p>
        </div>
        <div class="w-11/12 mx-auto">
            <p class="text-md text-gray-300">Don't have an account ? <a href="/openai/sign-up"
                    class="text-blue-500 underline decoration-dotted hover:text-blue-400">Sign up and get started!</a>
            </p>
        </div>
        <div class="mt-12 w-11/12 mx-auto">
            <button type="submit"
                class="text-white w-full bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-md px-5 py-2.5 text-center mr-2 mb-2 transition-all hover:rounded-full">Sign
                In</button>
        </div>

    </div>
</form>