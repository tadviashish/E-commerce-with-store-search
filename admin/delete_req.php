<?php
require("database.php");

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM seller_request WHERE seller_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Seller Request Deleted successfuly";
        header('refresh:1;url=seller_request.php');
        $id = "";
    } else {
        echo mysqli_errno($conn);
    }
}

if (isset($_GET["accept"])) {
    $id = $_GET["accept"];
    $sql = "SELECT * FROM seller_request WHERE seller_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0) {
        //echo "record found";
    } else {
        echo "Error to fetch record";
    }

    $name = $row['name'];
    $mobile =   $row['mobile'];
    $pass =  $row['password'];
    $state =  $row['state'];
    $dist = $row['dist'];
    $city =  $row['city'];
    $pincode = $row['pincode'];
    $shop_name =  $row['shop_name'];
    $category =  $row['category'];
    $gstin =  $row['gstin'];
    $proofid = $row['address'];

    $sql = "SELECT * FROM seller_data WHERE mobile = '$mobile'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {

        $sql =  "INSERT INTO seller_data(name, mobile, password, state, dist, city, pincode, shop_name, category, gstin, address) VALUES ('$name','$mobile','$pass','$state','$dist','$city','$pincode','$shop_name','$category','$gstin','$proofid')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Request Accepted";
            header("refresh:6;url=seller_request.php");
        } else {
            echo "The record was not inserted successfully " . mysqli_error($conn);
        }

        $sql = "DELETE FROM seller_request WHERE seller_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('refresh:6;url=seller_request.php');
            $id = "";
        } else {
            echo mysqli_errno($conn);
        }
    } else {
        echo "Record Found in database with this mobile Number";
    }
}

?>
