<?php

require('database.php');
session_start();
if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT seller_id,name FROM seller_data WHERE mobile = '$mobile' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id =  $row['seller_id'];
}


if (isset($_POST['button'])) {
    $name = $_POST['pname'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];
    $dis = $_POST['discount'];
    $dis_valid = $_POST['discount_valid'];
    $cat = $_POST['category'];
    $files = count($_FILES['image']['name']);
    $allfile = array();
    for ($i = 0; $i < $files; $i++) {
        $imagename = $_FILES['image']['name'][$i];
        $tempname = $_FILES['image']['tmp_name'][$i];

        $imgexte = explode('.', $imagename);
        $imgexte = strtolower(end($imgexte));

        $newimgname = uniqid() . '.' . $imgexte;
        move_uploaded_file($tempname, 'uploads/' . $newimgname);

        $allfile[] = $newimgname;
    }

    $allfile = json_encode($allfile);
    $sql = "INSERT INTO products_request(seller_id, pid, pname,pquantity, pdesc,pcategory, price,discount,discount_valid,image) VALUES ('$id','','$name', '$quantity','$desc','$cat','$price','$dis','$dis_valid','$allfile')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Requested for verification";
        header("refresh:1;url=sproduct.php");
        $name =  "";
        $price =  "";
        $desc = "";
        $files =  "";
    } else {
        echo mysqli_errno($conn);
    }
}


if (isset($_POST['deletedata'])) {
    $ids = $_POST['select'];
    foreach ($ids as $pid) {
        $sql = "DELETE FROM products WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $pid = "";
        } else {
            echo mysqli_errno($conn);
        }
    }
    echo "Product Deleted successfuly";
    header('refresh:2;url=sproduct.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <style>
        .container {
            display: flex;
        }

        .content form button {
            margin: 10px;
            width: 313px;
            height: 24px;
            background: blue;
            color: white;
            border: 1px solid black;
            cursor: pointer;

        }

        .info {
            height: 100%;
            width: 509px;
            display: flex;
            align-items: center;
            margin-left: 10px;
            flex-wrap: wrap;
            align-items: center;

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
        .info form select {
            margin: 10px;
            width: 307px;
            height: 24px;
            border: 1px solid black;
        }

        .info form button {
            margin: 10px;
            width: 313px;
            height: 24px;
            border: 1px solid black;

        }

        .info input::placeholder {
            padding: 12px;
            color: rgb(79, 76, 76);
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
    </style>
</head>

<body>
    <div class="container">
        <?php
        require('home2.php');
        ?>

        <div class="container2">
            <div class="header">

            </div>
            <div class="content">
                <div class="info">
                    <h1 style="height: 10px;">Enter Product Details</h1>
                    <form action="./addproduct.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="pname" placeholder="Product Name">
                        <input type="text" name="desc" placeholder="Product Description">
                        <input type="number" name="price" placeholder="Price">
                        <input type="number" name="quantity" placeholder="Quantity">
                        <input type="number" name="discount" placeholder="Discount">
                        <input type="date" name="discount_valid" placeholder="Discount Valid">
                        <select name="category">
                            <option>Select Category</option>
                            <?php
                            $sql = "SELECT * from product_category";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option><?php echo $row['product_category']; ?></option>
                            <?php } ?>
                        </select>
                        <input type="file" name="image[]" accept=".jpg, .png,.jpeg" required multiple>
                        <button type="submit" name="button">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</html>