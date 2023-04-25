<?php
require_once('components.php');
include('server.php');
session_start();
if (!isset($_SESSION['username'])){
  $_SESSION['regmsg'] = 'You must log in first';
  
}
if (isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  
}
if(isset($_POST['add'])){
  if(isset($_SESSION['cart'])){
    $itme_array_id = array_column($_SESSION['cart'],"cardid"); 
    if(in_array($_POST['cardid'],$itme_array_id)){
      $indexa = array_search($_POST['cardid'],$itme_array_id);
       $_SESSION['cart'][$indexa]['qty'] +=$_POST['qty'];
    }
    else{
    $item_array = array(
      'cardid'=>$_POST['cardid'],
      'qty' => $_POST['qty']
    );
    $_SESSION['cart'][] = $item_array;
    }
  }else{
    $item_array = array(
      'cardid'=>$_POST['cardid'],
      'qty' => $_POST['qty']
    );
    $_SESSION['cart'][0] = $item_array;
 
   }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,300;1,900&family=Prompt:wght@300&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="footer.css">
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body>
    <?php navhead() ?>
    <h1>Kuy</h1>
    <h2>kuy</h2>
    <?php footer(); ?>
</body>
</html>