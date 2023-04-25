<?php
session_start();
include('server.php');
$error = array();

if (isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2){
        array_push($error,'Password not match');
        
    }

    $user_check = "SELECT * FROM user WHERE username = '$username' or email = '$email'";
    $ret = $db->query($user_check);
    $row = $ret->fetchArray(SQLITE3_ASSOC);

    if ($row){
        if ($row['username'] == $username){
            array_push($error, 'user name already exist');
        }
        if ($row['email'] == $email){
            array_push($error, 'email already exist');
        }
    }
    if (count($error) == 0){
        $sqlinsert = "INSERT INTO user (username, email, password ,role) VALUES ('$username','$email','$password','customer')";
        $db->exec($sqlinsert);
        header('location:login.php');
    }
    else{
        array_push($error,'User name already exist');
        $_SESSION['error'] = 'User name already exist or Password does not match';
        header('location:reg.php');
    }
}

?>