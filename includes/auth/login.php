<?php

    $database=connectToDB();

    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email) || empty($password)){
        $error = "Please enter field";
    }else{
        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $database->prepare($sql);
        $query -> execute([
           'email' => $email
        ]);
        $user = $query->fetch();
        if ( empty( $user ) ) {
            $error = "User doesnt exist la";
        } else {
            if ( password_verify( $password, $user["password"] ) ) {
                $_SESSION["user"] = $user;

                header("Location: /dashboard");
                exit;
            } else {
                $error = "Don't cincai hack ah";
            }
        }

    }
    
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /login");
        exit;
    }
?>