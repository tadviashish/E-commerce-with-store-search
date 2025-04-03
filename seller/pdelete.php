<?php
require('database.php');
if (isset($_GET['delete'])) {
  $pid = $_GET['delete'];
  $sql = "DELETE FROM products WHERE pid = '$pid'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "Product Deleted successfuly";
    header('Location:sproduct.php');
    $pid = "";
  } else {
    echo mysqli_errno($conn);
  }
}
?>