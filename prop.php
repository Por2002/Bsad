<?php
require_once('components.php');
include('server.php');
session_start();

if(isset($_POST['add'])){
  if (!isset($_SESSION['username'])){
    header('location:login.php');
    
  }
  if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    
    
  }
    if(isset($_SESSION['cart'])) {
        $itme_array_id = array_column($_SESSION['cart'],"cardid"); 
        if(in_array($_POST['cardid'],$itme_array_id)) {
            $indexa = array_search($_POST['cardid'],$itme_array_id);
            $_SESSION['cart'][$indexa]['qty'] += $_POST['qty'];
        }
        else {
        $item_array = array(
        'cardid'=>$_POST['cardid'],
        'qty' => $_POST['qty']
        );
        $_SESSION['cart'][] = $item_array;
        }

    }
    else {
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
    <link rel="stylesheet" href="style/catdropdown.css">
    <link rel="stylesheet" href="style/lodraka.css">
    <link rel="stylesheet" href="style/product.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
        }

        #quan {
            font-size: 16px;
            margin-top: 30px;
            color: grey;
        }

        #desc {
            font-weight: lighter;
        }

        .input-num {
            width: 40px;
            margin-left: 5px;
            margin-right: 5px;
        }

        #jum {
            font-size: 16px;
            font-weight: lighter;
        }
    </style>
    
    <script>
        $(document).ready(function () {
            $("#men").click(function () {
                $("#panelmen").slideToggle("linear");
                $("#panelwomen").slideUp("linear");
                $("#panelchild").slideUp("linear");
            });
        });
    </script>
</head>
<body>
    <?php navhead(); ?>
    <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;" id="con1">
        <div class="one">
            <div class="row">
                <div class="col-sm">
                    <p class="topic" id="topic">
                        <?php
                        if(isset($_GET['idg'])){
                            $cate = $_GET['idg'];
                            $query = "SELECT * FROM product WHERE proid = '$cate'";
                            $ret = $db->query($query);
                            $row = $ret->fetchArray(SQLITE3_ASSOC);
                            echo $row['name'];
                        }
                        ?>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-2" id="dropdown">

                    <div id="men" class="dropdown-toggle"><b>หมวกกันน็อค</b></div>
                    <div id="panelmen">
                        <p><a href="category.php?cat=ARAI">Arai</a></p>
                        <p><a href="category.php?cat=AGV">Agv</a></p>
                        <p><a href="category.php?cat=BILMOLA">Bilmola</a></p>
                        <p><a href="category.php?cat=BRG">Brg</a></p>
                        <p><a href="category.php?cat=KYT">Kyt</a></p>
                        <p><a href="category.php?cat=SHARK">Shark</a></p>
                        <p><a href="category.php?cat=SHOEI">Shoei</a></p>
                        <p><a href="category.php?cat=X-LITE">X-lite</a></p>
                    </div>
                    <p><a href="category.php?cat=all" ><b style="font-size: 18px;">สินค้าทั้งหมด</b></a></p>
                </div>
                    
                <?php
                if(isset($_GET['idg'])){
      
                    $cate = $_GET['idg'];
                    $query = "SELECT * FROM product WHERE proid = '$cate'";
                    $ret = $db->query($query);
                    $row = $ret->fetchArray(SQLITE3_ASSOC);
                    detail($row['desc'], $row['price'], $row['brand'], $row['pic1'], $row['pic2'], $row['pic3'], $row['pic4'], $row['proid'], $row['quantity']);
                }
                ?>

            </div>
        </div>
    </div>
    <?php footer(); ?>
</body>
</html>