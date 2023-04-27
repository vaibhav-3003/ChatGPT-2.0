<?php
//This code checks if the user is logged in
session_start();

$email = '';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $email = $_SESSION['email'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenAI | Home</title>
</head>

<body>
    <div class="gradient__bg">
        <!-- Navbar -->
        <?php include 'resources\views\components\navbar\navbar.php' ?>
        <!-- Header -->
        <?php include 'resources\views\components\header\header.php' ?>
    </div>

    <!-- Brand -->
    <?php include 'resources\views\components\brand\brand.php' ?>

    <!-- WhatGPT3 -->
    <?php include 'resources\views\components\whatGPT3\whatGPT3.php' ?>

    <!-- Features -->
    <?php include 'resources\views\components\features\features.php' ?>

    <!-- Possibility -->
    <?php include 'resources\views\components\possibility\possibility.php' ?>

    <!-- CTA -->
    <?php include 'resources\views\components\cta\cta.php' ?>

    <!-- Footer -->
    <?php include 'resources\views\components\footer\footer.php' ?>


</body>