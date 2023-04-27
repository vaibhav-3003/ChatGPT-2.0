<?php
require_once('database\dbConnection.php');
$request_url = explode('?', $_SERVER['REQUEST_URI'],2);
$title = '';
switch ($request_url[0]) {
    case '/':
        $title = 'ChatGPT | Home';
        break;

    case '/openai/sign-in':
        $title = 'OpenAI | Sign In';
        break;

    case '/openai/sign-up':
        $title = 'OpenAI | Sign Up';
        break;

    case '/openai/chat':
        $title = 'OpenAI | ChatGPT';
        break;

    default:
        $title = '404 | Not Found';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link rel="icon" type="image/png" href="..\resources\assets\logo-color.png">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <!-- index.css -->
    <link rel="stylesheet" href="..\resources\views\components\index.css">

    <!-- 404.css -->
    <link rel="stylesheet" href="..\resources\views\pages\404\404.css">

    <!-- App.css-->
    <link rel="stylesheet" href="..\App.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c13d4a9f3c.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php
        switch ($request_url[0]) {
            case '/':
                require_once('resources\views\pages\home.php');
                break;
        
            case '/openai/sign-in':
                require_once('resources\views\pages\login.php');
                break;
            
            case '/openai/sign-up':
                require_once('resources\views\pages\signup.php');
                break;
            
            case '/openai/chat':
                require_once('resources\views\pages\chat.php');
                break;
                
            default:
                require_once('resources\views\pages\404\404.php');
                break; 
        }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    
</body>
</html>     

