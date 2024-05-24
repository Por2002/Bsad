<?php
require_once('components.php');
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
    </style>
</head>
<body>
    <?php navhead(); ?>
    <section class="home-wrapper-1 py-5">
            <div class="container-xxl text-center">
                <div class="row w-50 m-auto">
                    <div class="col-12">
                        <div class="header">
            <h1 class="text-black mb-4">ลงชื่อเข้าใช้</h1>
        </div>
        <form action="login_db.php" method="POST">
            <div class="form-outline mb-3">
                <label class="form-label text-black" for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username" required="Username is required" class="form-control">
                
            </div>
            <div class="form-outline mb-3">
                <label for="password" class="form-label text-black">รหัสผ่าน</label>
                <input type="password" name="password" required="Password is required" class="form-control">
                
            </div>
            
                <div class="error">
                    <h3 class="text-danger mb-4">
                        <?php
                        if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        }
                        ?>
                    </h3>
                </div>
            <button type='submit' name="login" class='btn btn-success btn-block mb-4'>เข้าสู่ระบบ</button>
            <div class="text-center">
            <p class="text-black">ยังไม่มีบัญชีผู้ใช้ ? <a class="text-black" href="reg.php">สมัครที่นี่</a></p>
            </div>
        </form>
                    </div>
                </div>
            </div>
        </section>
    
    <?php footer(); ?>
</body>
</html>