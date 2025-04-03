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

if (isset($_GET['searachinfo'])) {
    $search = $_GET['search'];
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
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .result {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background-color: antiquewhite;
            width: 48vw;
        }

        .data {
            margin-left: 300px;
        }

        .storeinfo {
            width: 45vw;
        }

        .storeinfo li {
            list-style: none;

        }

        .storeinfo li a {
            text-decoration: none;

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
            $sql = "SELECT * FROM seller_data WHERE CONCAT(shop_name,state,dist,city) LIKE '%$search%'";
            $rows = mysqli_query($conn, $sql);
            foreach ($rows as $row) : ?>
                <!-- echo $row['shop_name']; -->
                `<div class="result">
                    <img src="store.png" alt="Store" height="100px" width="100px">
                    <div class="storeinfo">
                        <li><a href="productlist.php?product=<?php echo $row['seller_id']; ?>"><?php echo "<b>".$row['shop_name']."</b>" ?></a></li>
                        <!-- <p><?php $row['shop_name'] ?></p> -->
                        <p><?php echo $row['state'] . ", &nbsp";
                            echo $row['dist'] . ", &nbsp";
                            echo $row['city'] . ", &nbsp"; ?></p>
                    </div>
                </div>`
            <?php endforeach;
            ?>

        </div>

    </div>
    </div>
</body>

</html>
</body>

</html>