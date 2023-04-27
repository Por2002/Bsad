<?php
require_once('components.php');
include('server.php');
session_start();
if (!isset($_SESSION['username'])){
  header('location:login.php');
  
}
if (isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  
  
}
if(isset($_POST['remove'])){
  if($_GET['action']=='remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value['cardid'] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
          }
      }
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
    <link rel="stylesheet" href="style/cart.css">
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
        }

        .trashbox {
            background-color: white;
            border: none;
        }

        .footer-basic {
          margin-top: 200px;
        }
    </style>
    
</head>
<body>
    <?php navhead(); ?>

    <div class="container" id="content">
      <div class="row d-flex justify-content-center align-items-center h-100 mt-1">
         <div class="col-12" id="cart1">
            <div class="card card-registration card-registration-2" style="border-radius: 5px;">
               <div class="card-body p-0">
                  <div class="row g-0">
                     <div class="col-lg-8">
                        <div class="p-5">
                           <div class="d-flex justify-content-between align-items-center mb-5">
                              <h1 class="fw-bold mb-0 text-black">ตะกร้า</h1>
                           </div>
                           <hr class="my-4">
                           <ul class="p-0" id="boxcart">

                                <?php
                                
                                if(isset($_SESSION['cart'])){
                                    $cardidcart = array_column($_SESSION['cart'],'cardid');
                                    $totalqty = 0;
                                    $totalprice = 0;
                                }

                                if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    $sql = "SELECT * from product";
                                    $ret = $db->query($sql);
                                    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                                    foreach ($_SESSION['cart'] as $key => $value){
                                        if($row['proid'] == $value['cardid']){
                                            $fprice = (int)$row['price'];
                                            $cprice = (int)$value['qty'];
                                            floatval(preg_replace('/[^\d.],/', '', '"'.$row['price'].'"'));
                                            $nowprice = $fprice*$cprice;
                                            $totalqty += $cprice;
                                            $totalprice += $nowprice;
                                            echo '<div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="'.$row['pic1'].'" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-black mb-0"><b>'.$row['name'].'</b></h6>
                                                <h6 class="text-muted">'.$row['brand'].'</h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <h6>x'.$value['qty'].'</h6>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0">฿ '.number_format($nowprice,2).'</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end-2">
                                            <form action="cart.php?action=remove&id='.$row['proid'].'" method="post" 
                                                class="cart-item"><button type="submit" name="remove" class="trashbox"><i class="fa-regular fa-trash-can" style="color: red;"></i></button></form>
                                            </div>
                                        </div>
                                        <hr class="my-4">';
                                        }
                                    }
                                    }

                                }
                                else {
                                    echo '<h4 class="text-black">คุณยังไม่มีสินค้าในตะกร้า</h4>
                                    <hr class="my-4">';
                                }
                                ?>

                           </ul>
                           <div class="pt-5">
                              <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>กลับสู่หน้าหลัก</a></h6>
                           </div>
                        </div>
                        
                     </div>

                        <?php
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            echo '<div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">คำสั่งซื้อ</h3>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-uppercase">ยอดรวม</h5>
                                    <h5 id="smallprice">฿ '.number_format($totalprice, 2).'</h5>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-uppercase">สินค้าทั้งหมด</h5>
                                    <h5 id="smallprice"> '.$totalqty.' ชิ้น</h5>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-uppercase">ค่าขนส่ง</h5>
                                    <h5>฿ 100</h5>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">ยอดรวมทั้งหมด</h5>
                                    <h5 id="sumprice">฿ '.number_format($totalprice + 100, 2).'</h5>
                                </div>
                                <a href="checkorder.php"><button type="button" class="btn btn-dark btn-block btn-lg" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-mdb-ripple-color="dark" id="purchase">สั่งซื้อสินค้า</button></a>
                                </div>
                            </div>';
                        }
                        ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>

    <?php footer(); ?>
</body>
</html>