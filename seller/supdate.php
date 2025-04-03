<?php
require('database.php');
session_start();
if (isset($_GET['update'])) {
    $sid = $_GET['update'];
    $sql = "SELECT * FROM seller_data WHERE seller_id ='$sid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        //echo "record found";
    } else {
        echo "Error to fetch record";
    }
}

if (isset($_GET['button'])) {
    $sid = $_GET['sid'];
    $name = $_GET['name'];
    $mobile = $_GET['mobile'];
    $pass = $_GET['pass'];
    $state = $_GET['state'];
    $dist = $_GET['dist'];
    $city = $_GET['city'];
    $pincode = $_GET['pincode'];
    $shop_name = $_GET['shop_name'];
    $shop_cat = $_GET['category'];
    $licence = $_GET['gstin'];
    $sql = "UPDATE seller_data SET name='$name',mobile='$mobile',password='$pass',state='$state',dist='$dist',city='$city',pincode='$pincode',shop_name='$shop_name',category='$shop_cat',gstin='$licence' WHERE seller_id = '$sid'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:sprofile.php");
    } else {
        echo mysqli_error($conn);
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <style>
        .container {
            display: flex;
        }

        .info {
            height: 100%;
            width: 100%;
            display: flex;
            margin-left: 10px;
            align-items: flex-start;
        }

        .info form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .info form input {
            margin: 10px;
            width: 307px;
            height: 24px;
            border: 1px solid black;
        }

        .info form button {
            margin: 10px;
            width: 313px;
            height: 24px;
            background-color: rgb(11, 210, 11);
            border: 1px solid black;
            cursor: pointer;

        }

        .details form button {
            margin: 10px;
            width: 313px;
            height: 24px;
            background: blue;
            color: white;
            border: 1px solid black;
            cursor: pointer;

        }

        .info input::placeholder {
            padding: 12px;
            color: rgb(79, 76, 76);
        }

        .data select {

            height: 28px;
            width: 200px;
            margin: 10px;
            border: 1px solid black;
        }

        .data {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        table {
            height: 301px;
            width: 348px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require('seller_home.php');
        ?>
        <div class="info">

            <div class="data">
                <h1>Seller Details</h1>
                <form action="supdate.php" method="post">
                    <input style="display: none;" type="text" name="sid" value="<?php echo $row['seller_id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" />
                    <input type="number" name="mobile" value="<?php echo $row['mobile']; ?>">
                    <input type="text" name="pass" value="<?php echo $row['password']; ?>">
                    <input type="text" name="state" value="<?php echo $row['state']; ?>">
                    <input type="text" name="dist" value="<?php echo $row['dist']; ?>">
                    <input type="text" name="city" value="<?php echo $row['city']; ?>">
                    <input type="number" name="pincode" value="<?php echo $row['pincode']; ?>">
                    <input type="text" name="shop_name" value="<?php echo $row['shop_name']; ?>">
                    <input type="text" name="gstin" value="<?php echo $row['gstin']; ?>">
                    <input type="text" name="cat" value="<?php echo $row['category']; ?>">
                    <select name="category">
                        <option>Select Category</option>
                        <?php
                        $sql = "SELECT * from signup_data";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option><?php echo $row['category']; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" name="button">Update</button>
                </form>
            </div>

        </div>
    </div>

</html>