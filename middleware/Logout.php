<?php

class Logout{
    public function logout(){
        session_start();
        $_SESSION = array();
        session_destroy();
        header('location: /openai/sign-in');
    }
}