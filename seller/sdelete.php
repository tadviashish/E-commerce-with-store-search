<?php
require('database.php');
if (isset($_GET['delete'])) {
  $pid = $_GET['delete'];
  $sql = "DELETE FROM seller_data WHERE seller_id = '$pid'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo " Deleted successfuly";
    header('Location:signup.php');
    $pid = "";
  } else {
    echo mysqli_errno($conn);
  }
}
?>