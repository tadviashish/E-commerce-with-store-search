<?php
require('database.php');
session_start();
if (isset($_GET['update'])) {
    $sid = $_GET['update'];
    $sql = "SELECT * FROM seller_data WHERE seller_id ='$sid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $sid =  $row['seller_id'];
    if (mysqli_num_rows($result) > 0) {
        //echo "record found";
    } else {
        echo "Error to fetch record";
    }
}

if (isset($_GET['button'])) {
    $sid = $_GET['sid'];
    $name = $_GET['name'];
    $mobile = $_GET['mobile'];
    $pass = $_GET['pass'];
    $state = $_GET['state'];
    $dist = $_GET['dist'];
    $city = $_GET['city'];
    $pincode = $_GET['pincode'];
    $shop_name = $_GET['shop_name'];
    $shop_cat = $_GET['category'];
    $licence = $_GET['gstin'];
    $sql = "UPDATE seller_data SET name='$name',mobile='$mobile',password='$pass',state='$state',dist='$dist',city='$city',pincode='$pincode',shop_name='$shop_name',category='$shop_cat',gstin='$licence' WHERE seller_id = '$sid'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:sprofile.php");
    } else {
        echo mysqli_error($conn);
    }
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

    .content table tr th {
        width: 40%;
    }
    .content table tr th td {
        width: 50%;
    }
    .content table tr td input{
        height: 28px;
        width: 40%;
    }
    .content table tr td select{
        width: 20%;
        height: 28px;
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
        <h1>Your Details</h1>
        <form action="supdate2.php" method="get">
        <table id="seller">
          <?php

          // $sid = $_SESSION['seller_id'];
          $sql = "SELECT * FROM seller_data  WHERE seller_id='$sid'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          // $id =  $row['seller_id'];
          ?>
          <tr style="display: none;">
            <th >id : </th>
            <td><input  type="text" name="sid" value="<?php echo $row['seller_id']; ?>"></td>
          </tr>
          <tr>
            <th>Name : </th>
            <td><input type="text" name="name" value="<?php echo $row['name']; ?>" /></td>
          </tr>
          <tr>
            <th>Mobile No : </th>
            <td><input type="number" name="mobile" value="<?php echo $row['mobile']; ?>"></td>
          </tr>
          <tr>
            <th>password : </th>
            <td><input type="text" name="pass" value="<?php echo $row['password']; ?>"></td>
          </tr>
          <tr>
            <th>State : </th>
            <td><input type="text" name="state" value="<?php echo $row['state']; ?>"></td>
          </tr>
          <tr>
            <th>District : </th>
            <td><input type="text" name="dist" value="<?php echo $row['dist']; ?>"></td>
          </tr>
          <tr>
            <th>City : </th>
            <td><input type="text" name="city" value="<?php echo $row['city']; ?>"></td>
          </tr>
          <tr>
            <th>Pincode : </th>
            <td><input type="number" name="pincode" value="<?php echo $row['pincode']; ?>"></td>
          </tr>
          <tr>
            <th>Shop Name : </th>
            <td><input type="text" name="shop_name" value="<?php echo $row['shop_name']; ?>"></td>
          </tr>
          <tr>
            <th>GSTIN NO : </th>
            <td><input type="text" name="gstin" value="<?php echo $row['gstin']; ?>"></td>
          </tr>
          <tr>
            <th>Category : </th>
            <td> <input type="text" name="cat" value="<?php echo $row['category']; ?>" readonly>
                    <select name="category">
                        <option><?php echo $row['category']; ?></option>
                        <?php
                        $sql = "SELECT * from shop_category";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option><?php echo $row['category']; ?></option>
                        <?php } ?>
                    </select></td>
          </tr>

        </table>
          <button type="submit" name="button">Save Information</button>
        </form>
      </div>
    </div>
  </div>

</html>