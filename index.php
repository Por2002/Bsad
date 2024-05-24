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
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/bestsell.css">
    <link rel="stylesheet" href="style/promotion.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body>
    <?php navhead(); ?>
    <!-- Carousel -->
    <div class="container p-0">
        <div id="carousel-slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" role="listbox" >
              <div class="carousel-item active">
                <img src="picture/banner_2.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="picture/banner_1.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="picture/banner_3.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slider" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-slider" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>

    <div class="container" style="background-color: white; margin-top: 23px; border-radius: 5px;">
        <div class="row">
            <h4 class="col" style="margin-left: 70px; margin-top: 30px;">สินค้า</h4>
            <a href="category.php?cat=all" class="col" style="margin-left: 900px; margin-top: 30px; color: black; text-decoration: none;"><h4>ดูทั้งหมด</h4></a>
        </div>
        <div class="one" id="bestsell">
          <div class="row" id="colum1">
            <?php

            $query = "SELECT * FROM product ORDER BY name ASC limit 8";
            $ret = $db->query($query);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
            card($row['name'], $row['price'], $row['pic1'], $row['proid'], $row['brand']);
            }
            ?>
          </div>
        </div>
    </div>

    
    <?php footer(); ?>
</body>
</html>