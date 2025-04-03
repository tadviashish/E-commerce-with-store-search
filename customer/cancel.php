<?php
require('database.php');
session_start();

if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT cust_id,cname FROM customer_login WHERE cmobile = '$mobile' AND cpassword='$pass'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
      $cid =  $row['cust_id'];
    //   echo $id;
    // echo $row['name'];
    // echo $mobile;

}
if (isset($_GET['cancel'])) 
{
    $cartid = $_GET['cancel'];
    echo $pid;
    $sql = "DELETE FROM cart WHERE cart_id = '$cartid'";
    $result = mysqli_query($conn, $sql);
    header("location:cart.php");


}

?>