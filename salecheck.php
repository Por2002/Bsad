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
    <link rel="stylesheet" href="style/lodraka.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>

    <style>
        body {
            background-color: #e5e5e5;
            font-family: 'Kanit', sans-serif;
        }
        .status.สั่งซื้อสำเร็จ {
            color: red;
        }
        .status.อยู่ระหว่างการจัดส่ง {
            color: #febd69;
        }
        .status.เสร็จสิ้น {
            color: #198754;
        }
    </style>

</head>
<body>
    <?php navhead(); ?>

    <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px; margin-top: 50px;" id="con1">
        <div class="one">
            <h2 class="fw-bold p-4 text-black">รายละเอียดการสั่งซื้อ</h2>
            
            <?php
            if(isset($_GET['idg'])){
                $cate = $_GET['idg'];

                $sql11 = "SELECT * FROM customerorder where coid = ".($cate)."";
                $ret11 = $db->query($sql11);
                $retc = $db->query($sql11);
                $rowc = $retc->fetchArray(SQLITE3_ASSOC);


                $row11 = $ret11->fetchArray(SQLITE3_ASSOC);
                    
                    $sql12 = "SELECT * FROM customerorder_product where copid = ".($cate)." ";
                    $ret12 = $db->query($sql12);

                    
                
                    while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                        
                        $sql13 = "SELECT * FROM product where proid = ".($row12['ProdID'])."";
                        $ret13 = $db->query($sql13);
                        echo '<p class="p-2 mb-0">เลขที่คำสั่งซื้อ : '.$cate.'</p>';
                        
                        while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){
                            

                            $orpirce = (int)$row13['price'];
                            $orqty = (int)$row12['quantity'];
                            
                            echo '
                            <div class="row">
                                <p class="p-2 mb-0">ชื่อสินค้า : '.$row13['name'].'</p>
                                <p class="p-2 mb-0">จำนวน : '.$row12['quantity'].'</p>
                                <p class="p-2 mb-0">ราคา : '.number_format($orpirce * $orqty, 2).'</p>
                                <p class="p-2 mb-0">วันที่ : '.$row11['date'].'</p>
                                <p class="p-2 mb-0">ชื่อ-ที่อยู่ : '.$row11['namephone'].$row11['address'].'</p>
                                <p class="p-2 mb-0">สถานะ : <span class="status '.$row11['status'].'"> '.$row11['status'].' </span> </p>
                            </div>';
                        }
                    }
                
                
            }

            ?>


        </div>
    </div>

    <?php footer(); ?>
</body>
</html>