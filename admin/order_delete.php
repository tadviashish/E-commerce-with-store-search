<?php
require("database.php");

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM order_details WHERE order_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Seller data Deleted successfuly";
        header('refresh:2;url=order_info.php');
        $id = "";
    } else {
        echo "errr".mysqli_errno($conn);
    }
}
