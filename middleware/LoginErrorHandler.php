<?php

class LoginErrorHandler
{
    public function error($conn)
    {
        $email = $password = "";
        $email_err = $password_err = $err = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty(trim($_POST['email']))) {
                $email_err = 'Please enter email';
            } elseif (empty(trim($_POST['password']))) {
                $password_err = 'Please enter password';
            } else {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
            }

            if (empty($email_err) && empty($password_err)) {
                $sql = "SELECT id,email,password FROM users WHERE email = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                $param_email = $email;

                //try to execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                //this means the password is correct. Allow user to login
                                session_start();
                                $_SESSION["email"] = $email;
                                $_SESSION["id"] = $id;
                                $_SESSION["loggedin"] = true;

                                //redirect user to welcome page
                                header("location: /openai/chat");
                            } else {
                                $password_err = 'Password is incorrect';
                            }
                        }
                    } else {
                        $err = 'These credentials are not matched';
                    }
                }
            }
        }

        return array($email_err, $password_err, $err);
        
    }
}