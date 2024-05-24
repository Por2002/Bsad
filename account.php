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
    <section class="home-wrapper-1 py-5">
        <div class="container-xxl">
            <div class="row">
                <div class="col-6 bg-white rounded p-5">
                    <h3 class="fw-bold p-2 text-black">ข้อมูลผู้ใช้</h3>
                    <h3 class="p-2">ชื่อผู้ใช้ : <?php echo $_SESSION['username'] ;?></h3>
                    <h3 class="p-2">ตำแหน่ง : <?php echo $_SESSION['role'] ;?></h3>

                    
                    <?php

                    if ($_SESSION['role'] == 'warehouse'){
                        echo '<a href="adminpage.php" class="btn btn-success btn-block mt-3">จัดการข้อมูลสินค้า</a>';
                        echo '<a href="status.php" class="btn btn-success btn-block mt-3 ms-3">จัดการสถานะการจัดส่ง</a>';
                    }

                    elseif ($_SESSION['role'] == 'sale'){
                        echo '<a href="order.php" class="btn btn-success btn-block mt-3">แสดงข้อมูลการสั่งซื้อ</a>';
                    }
                    ?>


                    <div class="pt-5">
                        <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>กลับสู่หน้าหลัก</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <?php footer(); ?>
</body>
</html>