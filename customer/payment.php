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

if (isset($_GET['order'])) {
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
    $sid = $_GET['sid'];
    $quantity = $_GET['quantity'];

    $sql = "SELECT * FROM seller_data WHERE seller_id = '$sid'";
    $rows = mysqli_query($conn, $sql);
    $sellrow = mysqli_fetch_array($rows);

    $sql = "SELECT * FROM cust_data WHERE cust_id = '$cid'";
    $rows = mysqli_query($conn, $sql);
    $custrow = mysqli_fetch_array($rows);

    $sql = "SELECT * FROM products WHERE pid = '$pid'";
    $rows = mysqli_query($conn, $sql);
    $prow = mysqli_fetch_array($rows);
    // echo $search;
}
if (isset($_GET['payment'])) {
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
    $sid = $_GET['sid'];
    $quantity = $_GET['quantity'];
    $payment = $_GET['paymentoption'];
    echo $payment;
    $sql = "SELECT * FROM seller_data WHERE seller_id = '$sid'";
    $rows = mysqli_query($conn, $sql);
    $sellrow = mysqli_fetch_array($rows);

    $sql = "SELECT * FROM cust_data WHERE cust_id = '$cid'";
    $rows = mysqli_query($conn, $sql);
    $custrow = mysqli_fetch_array($rows);

    $sql = "SELECT * FROM products WHERE pid = '$pid'";
    $rows = mysqli_query($conn, $sql);
    $prow = mysqli_fetch_array($rows);
    echo $custrow['cust_name'];

    $pname = $prow['pname'];
    $price = $prow['price'];
    $cat = $prow['pcategory'];
    $desc = $prow['pdesc'];

    $cname = $custrow['cust_name'];
    $state = $custrow['cust_state'];
    $dist = $custrow['cust_dist'];
    $city = $custrow['cust_city'];
    $pin = $custrow['cust_pincode'];

    $orderstatus = "pending";

    $sql = "INSERT INTO order_details(seller_id, cust_id, pid, pname,pquantity,price,pdesc, pcategory,cust_name,cust_state, cust_dist, cust_city, cust_pincode, payment, order_status) VALUES ('$sid','$cid','$pid','$pname','$quantity','$price','$desc','$cat','$cname','$state','$dist','$city','$pin','$payment','$orderstatus')";

    $order = mysqli_query($conn, $sql);
    if($order){
        header("refresh:1;url=homepage.php");    
    }
    else
    {
        echo "Order not completed";
    }
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


    <div class="data">
        <div class="content">
            <h2>Select Payment Method</h2>
            <form action="payment.php" method="get">
                <?php
                 $quant =  $quantity;
                $sql = "SELECT * FROM seller_data WHERE seller_id = '$sid'";
                $rows = mysqli_query($conn, $sql);
                $sellrow = mysqli_fetch_array($rows);

                $sql = "SELECT * FROM cust_data WHERE cust_id = '$cid'";
                $rows = mysqli_query($conn, $sql);
                $custrow = mysqli_fetch_array($rows);

                $sql = "SELECT * FROM products WHERE pid = '$pid'";
                $rows = mysqli_query($conn, $sql);
                $prow = mysqli_fetch_array($rows);
                ?>
                <span style=" margin-left: -79px;">
                    <input type="radio" name="paymentoption" id="upi" value="UPI(Pay/PhonePe/Paytm)" />
                    <label for="upi">UPI(Pay/PhonePe/Paytm)</label>
                </span>
                <span style="    margin-left: -79px;">

                    <input type="radio" name="paymentoption" id="debitcard" value="Debit/Credit Card" />
                    <label for="debitcard">Debit/Credit Card</label>
                </span>
                <span style="    margin-left: -79px;">

                    <input type="radio" name="paymentoption" id="netbanking" value="Net Banking" />
                    <label for="netbanking">Net Banking</label>
                </span>
                <span style="    margin-left: -79px;">

                    <input type="radio" name="paymentoption" id="cashon" value="Cash on Delivery" />
                    <label for="cashon">Cash on Delivery</label>
                </span>
                <!-- <input type="submit" name="payment"> -->
                <input type="number" value="<?php echo $quant; ?>" name="quantity" style="display: none;">
                <input type="number" value="<?php echo $prow['pid']; ?>" name="pid" style="display: none;">
                <input type="number" value="<?php echo $custrow['cust_id']; ?>" name="cid" style="display: none;">
                <input type="number" value="<?php echo $sellrow['seller_id']; ?>" name="sid" style="display: none;">
                <button type="submit" name="payment" style="background: #f2f2f2; width:70px; color:black">Place Order</button>
            </form>
        </div>
    </div>
</body>

</html>
</body>

</html>