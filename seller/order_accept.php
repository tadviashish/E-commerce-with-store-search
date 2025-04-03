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
  // echo $id;
  // echo $row['name'];
  // echo $mobile;

}
if (isset($_GET['acceptorder'])) {
    $ids = $_GET['select'];
    foreach ($ids as $id) {
        $sql = "SELECT * FROM order_details WHERE order_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            $status = "Accepted";
            $sql = "UPDATE order_details SET order_status =' $status' WHERE order_id = '$id'";
            $result = mysqli_query($conn, $sql);
            header('refresh:1;url=orders.php');
        } else {
            echo "Error to fetch record";
        }
    }
}

if (isset($_GET['deleteorder'])) {
    $ids = $_GET['select'];
    foreach ($ids as $pid) {
        $sql = "DELETE FROM order_details WHERE order_id = '$pid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $pid = "";
            header('refresh:1;url=orders.php');
        } else {
            echo mysqli_errno($conn);
        }
    }
    echo "Product Deleted successfuly";
}
// 
// SINGLE

if (isset($_GET['accept'])) {
    $ids = $_GET['accept'];
    
        $sql = "SELECT * FROM order_details WHERE order_id = '$ids'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            $status = "Accepted";
            $sql = "UPDATE order_details SET order_status =' $status' WHERE order_id = '$ids'";
            $result = mysqli_query($conn, $sql);
            header('refresh:1;url=orders.php');
        } else {
            echo "Error to fetch record";
        }
        
    }
    
    if (isset($_GET['delete'])) {
        $ids = $_GET['delete'];
        $sql = "DELETE FROM order_details WHERE order_id = '$ids'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $iid = "";
            header('refresh:1;url=orders.php');
        } else {
            echo mysqli_errno($conn);
        }
    echo "Product Deleted successfuly";
}


?>