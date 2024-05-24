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

    <?php 
    
    if(isset($_POST['createpo'])){
        $namenum = $_POST['snamelname'] . " " . $_POST['phonenum'];
        $address = $_POST['address'];
        $oddate = date("Y-m-d h:i:sa");
        $sql1 = "INSERT INTO customerorder (id,date,namephone,address,status) VALUES (".($_SESSION['userid']).",\"$oddate\",\"$namenum\",\"$address\",\"สั่งซื้อสำเร็จ\")";
        $db->exec($sql1);
        $sql2 = "SELECT MAX(coid) as maxid FROM customerorder";
        $ret = $db->query($sql2);
        $row = $ret->fetchArray(SQLITE3_ASSOC);
        $lastrowid = $row['maxid'];
    
        
        if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $value){
            $ido = $value['cardid'];
            $qtyo = $value['qty'];
            $sql3 = "INSERT INTO customerorder_product (copid,ProdID,quantity) VALUES ('$lastrowid','$ido','$qtyo')";
            $db->exec($sql3);
            
            $sql4 = "UPDATE product SET quantity = quantity - $qtyo where proid = $ido";
            $db->exec($sql4);
    
        }}
        unset($_SESSION['cart']);
    }
    
    ?>

<section class="home-wrapper-1 py-5">
    <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;">
        <div class="row">
            <div class="">

                    <?php
                    if ($_SESSION['role'] == 'customer') {
                        $sql11 = "SELECT * FROM customerorder where id = ".($_SESSION['userid'])." and status in ('อยู่ระหว่างการจัดส่ง', 'สั่งซื้อสำเร็จ', 'เสร็จสิ้น')";
                        $ret11 = $db->query($sql11);
                        $retc = $db->query($sql11);
                        $rowc = $retc->fetchArray(SQLITE3_ASSOC);

                        if(empty($rowc)){
                            echo '<div>
                            <h1 class="text-black p-5">คุณไม่มีประวัติการสั่งซื้อ</h1>
                            </div>';
                        }
                        echo '<table class="table bg-white">
                        <thead>
                            <tr>
                                <th style="width: 10%;">รหัสคำสั่งซื้อ</th>
                                <th style="width: 40%;">ชื่อสินค้า</th>
                                <th style="width: 10%;">จำนวน</th>
                                <th style="width: 20%;">ราคา</th>
                                <th style="width: 20%;">สถานะ</th>
                            </tr>
                        </thead>';

                        while($row11 = $ret11->fetchArray(SQLITE3_ASSOC)){
                            
                            $sql12 = "SELECT * FROM customerorder_product where copid = ".($row11['coid'])." ";
                            $ret12 = $db->query($sql12);
                        
                            while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                                
                                $sql13 = "SELECT * FROM product where proid = ".($row12['ProdID'])."";
                                $ret13 = $db->query($sql13);
                                
                                while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){
                                    

                                    $orpirce = (int)$row13['price'];
                                    $orqty = (int)$row12['quantity'];
                                    echo '<tbody>
                            <tr>
                            <td>'.$row11['coid'].'</td>
                            <td ><img style="width: 15%;" src="'.$row13['pic1'].'" class="img-fluid"> '.$row13['name'].'</td>
                            <td>'.$row12['quantity'].'</td>
                            <td>'.number_format($orpirce * $orqty, 2).'</td>
                            <td class="status '.$row11['status'].'">'.$row11['status'].'</td>
                            
                            </tr>
                            </tbody>
                            ';
                                }
                            }
                        
                        }
                        echo '</table>';
                    }
                    
                    if ($_SESSION['role'] == 'warehouse') {
                        $sql11 = "SELECT * FROM customerorder";
                        $ret11 = $db->query($sql11);
                        $retc = $db->query($sql11);
                        $rowc = $retc->fetchArray(SQLITE3_ASSOC);

                        if(empty($rowc)){
                            echo '<div>
                            <h1 class="text-black p-5">ไม่มีคำสั่งซื้อ</h1>
                            </div>';
                        }
                        echo '<table class="table bg-white">
                        <thead>
                            <tr>
                                <th style="width: 10%;">รหัสคำสั่งซื้อ</th>
                                <th style="width: 40%;">ชื่อสินค้า</th>
                                <th style="width: 10%;">จำนวน</th>
                                <th style="width: 20%;">ราคา</th>
                                <th style="width: 20%;">สถานะ</th>
                            </tr>
                        </thead>';
    
                        while($row11 = $ret11->fetchArray(SQLITE3_ASSOC)){
                            
                            $sql12 = "SELECT * FROM customerorder_product where copid = ".($row11['coid'])." ";
                            $ret12 = $db->query($sql12);
                           
                            while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                                
                                $sql13 = "SELECT * FROM product where proid = ".($row12['ProdID'])."";
                                $ret13 = $db->query($sql13);
                                
                                while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){
                                    
    
                                    $orpirce = (int)$row13['price'];
                                    $orqty = (int)$row12['quantity'];
                                    echo '<tbody>
                              <tr>
                              <td>'.$row11['coid'].'</td>
                              <td><img style="width: 15%;" src="'.$row13['pic1'].'" class="img-fluid"> '.$row13['name'].'</td>
                              <td>'.$row12['quantity'].'</td>
                              <td>'.number_format($orpirce * $orqty, 2).'</td>
                              <td class="status '.$row11['status'].'">'.$row11['status'].'</td>
                              
                              </tr>
                              </tbody>
                              ';
                                }
                            }
                        
                        }
                        echo '</table>';
                    }

                    if ($_SESSION['role'] == 'sale') {
                        $sql11 = "SELECT * FROM customerorder";
                        $ret11 = $db->query($sql11);
                        $retc = $db->query($sql11);
                        $rowc = $retc->fetchArray(SQLITE3_ASSOC);

                        if(empty($rowc)){
                            echo '<div>
                            <h1 class="text-black p-5">ไม่มีคำสั่งซื้อ</h1>
                            </div>';
                        }
                        echo '<table class="table bg-white">
                        <thead>
                            <tr>
                                <th style="width: 10%;">รหัสคำสั่งซื้อ</th>
                                <th style="width: 40%;">ชื่อสินค้า</th>
                                <th style="width: 10%;">จำนวน</th>
                                <th style="width: 20%;">ราคา</th>
                                <th style="width: 20%;">สถานะ</th>
                            </tr>
                        </thead>';
    
                        while($row11 = $ret11->fetchArray(SQLITE3_ASSOC)){
                            
                            $sql12 = "SELECT * FROM customerorder_product where copid = ".($row11['coid'])." ";
                            $ret12 = $db->query($sql12);
                           
                            while($row12 = $ret12->fetchArray(SQLITE3_ASSOC)){
                                
                                $sql13 = "SELECT * FROM product where proid = ".($row12['ProdID'])."";
                                $ret13 = $db->query($sql13);
                                
                                while($row13 = $ret13->fetchArray(SQLITE3_ASSOC)){
                                    
    
                                    $orpirce = (int)$row13['price'];
                                    $orqty = (int)$row12['quantity'];
                                    echo '<tbody>
                              <tr>
                              <td>'.$row11['coid'].'</td>
                              <td> <a href="salecheck.php?idg='.$row11['coid'].'" style="color: black;"><img style="width: 15%;" src="'.$row13['pic1'].'" class="img-fluid">'.$row13['name'].'</a> </td>
                              <td>'.$row12['quantity'].'</td>
                              <td>'.number_format($orpirce * $orqty, 2).'</td>
                              <td class="status '.$row11['status'].'">'.$row11['status'].'</td>
                              
                              </tr>
                              </tbody>
                              ';
                                }
                            }
                        
                        }
                        echo '</table>';
                    }
                
                    ?>
            </div>
        </div>
    </div>
</section>

    <?php footer(); ?>
</body>
</html>