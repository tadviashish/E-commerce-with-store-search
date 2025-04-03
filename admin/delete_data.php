<?php
require("database.php");

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM seller_data WHERE seller_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Seller data Deleted successfuly";
        header('refresh:2;url=seller_information.php');
        $id = "";
    } else {
        echo "errr".mysqli_errno($conn);
    }
}
