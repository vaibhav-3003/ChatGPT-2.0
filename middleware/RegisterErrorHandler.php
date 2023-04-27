<?php

class RegisterErrorHandler
{
    public function error($conn)
    {
        $email = $password = '';
        $email_err = $password_err = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            //check if username is empty
            if (empty(trim($_POST['email']))) {
                $email_err = "Email must not be empty";
            } else {
                
                $sql = "SELECT id from users WHERE email = ?";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $param_email);

                    //set the value of param email
                    $param_email = trim($_POST['email']);

                    //try to execute this statement
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            $email_err = "This email is already registered";
                        } else {
                            $email = trim($_POST['email']);
                        }
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo 'Something went wrong';
                }
            }
        
            //Check for password
            if (empty(trim($_POST['password']))) {
                $password_err = "Password must not be empty";
            } elseif (strlen(trim($_POST['password'])) < 5) {
                $password_err = "Password must not be less than 5 chars";
            } else {
                $password = trim($_POST['password']);
            }

            //if there were no error save the data to database
            if (empty($email_err) && empty($password_err)) {
                $sql = "INSERT INTO users (email,password) VALUES (?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

                    //set these parameters
                    $param_email = $email;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);

                    //try to execute the query
                    if (mysqli_stmt_execute($stmt)) {
                        header("location: /openai/sign-in");
                        exit();
                    } else {
                        echo 'Something went wrong... Cannot redirect';
                    }
                } else {
                    echo "Error: " + mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            }
            else{
                return array($email_err,$password_err);
            }

            mysqli_close($conn);
        }
    }
}