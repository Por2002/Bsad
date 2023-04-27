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
    <link rel="stylesheet" href="style/ooter.css">
    <link rel="stylesheet" href="style/cart.css">
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
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
                              <h1 class="fw-bold mb-0 text-black">ชำระเงิน</h1>
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
                                        </div>
                                        <hr class="my-4">';
                                        }
                                    }
                                    }
                                }
                                ?>

                           </ul>
                           <div class="pt-5">
                              <h6 class="mb-0"><a href="checkorder.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>ตรวจสอบคำสั่งซื้ออีกครั้ง</a></h6>
                           </div>
                        </div>
                        
                     </div>

                        <?php
                        echo '<div class="col-lg-4 bg-grey">
                            <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">กรอกรายละเอียด</h3>
                            <hr class="my-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-uppercase">ยอดรวมทั้งหมด</h5>
                                <h5 id="sumprice">฿ '.number_format($totalprice + 100, 2).'</h5>
                            </div>
                            <hr class="my-4">
                            <form action="order.php" method="POST">
                              <div class="form-outline mb-2">
                                  <label for="snamelname" class="form-label text-black">ชื่อ-นามสกุล</label>
                                  <input type="text" name="snamelname" required="ต้องกรอกชื่อ-นามสกุล" class="form-control">
                                  
                              </div>
                              <div class="form-outline mb-2">
                                  <label for="phonenum" class="form-label text-black">เบอร์โทร</label>
                                  <input type="text" name="phonenum" required="ต้องกรอกเบอร์โทร" class="form-control">
                                  
                              </div>
                              <div class="form-outline mb-2">
                                  <label for="address" class="form-label text-black">ที่อยู่</label>
                                  <input type="text" name="address" required="ต้องกรอกที่อยู่" class="form-control">
                                  
                              </div>
                              <div class="form-outline mb-2">
                                  <label for="postal" class="form-label text-black">เลขบัตรเดบิต/เครดิต</label>
                                  <input type="text" name="postal" required="ต้องกรอกเลขบัตรเดบิต" class="form-control" minlength="10">
                                  
                              </div>
                              <div class="form-outline mb-2">
                                  <label for="postal" class="form-label text-black">รหัส CVV</label>
                                  <input type="text" name="postal" required="ต้องกรอกรหัส CVV" class="form-control" minlength="3">
                                  
                              </div>
                              <div class="form-outline mb-2">
                                  <label for="postal" class="form-label text-black">วันหมดอายุ</label>
                                  <input type="text" name="postal" required="ต้องกรอกวันหมดอายุ" class="form-control" minlength="5">
                                  
                              </div>
                              <button type="submit" class="btn btn-dark btn-block btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                  data-mdb-ripple-color="dark" id="purchase" name="createpo" value="'.$_SESSION['userid'].'">ยืนยัน</button>
                              </div>
                            </form>
                        </div>';
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