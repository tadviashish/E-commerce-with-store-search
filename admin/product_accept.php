<?php
require("database.php");

if (isset($_GET["accept"])) {
    $id = $_GET["accept"];
    $sql = "SELECT * FROM products_request WHERE pid = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        //echo "record found";
    } else {
        echo "Error to fetch record";
    }

    $sid = $row['seller_id'];
    $id =   $row['pid'];
    $name =  $row['pname'];
    $pquantity =  $row['pquantity'];
    $desc =  $row['pdesc'];
    $cat =  $row['pcategory'];
    $price = $row['price'];
    $dis = $row['discount'];
    $dis_valid = $row['discount_valid'];
    $image =  $row['image'];
    
    $sql = "INSERT INTO products(seller_id, pid, pname,pquantity, pdesc,pcategory, price,discount,discount_valid,image) VALUES ('$sid',' $id','$name','$pquantity','$desc','$cat','$price','$dis','$dis_valid','$image')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Request Accepted";
        header("refresh:2;url=product_request.php");
    } else {
        echo "The record was not inserted successfully " . mysqli_error($conn);
    }

    $sql = "DELETE FROM products_request WHERE pid = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('refresh:1;url=product_request.php');
            $id = "";
        } else {
            echo mysqli_errno($conn);
        }

    
}

?>
