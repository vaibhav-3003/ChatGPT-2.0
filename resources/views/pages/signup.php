<?php
//This code checks if the user is logged in
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('location: /openai/chat');
    exit();
}

require_once 'middleware\RegisterErrorHandler.php';
require_once 'database\dbConnection.php';

$errorHandler = new RegisterErrorHandler();
$errors = $errorHandler->error($conn);
$email_err = '';
$password_err = '';

if (!empty($errors)) {
    $email_err = $errors[0];
    $password_err = $errors[1];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In and Get Started | OpenAI</title>
</head>

<body class="bg-gradient-to-r from-purple-300 to-orange-300 h-screen w-screen">
    <div class="flex justify-center items-center h-screen">
        <div class="bg-gray-800 w-4/5 sm:w-3/4 h-auto sm:h-11/12 rounded-lg">
            <nav class="py-4 px-5 sm:px-0">
                <a class="text-white text-lg md:pl-10 sm:pl-5" href="/">OpenAI</a>
            </nav>
            <div class="flex">
                <div class="w-0 lg:w-1/2 mt-5 invisible lg:visible">
                    <div class="w-full h-full flex flex-col justify-center items-center">
                        <p class="mb-4 text-md text-orange-300 w-fit mx-16 text-center">SignUp and get started with</p>
                        <h1
                            class="text-6xl bg-gradient-to-r from-purple-500 to-orange-500 bg-clip-text text-transparent font-bold">
                            ChatGPT 2.0</h1>
                        <p class="mt-4 text-md text-orange-400 w-fit mx-16 text-center">Transforming Conversations,
                            Empowering Minds with ChatGPT 2.0</p>
                    </div>
                </div>

                <div class="px-5 py-4 sm:pb-10 w-full lg:w-1/2 mt-5 sm:mt-10 md:px-10 sm:mx-3 mb-2" id="signup_div">
                    <p class="uppercase text-gray-400 font-medium text-sm">Start for free</p>
                    <h1 class="text-4xl font-medium text-white pt-2">Create new account<span
                            class="text-orange-500">.</span></h1>
                    <p class="text-gray-400 font-medium text-sm pt-2">Already A Member?<a class="text-orange-500 pl-1"
                            href="/openai/sign-in">Log In</a></p>

                    <form action="" method="post">
                        <div class="mt-7 w-full sm:w-11/12 md:w-full">
                            <div class="w-full mt-5">
                                <div class="bg-gray-700 px-5 py-1 rounded-xl sm:mt-0" id="email_div">
                                    <p class="text-gray-500 text-sm">Email</p>
                                    <input type="email" name="email"
                                        class="bg-transparent border-0 outline-0 focus:ring-0 px-0 py-1 text-white text-sm w-full" id="email"
                                        autocomplete="off" required>
                                </div>
                                <p class="text-sm text-red-500 mt-1 ml-2" id="email_err"><?php echo $email_err ?></p>
                            </div>
                            <div class="w-full mt-5">
                                <div class="bg-gray-700 px-5 py-1 rounded-xl sm:mt-0" id="password_div">
                                    <p class="text-gray-500 text-sm">Password</p>
                                    <input type="password" name="password"
                                        class="bg-transparent border-0 outline-0 focus:ring-0 px-0 py-1 text-white text-sm w-full"
                                        id="password" autocomplete="off" required>
                                </div>
                                <p class="text-sm text-red-500 mt-1 ml-2" id="password_err"><?php echo $password_err ?></p>
                            </div>
                            <div class="w-full mt-7">
                                <button type="submit"
                                    class="bg-gradient-to-r from-purple-500 to-orange-500 w-full py-3 rounded-full text-white font-bold shadow-md shadow-orange-400 text-md hover:bg-gradient-to-l focus:ring-orange-500 focus:ring"
                                    id="signup_button">Create account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let signup_div = document.getElementById('signup_div');
        let signup_button = document.getElementById('signup_button');

        let email_div = document.getElementById('email_div');
        let password_div = document.getElementById('password_div');

        let email = document.getElementById('email');
        let password = document.getElementById('password');

        email.addEventListener("focus", () => {
            email_div.classList.add('border-orange-500', 'border');
        });
        email.addEventListener("blur", () => {
            email_div.classList.remove('border-orange-500', 'border');
        });
        password.addEventListener("focus", () => {
            password_div.classList.add('border-orange-500', 'border');
        });
        password.addEventListener("blur", () => {
            password_div.classList.remove('border-orange-500', 'border');
        });

    </script>
</body>

</html>