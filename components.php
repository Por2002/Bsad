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
          $navh = `<nav class="navbar sticky-top bg-white">
          <div class="container">
              <nav class="navbar navbar-expand">
                  <a class="navbar-brand" href="index.html">
                      <img src="picture/logo.png" width="80" height="50">
                  </a>
                  <div class="collapse navbar-collapse">
                      <div class="navbar-nav">
                          <a class="nav-link" href="lodraka.html?view=discount">สินค้าทั้งหมด</a>
                      </div>
                  </div>
              </nav>
              <nav class="navbar navbar-expand-right">
                  <form class="d-flex m-0" role="search">
                      <input class="form-control me-2" type="search" placeholder="ค้นหา" aria-label="Search" id="boxsearch">
                  </form>
                  
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                      <i class="fa-solid fa-cart-shopping fa-xl"></i>
                  </button>
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                      <i class="fa-solid fa-user fa-xl"></i>
                  </button>
              </nav>
          </div>
      </nav>`;
        }else {    $navh = `<nav class="navbar sticky-top bg-white">
            <div class="container">
                <nav class="navbar navbar-expand">
                    <a class="navbar-brand" href="index.html">
                        <img src="picture/logo.png" width="80" height="50">
                    </a>
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                            <a class="nav-link" href="lodraka.html?view=discount">สินค้าทั้งหมด</a>
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-right">
                    <form class="d-flex m-0" role="search">
                        <input class="form-control me-2" type="search" placeholder="ค้นหา" aria-label="Search" id="boxsearch">
                    </form>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    </button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <i class="fa-solid fa-user fa-xl"></i>
                    </button>
                </nav>
            </div>
        </nav>`;
        }
        echo $navh;
    }
        
    function footer() {
        $footer = `<div class="footer-basic pb-0">
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
    </div>`;
        echo $footer;
    }
?>