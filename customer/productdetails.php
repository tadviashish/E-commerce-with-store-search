<?php
require('database.php');
session_start();

if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $user = $_SESSION['mobile'];
    //echo $row['category'];
}

if (isset($_REQUEST['product'])) {
    $search = $_REQUEST['product'];
    $_SESSION['search'] = $search;
    // echo $search;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap");

        * {
            margin: 4px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left p {
            font-family: "Poppins", sans-serif;
            font-size: 24px;
            font-weight: 700;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center input {
            width: 40vw;
            height: 26px;
            border-radius: 16px;
            border: 1px solid black;
        }

        .center form {
            display: flex;
            align-items: center;
        }

        .center input::placeholder {
            padding: 12px;
            color: rgb(79, 76, 76);
        }

        .center img {
            height: 24px;
            width: 24px;
            margin-left: 5px;
            cursor: pointer;
        }

        .right {
            display: flex;
        }

        .navbar right a,
        img {
            margin: 20px;
        }

        .navbar right,
        a {
            color: black;
            text-decoration: none;
            display: flex;
            align-items: center;
        }


        .hnav {
            height: 60px;
            width: 100%;
            background: rgb(244, 168, 244);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hnav .left {
            margin-left: 40px;
            display: flex;
            align-items: center;

        }

        .left form {
            margin-left: 73px;

        }

        .left form input {

            height: 22px;
            width: 18vw;
            border-radius: 7px;
        }

        .left input::placeholder {
            padding: 12px;
            color: rgb(79, 76, 76);
        }

        .hnav .right {
            margin-right: 30px;
        }

        .right input {
            width: 220px;
            border-radius: 25px;
            height: 20px;
            border: 1px solid black;
        }

        .search {
            margin-right: 70px;
            width: 100px;
            cursor: pointer;
        }

        .btn {
            cursor: pointer;
            width: 100px;
        }

        .data {
            display: flex;
        }

        .content {
            margin-left: 4px;
        }

        .content select {
            height: 28px;
            width: 200px;
            border: 1px solid black;
            margin-bottom: 16px;
        }

        .content form {

            display: flex;
            flex-direction: column;
            margin-top: 12px;
        }

        .content input {
            height: 28px;
            width: 200px;
            margin-top: 10px;
        }

        #seller {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #seller td,
        #seller th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #seller tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #seller tr:hover {
            background-color: #ddd;
        }

        #seller th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }


        .content button {
            border: 1px solid black;
            margin: 5px;
            padding: 5px;
            background: blue;
            color: white;
            border-radius: 1px;
            width: 70px;
            cursor: pointer;
        }

        .button {
            display: flex;
            margin: 10PX;
        }

        .float-end ul li {

            list-style: none;

        }

        .page-item a {
            text-decoration: none;
            list-style: none;
            border: 1px solid black;
            padding: 2px;
            margin: 6px;
        }

        .pagination {
            display: flex;
        }

        .content {
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
            flex-direction: column;
        }

        .result {
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
            background-color: antiquewhite;
            width: 80vw;
            flex-direction: column;
        }

        .data {
            /* margin-left: 300px; */
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .storeinfo {
            flex-direction: column;
            width: 45vw;
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
        }

        .storeinfo li {
            list-style: none;

        }

        .storeinfo li a {
            text-decoration: none;

        }

        .image {
            display: flex;
            flex-direction: row;
        }
    </style>
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

    <div class="data">
        <div class="content">
            <?php
            $search = $_SESSION['search'];
            $sql = "SELECT * FROM products WHERE pid = '$search'";
            $rows = mysqli_query($conn, $sql);
            foreach ($rows as $row) : ?>
                <!-- echo $row['shop_name']; -->
                `<div class="result">
                    <div class="image">
                        <?php
                        foreach (json_decode($row['image']) as $image) :
                        ?>
                            <img src="../seller/uploads/<?php echo $image; ?>" width="100px" height="100px" margin="10px">
                        <?php endforeach; ?>
                    </div>

                    <!-- <img src="../seller/uploads/<?php echo $row['image']; ?>" alt="Store" height="100px" width="100px"> -->
                    <div class="storeinfo">
                        <h3>Product Description</h3>
                        <p><?php echo $row['pdesc'] ?></p>
                        <h3>Price </h3>
                        <p>
                            <?php
                            $today = date("d/m/Y");
                            $date = $row['discount_valid'];
                            $date = date_create($date);
                            $discount_date =  date_format($date, "d/m/Y");
                            if ($row['discount'] <= 0 || $today > $discount_date) {
                                echo "<span>&#8377&nbsp</span>" . $row['price'];
                            } elseif ($today < $discount_date || $today == $discount_date) {
                                if ($row['discount'] > 0) {
                                    echo "<span>&#8377 </span>" . $row['discount'] . " " . "off" . "<del>" . $row['price'] . "</del>";
                                    $discount_price = $row['price'] - $row['discount'];
                                    echo $discount_price;
                                }
                            }
                            ?>
                        </p>
                        <h3>Delivered to</h3>
                        <p>
                            <?php
                            
                            $cid = $_SESSION['cust'];
                            echo $cid;
                            $sql = "SELECT * FROM cust_data WHERE cust_id = '$cid'";
                            $rows = mysqli_query($conn, $sql);
                            $custrow = mysqli_fetch_array($rows)
                            ?>
                            <p>
                                <?php 
                                    echo $custrow['cust_name']."<br>"; 
                                    echo $custrow['cust_state']." ".$custrow['cust_dist']." ".$custrow['cust_city']." ".$custrow['cust_pincode']; 
                                ?>

                            </p>
                        </p>
                            <h3>Sold By</h3>
                        <p>
                        <?php
                            
                           $sid = $row['seller_id'];
                            $sql = "SELECT * FROM seller_data WHERE seller_id = '$sid'";
                            $rows = mysqli_query($conn, $sql);
                            $sellrow = mysqli_fetch_array($rows)
                            ?>
                            <p>
                                <?php 
                                    echo $sellrow['shop_name']."<br>"; 
                                    echo $sellrow['state']." ".$sellrow['dist']." ".$sellrow['city']." ".$sellrow['pincode']; 
                                ?>

                            </p>
                        </p>

                        <div class="action">
                            <form action="cart.php" method="get">
                                <button type="submit" name="cart" value="<?php echo $row['pid']; ?>" style="background: #f2f2f2; width:125px; color:black">ADD TO CART</button>
                            </form>
                            <form action="cust_order.php" method="get">
                             <input type="number" value="<?php echo $row['pid'];?>" name="pid" style="display: none;">
                             <input type="number" value="<?php echo $custrow['cust_id'];?>" name="cid" style="display: none;">
                             <input type="number" value="<?php echo $sellrow['seller_id'];?>" name="sid" style="display: none;">
                                <button type="submit" name="order" value="<?php echo $row['pid']; ?>" style="background: #f2f2f2; width:70px; color:black">BUY</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>
    </div>
</body>

</html>
</body>

</html>