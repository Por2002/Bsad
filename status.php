<?php
require_once('components.php');
include('server.php');
session_start();
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

    echo '
        <section class="home-wrapper-1 py-5">
            <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;">
                <h2 class="text-black p-3 m-0">จัดการสถานะการจัดส่ง</h2>
                <div class="row">
                    <div class="col-6">
                        <form action="" method="POST" class="mb-0">
                            <p class="Text-black mb-2">รหัสคำสั่งซื้อ</p>
                            <input type="text" name="remordid" required="ID is required" class="form-control" placeholder="ID">
                            <p class="Text-black mb-2">สถานะ</p>

                            <div class="form-outline mb-4">
                                <select class="form-select form-select-lg my-1" aria-label=".form-select-lg example" name="selectstatus">
                                    <option selected value="">---</option>
                                    <option value="สั่งซื้อสำเร็จ">สั่งซื้อสำเร็จ</option>
                                    <option value="อยู่ระหว่างการจัดส่ง">อยู่ระหว่างการจัดส่ง</option>
                                    <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <button type="submit" name="updatestatus" class="btn btn-success btn-block">ยืนยัน</button>
                                </div>
                            </div>

                            <div class="row">
                                <h6 class="mb-3"><a href="account.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>กลับ</a></h6>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;">
                <div class="row">
                    <table class="table bg-white">
                    <thead>
                        <tr>
                            <th style="width: 10%;">รหัสคำสั่งซื้อ</th>
                            <th style="width: 40%;">ชื่อสินค้า</th>
                            <th style="width: 10%;">จำนวน</th>
                            <th style="width: 20%;">ราคา</th>
                            <th style="width: 20%;">สถานะ</th>
                        </tr>
                    </thead>';

                    $sql11 = "SELECT * FROM customerorder";
                    $ret11 = $db->query($sql11);
                    $retc = $db->query($sql11);
                    $rowc = $retc->fetchArray(SQLITE3_ASSOC);
                    
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
                                    </tbody>';
                            }
                        }
                    
                    }
                    echo '</table>';
            echo '
                </div>
            </div>
        </section>';
        
        if (isset($_POST['updatestatus'])) {
            $oidup = $_POST['remordid'];
            $statusup = $_POST['selectstatus'];
            $query = "UPDATE customerorder SET status = '$statusup' WHERE coid = '$oidup'";
            $db->exec($query);
          }
        ;
        
        

    ?>

<?php footer(); ?>
</body>
</html>