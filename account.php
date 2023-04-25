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
    <?php navhead(); ?>
    <section class="home-wrapper-1 py-5">
<div class="container-xxl">
    <div class="row">
        <div class="col-5 bg-white rounded p-5">
    <h3 class="mb-4">ข้อมูลผู้ใช้</h3>
    <h3 class="mb-4">Username : <?php echo $_SESSION['username'] ;?></h3>
    <h3 class="mb-4">ตำแหน่ง : <?php echo $_SESSION['role'] ;?></h3>

</h3>

<?php if ($_SESSION['role'] == 'seller' or $_SESSION['role'] == 'warehouse'){
  echo '<a href="adminpage.php" class="btn btn-primary btn-block mb-4">Manage Data</a>';
} 
$sql = "SELECT count(coid) FROM customerorder WHERE id = ".$_SESSION['userid']." and status in ('in progress', 'new')";
    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);?>
        </div>
        <div class="col-7">
            <div class="row mx-4 mb-4 bg-white rounded p-5">
                <a href="order.php"><h3>กำลังดำเนินการอีก <?=$row['count(coid)']?> รายการ</h3></a>
            </div>

        </div>
    </div>
</div>
      </section>    
    <?php footer(); ?>
</body>
</html>