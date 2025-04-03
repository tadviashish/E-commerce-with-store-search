<?php
require('database.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("refresh:1;url=category.php");
    exit;
} else {
    $user = $_SESSION['username'];
    //echo $row['category'];
}

if (isset($_GET['submit'])) {
    $cat = $_GET['category'];
    if ($cat !== "") {
        $sql = "INSERT into shop_category(category) VALUES ('$cat')";
        $result = mysqli_query($conn, $sql);
        header("refresh:1;url=category.php");
    } else {
        echo "Enetr Category";
    }
} else {
    header('category.php');
}


if (isset($_GET['delete'])) {
    if (isset($_GET['categ'])) {
        $cat  =  $_GET['categ'];

        $sql = "DELETE FROM shop_category WHERE category = '$cat' ";
        $result = mysqli_query($conn, $sql);
        header("refresh:1;url=category.php");
    }
}


if (isset($_GET['addproduct'])) {
    $cat = $_GET['category'];
    $shop_cat = $_GET['shop_cat'];
    if ($cat !== "") {
        $sql = "INSERT into product_category(shop_category,product_category) VALUES ('$shop_cat','$cat')";
        $result = mysqli_query($conn, $sql);
        header("refresh:1;url=category.php");
    } else {
        echo "Enetr Category";
    }
} else {
    header('category.php');
}


if (isset($_GET['deleteproduct'])) {
    if (isset($_GET['categ'])) {
        $cat  =  $_GET['categ'];

        $sql = "DELETE FROM product_category WHERE product_category = '$cat' ";
        $result = mysqli_query($conn, $sql);
        header("refresh:1;url=category.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
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

        th,
        td {
            border: 1px solid black;
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

        .content {
            margin: 45px;
        }
    </style>
</head>

<body>
    <div class="hnav">
        <div class="left">
            <h2>Admin</h2>
            <form action="#" method="get">
                <input type="text" name="search" />
                <button type="submit" name="searachinfo">SEARCH</button>
            </form>
        </div>
        <div class="right">

            <button class="btn">LOGOUT</button>
        </div>
    </div>

    <div class="data">
        <?php
        require("adminhomepage.php");
        ?>
        <div class="content">
            <h1>Shop Category</h1>
            <form action="category.php" method="get">
                <select name="categ">
                    <option>Select Category</option>
                    <?php
                    $sql = "SELECT * from shop_category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                    <?php } ?>
                </select>
                <input type="text" name="category" placeholder="ADD CATEGORY" />
                <input type="submit" name="submit" value="SUBMIT" />
                <input type="submit" name="delete" value="DELETE" />
            </form>
        </div>

        <div class="content">
            <h1>Product Category</h1>
            <form action="category.php" method="get">
             
                <select name="categ">
                    <option>Select Category</option>
                    <?php
                    $sql = "SELECT * from product_category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <option value="<?php echo $row['product_category']; ?>"><?php echo $row['product_category']; ?></option>
                    <?php } ?>
                </select>

                <input type="text" name="category" placeholder="ADD CATEGORY" />
                <select name="shop_cat">
                    <option>Select Shop Category</option>
                    <?php
                    $sql = "SELECT * from shop_category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                    <?php } ?>
                </select>

                <input type="submit" name="addproduct" value="SUBMIT" />
                <input type="submit" name="deleteproduct" value="DELETE" />
            </form>
        </div>
    </div>
</body>

</html>