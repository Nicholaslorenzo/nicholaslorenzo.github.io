<?php
require 'config.php';
if(!empty($_SESSION["id"])) {
   $id = $_SESSION["id"];
   $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
   $row = mysqli_fetch_assoc($result);
   } else {
     header("Location: login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pakaian</title>
    <!-- Link To CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="img/odop.png" type="image/x-icon">
    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="">
    <!-- Navbar -->
    <header>
        <div class="nav container">
            <!-- Text -->
            <a href="#home" class="text">
                <h1><span>Odop</span></h1>
            </a>
            <!-- Nav  Links -->
            <ul class="navbar">
                <li><a href="#home">Home</a></li>
                <li><a href="#featured">Featured</a></li>
                <li><a href="#shop">Shop</a></li>
                <li><a href="#new">New</a></li>
            </ul>
            <!-- Icons -->
            <div class="nav-icons">
                <a href="search-bar.html" class="search"><i class='bx bx-search' id="search-icon"></i></a>
                <a href="#" class="user"><i class='bx bxs-user' id="go-login"></i></a>
                <a href="#" class="cart"><i class='bx bxs-cart'></i><span>0</span></a>
                <i class='bx bx-menu' id="menu-icon"></i>
            </div>
        </div>
        <!-- User Detail-->
    <div class="userr">
        <h2>Welcome <?php echo $row["name"]; ?> <br> Happy Shopping</h2>
        <a href="logout.php">Logout</a>
    </div>
    </header>
    <!-- Home -->
    <section class="home" id="home">
        <!-- Home Content -->
        <div class="home-container container">
            <div class="home-text"> 
                <h1><span>Odop Store</span></h1>
                <p>Lorem ipsum dolor sit, amet consectetur <br> adipisicing elit. Sint, officiis debitis</p>
                <!-- Home Button -->
                <a href="#shop" class="btn">Buy Now</a>
            </div>
            <!-- Home Image -->
            <div class="home-img">
                <img src="img/homepage.png" alt="">
            </div>
        </div>
    </section>
    <!-- Featured -->
    <section class="featured" id="featured">
        <!-- Heading -->
        <div class="heading">
            <h2>Featured <span>Items</span></h2>
        </div>
        <div class="featured-container container">
            <!-- Box 1 -->
            <div class="box">
                <img src="img/vintage.png" alt="">
                <div class="text">
                    <h2>New Collection <br>Of Clothes</h2>
                    <a href="#shop">View More</a>
                </div>
            </div>
            <!-- Box 2 -->
            <div class="box">
                <div class="text">
                    <h2>20% Discount <br>On Clothes</h2>
                    <a href="#shop">View More</a>
                </div>
                <img src="img/realmadrid.png" alt="">
            </div>
        </div>
    </section>
    <!-- Shop -->
    <section class="shop" id="shop">
        <div class="heading">
            <h2><Span>Shop</Span></h2>
        </div>
        <!-- Shop Content -->
        <div class="shop-container container">
            <div class="box">
                <div class="listProduct" id="listProduct">
                    <div class="item" id="row1">
                        <img src="img/shop1.png" alt="">
                        <h2>Baju Odop 1</h2>
                        <div class="price">Rp 100.000,00</div>
                        <button class="addCart"><i class='bx bxs-cart-add'></i></button>
                    </div>
                    <div class="item" id="row2">
                        <img src="img/shop4.png" alt="">
                        <h2>Baju Odop 4</h2>
                        <div class="price">Rp 100.000,00</div>
                        <button class="addCart"><i class='bx bxs-cart-add'></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Container -->
    <section class="new" id="new">
        <div class="heading">
            <h2>New <Span>Arrival</Span></h2>
        </div>
        <!-- Shop Content -->
        <div class="featured-container container">
            <!-- Box 1 -->
            <div class="box">
                <img src="img/newarrival.png" alt="">
                <div class="text">
                    <h2>New Arrival <br>Of Clothes</h2>
                    <a href="#shop">View More</a>
                </div>
            </div>
            <!-- Box 2 -->
            <div class="box">
                <div class="text">
                    <h2>New Arrival <br>Of Clothes</h2>
                    <a href="#shop">View More</a>
                </div>
                <img src="img/vintage_newarrival.png" alt="">
            </div>
            <!-- Box 3 -->
            <div class="box">
                <div class="text">
                    <h2>New Arrival <br>Of Clothes</h2>
                    <a href="#shop">View More</a>
                </div>
                <img src="img/brazill.png" alt="">
            </div>
        </div>
    </section> 
    <!-- Make a Cart Section -->
    <div class="cartTab">
        <h1>Shopping Cart</h1>
        <div class="listCart">
            <div class="item">
                
            </div>
        </div>
        <div class="btn2">
            <button class="close">CLOSE</button>
            <button class="checkOut">CHECKOUT</button>
        </div>
    </div>

    <!-- Footer -->
    <section class="footer container">
        <div class="footer-box">
            <a href="#" class="text">
                <h1><span>Odop Store</span></h1>
            </a>
            <div class="social">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-tiktok'></i></a>
            </div>
        </div>
        <hr>
        <div class="footer-box">
            <h3>Pages</h3>
            <a href="#home">Home</a>
            <a href="#featured">Featured</a>
            <a href="#shop">Shop</a>
            <a href="#new">New</a>
        </div>
        <div class="footer-box">
            <h3>Branches</h3>
            <p>United States</p>
            <p>Japan</p>
            <p>Germany</p>
            <p>Italy</p>
        </div>
    </section>
    <!-- Copyright -->
    <div class="copyright">
        <p>&#169; 2024 Kelompok 5. All Right Reserved</p>
    </div>
    <!-- Link To JS -->
    <script src="script.js"></script>
</body>
</html>