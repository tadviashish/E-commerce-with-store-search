<?php
require("database.php");

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM products_request WHERE pid = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "product Deleted successfuly";
        header('refresh:1;url=product_request.php');
        $id = "";
    } else {
        echo mysqli_errno($conn);
    }
}

if (isset($_GET["deletefromall"])) {
    $id = $_GET["deletefromall"];
    $sql = "DELETE FROM products WHERE pid = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "product Deleted successfuly";
        header('refresh:1;url=allproducts.php');
        $id = "";
    } else {
        echo mysqli_errno($conn);
    }
}
