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
    <title>Seller Information</title>
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
            width: 135vw;
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
            <form action="order_search.php" method="get">
                <input type="text" name="search" placeholder="search" required />
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
            <h2>Order Information</h2>
            <form action="order_info.php" method="get">
                <div class="button">
                    <button type="submit" name="deletedata">Delete</button>

                </div>
                <?php

                $query = "SELECT * FROM order_details";
                $results = mysqli_query($conn, $query);
                $totaldata = mysqli_num_rows($results);
                if (!isset($_GET['page'])) {
                    $page_number = 1;
                } else {
                    if (!is_numeric($_GET['page'])) {
                        $page_number = 1;
                    } else {
                        $page_number = $_GET['page'];
                    }
                }

                $limit = 4;

                $startFrom = ($page_number - 1) * $limit;

                $data = mysqli_query($conn, "SELECT * FROM order_details WHERE CONCAT(pname,pdesc,pcategory,price,cust_name,cust_state,cust_dist,cust_city,cust_pincode,payment,order_status) LIKE '%$search%' LIMIT " . $startFrom . ',' . $limit);
                $total_pages = ceil($totaldata / $limit);

                ?>
                <table id="seller">
                    <th>Select</th>
                    <th>Order ID</th>
                    <th>Seller ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Payment</th>
                    <th>Order Status</th>
                    <th>Action</th>

                    <?php
                    foreach ($data as $row) :
                    ?>
                        <tr>
                            <td>
                                <input style="height: 15px; width:15px" type="checkbox" name="delete[]" value="<?php echo $row['seller_id']; ?>">
                            </td>
                            <td><?php echo $row['order_id'] ?></td>
                            <td><?php echo $row['seller_id'] ?></td>
                            <td><?php echo $row['cust_id'] ?></td>
                            <td><?php echo $row['cust_name'] ?></td>
                            <td><?php echo $row['cust_state'] . " ," . $row['cust_dist'] . " ," . $row['cust_city'] . " ," . $row['cust_pincode'] ?></td>
                            <td><?php echo $row['pname'] ?></td>
                            <td><?php echo $row['pquantity'] ?></td>
                            <td><?php echo $row['price']."(1-item)"; ?></td>
                            <td><?php echo $row['pdesc'] ?></td>
                            <td><?php echo $row['payment'] ?></td>
                            <td><?php echo $row['order_status'] ?></td>
                            <td>
                                <!-- <form action="" method="get">

                                </form>
                                <form action="view_details.php" method="get" enctype="multipart/form-data">
                                    <button type="submit" name="viewdetails" value="<?php echo $row['order_id']; ?>">Details</button>
                                </form> -->

                                <form action="order_delete.php" method="get">
                                    <button type="submit" name="delete" value="<?php echo $row['order_id']; ?>" style="background: red;">Delete</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="float-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($pagination = 1; $pagination <= $total_pages; $pagination++) : ?>
                                <li class="page-item 
                                    <?= isset($_GET['page']) ? ($_GET['page'] == $pagination ? 'active' : '') : ($pagination == 1 ? 'active' : ''); ?>
                                ">
                                    <a class="page-link" href="seller_information.php?page=<?= $pagination; ?>">
                                        <?= $pagination; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>

</body>

</html>