<?php
require('database.php');
session_start();
if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['pass'];
    // $sql = "SELECT seller_id,name FROM seller_data WHERE mobile = '$mobile' AND password='$pass'";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result);
    // $id =  $row['seller_id'];
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Commerce</title>
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="left">
    <p><a href="homepage.php">E-commerce</a></p>
    </div>
    <div class="center">
      <form action="searchstore.php" method="get">
        <input type="text" name="search" placeholder="Search Store and More....." required />
        <button type="submit" name="searachinfo">SEARCH</button>
        <!-- <img src="../image/search.svg" alt="" /> -->
      </form>
    </div>
    <div class="right">
      <a href="cprofile.php"><img src="../image/user.svg" alt="" />Profile</a>
      <a href="cart.php"><img src="../image/cart.svg" alt="" />Cart</a>
      <a href="../seller/signup.php"><img src="../image/store.svg" alt="" />Become Seller</a>
    </div>
  </nav>
  <!-- offer -->
  <div class="offer">
    <a href=""><img src="../image/banner.png" alt="" /></a>
  </div>
  <!-- category -->
  <h3 id="cat-id">SHOP BY CATEGORY</h3>
  <div class="category">
    <div class="cat-type">
      <img src="../image/category/mobile.png" alt="Mobile" />
      <p>Mobiles</p>
    </div>
    <div class="cat-type">
      <img src="../image/category/grocery.jpg" alt="Mobile" />
      <p>Grocery</p>
    </div>
    <div class="cat-type">
      <img src="../image/category/electronics.jpg" alt="Mobile" />
      <p>Electronics</p>
    </div>
    <div class="cat-type">
      <img src="../image/category/fashion.jpg" alt="Mobile" />
      <p>Fashion</p>
    </div>
    <div class="cat-type">
      <img src="../image/category/stationary.jpeg" alt="Mobile" />
      <p>Stationary</p>
    </div>
    <div class="cat-type">
      <img src="../image/category/toys.jpg" alt="Mobile" />
      <p>Toys</p>
    </div>
  </div>

  <div class="popular">
    <h4>POPULAR PRODUCTS</h4>
    <div class="products">
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>

      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
      <div class="products-item">
        <img src="../image/popular/cloth1.jpeg" alt="clothes" />
        <p>T-shirt</p>
      </div>
    </div>
  </div>

  <!-- footer -->

  <div class="footer">
    <p>Copyright&copy; E-Commerce</p>
  </div>
</body>

</html>