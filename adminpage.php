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

    <?php
    
    echo '
        <section class="home-wrapper-1 py-5">
            <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;">
                <h2 class="text-black p-3 m-0">จัดการจำนวนสินค้า</h2>
                <form action="" method="POST">
                    <div class="row">
        
        
                        <div class="col-4">
        
                            <div class="form-outline mb-4 mt-2">
                                <input type="text" name="proid" required="ID is required" class="form-control" placeholder="ID สินค้า">
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    

                        <div class="col-4">
            
                            <div class="form-outline mb-4">
                                <input type="text" name="proquan" required="Number" class="form-control" placeholder="จำนวน">
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <button type="submit" name="addpro" class="btn btn-success btn-block" style="width: 50px;">เพิ่ม</button>
                            <button type="submit" name="rempro" class="btn btn-danger btn-block mx-2" style="width: 50px;">ลบ</button>
                        </div>

                    </div>
                </form>

                <h2 class="text-black p-3 m-0">จัดการสินค้าใหม่</h2>
                
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-5">
                                 
                            <div class="form-outline mb-3">
                                <input type="text" name="newproid" required="Username is required" class="form-control" placeholder="ID สินค้า">
                            </div>

                            <div class="form-outline mb-3">
                                <input type="text" name="newproname" required="Username is required" class="form-control" placeholder="ชื่อ">
                            </div>

                            <div class="form-outline mb-3">
                                <input type="text" name="newprodesc" required="Username is required" class="form-control" placeholder="รายละเอียด">
                            </div>

                            <div class="form-outline mb-3">
                                <input type="text" name="newproprice" required="Username is required" class="form-control" placeholder="ราคา">
                            </div>

                            <div class="form-outline mb-3">
                                <input type="text" name="newproqty" required="Username is required" class="form-control" placeholder="จำนวน">
                            </div>

                            <div class="form-outline mb-3">
                                <select class="form-select form-select-lg" aria-label=".form-select-lg example" name="newprocate">
                                    <option value="">แบรนด์</option>
                                    <option value="ARAI">ARAI</option>
                                    <option value="AGV">AGV</option>
                                    <option value="BILMOLA">BILMOLA</option>
                                    <option value="BRG">BRG</option>
                                    <option value="KYT">KYT</option>
                                    <option value="SHARK">SHARK</option>
                                    <option value="SHOEI">SHOEI</option>
                                    <option value="X-LITE">X-LITE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            

                            <div class="form-outline">
                                <input type="file" name="pic[]" required="required" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple="multiple">
                                <label for="pic" class="form-label text-black">รูปภาพ 4 รูป</label>
                            </div>

                            <p class="text-danger m-0">คำเตือน : ไฟล์นามสกุล Jpeg, Jpg, Png เท่านั้น</p>
                            

                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <button type="submit" name="newpro" class="btn btn-success btn-block">ยืนยัน</button>
                        </div>
                    </div>
                    <div class="row">
                        <h6 class="mb-3"><a href="account.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>กลับ</a></h6>
                    </div>
                </form>
            </div>
            <div class="container" style="background-color: white; border-radius: 5px; margin-bottom: 20px;">
                <div class="row">
                    <table class="table bg-white">
                        <tr>
                            <th>ID</th>
                            <th>ชื่อ</th>
                            <th>แบรนด์</th>
                            <th>คงเหลือ</th>
                        </tr>';

                        $query = "SELECT * FROM product";
                        $ret = $db->query($query);
                        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                            echo '
                            <tr>
                                <td>' . $row['proid'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['brand'] . '</td>
                                <td>' . $row['quantity'] . '</td>
                            </tr>';
                        }
                    echo '
                    </table>
                </div>
            </div>
        </section>';
        
        if (isset($_POST['rempro'])) {
            $idpro = $_POST['proid'];
            $quanpro = $_POST['proquan'];
            $quanpro = (int)$quanpro;
            $query = "UPDATE product SET quantity = quantity - $quanpro WHERE proid = '$idpro'";
            $db->exec($query);
        }

        if (isset($_POST['addpro'])) {
            $idpro = $_POST['proid'];
            $quanpro = $_POST['proquan'];
            $quanpro = (int)$quanpro;
            $query = "UPDATE product SET quantity = quantity + $quanpro WHERE proid = '$idpro'";
            $db->exec($query);
        }
        

    ?>

    <?php footer(); ?>
    
</body>
</html>