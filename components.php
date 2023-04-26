<?php
    function navhead(){

        if (isset($_SESSION['username'])) {
            if(isset($_SESSION['cart'])){
              $totalqty = 0;
            foreach ($_SESSION['cart'] as $key => $value){
                  $cprice = (int)$value['qty'];
                  $totalqty += $cprice;
              }
            }
            else{
              $totalqty = "";
            }
          $navh = '<nav class="navbar sticky-top bg-white">
          <div class="container">
              <nav class="navbar navbar-expand">
                  <a class="navbar-brand" href="index.php">
                      <img src="picture/logo.png" width="80" height="50">
                  </a>
                  <div class="collapse navbar-collapse">
                      <div class="navbar-nav">
                          <a class="nav-link" href="category.php?cat=all">สินค้าทั้งหมด</a>
                          <a class="nav-link" href="order.php">รายการสั่งซื้อ</a>
                      </div>
                  </div>
              </nav>
              <nav class="navbar navbar-expand-right">
                  <form class="d-flex m-0" role="search" action="category.php" method="GET">
                      <input class="form-control me-2" type="search" placeholder="ค้นหา" aria-label="Search" id="boxsearch">
                  </form>
                  
                  <button class="navbar-toggler" href="cart.php" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                      <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
                  </button>
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                      <a href="account.php"><i class="fa-solid fa-user fa-xl"></i></a>
                  </button>
                  <p class="text-black"> '.$_SESSION['username'].' </p> <a href="index.php?logout="1"" class="nav-link">Logout</a></p>
              </nav>
          </div>
      </nav>';
        }else {    $navh = '<nav class="navbar sticky-top bg-white">
            <div class="container">
                <nav class="navbar navbar-expand">
                    <a class="navbar-brand" href="index.php">
                        <img src="picture/logo.png" width="80" height="50">
                    </a>
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                            <a class="nav-link" href="category.php?cat=all">สินค้าทั้งหมด</a>
                            <a class="nav-link" href="order.php">รายการสั่งซื้อ</a>
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-right">
                    <form class="d-flex m-0" role="search" action="category.php" method="GET">
                        <input class="form-control me-2" type="text" name="search" placeholder="ค้นหา" aria-label="Search" id="boxsearch">
                    </form>
                    
                    <button class="navbar-toggler" href="cart.php" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
                    </button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <a href="account.php"><i class="fa-solid fa-user fa-xl"></i></a>
                    </button>
                </nav>
            </div>
        </nav>';
        }
        echo $navh;
    }
        
    function footer() {
        $footer = '<div class="footer-basic pb-0">
        <footer>
            <div class="social">
                <a href="https://www.facebook.com/ITLadkrabang"><i class="fa-brands fa-square-facebook"></i></a>
                <a href="https://www.instagram.com/itladkrabang/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">หน้าหลัก</a></li>
                <li class="list-inline-item"><a href="#">เกี่ยวกับเรา</a></li>
                <li class="list-inline-item"><a href="#">ติดต่อเรา</a></li>
                <li class="list-inline-item"><a href="#">ข่าวสาร</a></li>
            </ul>
            <p class="copyright mb-0 pb-3">© 2023 MoreThanBike Co., Ltd. มอร์แดนไบค์</p>
        </footer>
    </div>';
        echo $footer;
    }

    function card($cardname, $cardprice, $cardpic, $cardid, $cardbrand) {
        floatval(preg_replace('/[^\d.],/', '', '"'.$cardprice.'"'));
        $cardprice = number_format($cardprice, 2);
        $card = '
        <div class="col" id="box" style="margin-bottom: 50px;">
            <a href="prop.php?idg=' . $cardid . '">
            <img src="'.$cardpic.'" alt="" width="240" height="240" id="img-best">
            </a>    
            <p class="name m-0">'.$cardname.'</p>
            <p>'.$cardbrand.'</p>
            <p class="cash1">฿'.$cardprice.'</p>
        </div>';
    echo $card;
    }
?>