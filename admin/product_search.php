<?php
require('database.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location : login.php");
    exit;
} else {
    $user = $_SESSION['username'];
    //echo $row['category'];
}

if (isset($_GET['searachinfo'])) {
    $search = $_GET['search'];
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
    </style>
</head>

<body>
    <div class="hnav">
        <div class="left">
            <h2>Admin</h2>
            <form action="./product_search.php" method="get">
            <input type="text" name="search" placeholder="search"  required/>
                <button type="submit" name="searachinfo">SEARCH</button>
            </form>
        </div>
        <div class="right">
            <form action="logout.php" method="get">
                <button type="submit" name="logout" class="btn">LOGOUT</button>
            </form>
        </div>
    </div>
    <div class="data">
        <?php
        require("adminhomepage.php");
        ?>
        <div class="content">
            <h2>PRODUCT DETAILS</h2>
            <table id="seller">
                <tr>
                    <th>Seller id</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Discount Validity</th>
                    <th>Images</th>
                    <th>Action</th>
                <tr>

                    <?php
                    $sql = "SELECT * FROM products_request WHERE CONCAT(pname,pdesc,pcategory,price) LIKE '%$search%'";
                    $rows = mysqli_query($conn, $sql);
                    foreach ($rows as $row) :
                    ?>
                <tr>
                    <td><?php echo $row['seller_id'] ?></td>
                    <td><?php echo $row['pname'] ?></td>
                    <td><?php echo $row['pdesc'] ?></td>
                    <td><?php echo $row['pcategory'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><?php echo $row['discount'] ?></td>
                    <td><?php echo $row['discount_valid'] ?></td>
                    <td>
                        <?php
                        foreach (json_decode($row['image']) as $image) :
                        ?>
                            <img src="../seller/uploads/<?php echo $image ?>" width="100px" height="100px">
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <form action="product_accept.php" method="get" enctype="multipart/form-data">
                            <button type="submit" name="accept" value="<?php echo $row['pid']; ?>">ACCEPT</button>
                        </form>

                        <form action="product_delete.php" method="get">
                            <button type="submit" name="delete" value="<?php echo $row['pid']; ?>" style="background: red;">DELETE</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>