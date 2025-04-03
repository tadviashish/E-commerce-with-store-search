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
        <table id="seller">
          <?php
          $sql = "SELECT * FROM seller_data  WHERE seller_id='$id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);

          $id =  $row['seller_id'];
          $_SESSION['seller_id'] = $id;
          ?>
          <tr>
            <th>Seller ID : </th>
            <td><?php echo $row['seller_id'];  ?></td>
          </tr>
          <tr>
            <th>Name : </th>
            <td><?php echo $row['name'];  ?></td>
          </tr>
          <tr>
            <th>Mobile No : </th>
            <td><?php echo $row['mobile'];  ?></td>
          </tr>
          <tr>
            <th>State : </th>
            <td><?php echo $row['state'];  ?></td>
          </tr>
          <tr>
            <th>District : </th>
            <td><?php echo $row['dist'];  ?></td>
          </tr>
          <tr>
            <th>City : </th>
            <td><?php echo $row['city'];  ?></td>
          </tr>
          <tr>
            <th>Pincode : </th>
            <td><?php echo $row['pincode'];  ?></td>
          </tr>
          <tr>
            <th>Shop Name : </th>
            <td><?php echo $row['shop_name'];  ?></td>
          </tr>
          <tr>
            <th>Category : </th>
            <td><?php echo $row['category'];  ?></td>
          </tr>
          <tr>
            <th>GSTIN NO : </th>
            <td><?php echo $row['gstin'];  ?></td>
          </tr>

        </table>
        <form action="supdate2.php" method="get">
          <button type="submit" name="update" value="<?php echo $row['seller_id']; ?>">UPDATE</button>
        </form>
        <form action="sdelete.php" method="get">
          <button style="background: red;" type="submit" name="delete" value="<?php echo $row['seller_id']; ?>">DELETE ACCOUNT</button>
        </form>
      </div>
    </div>
  </div>

</html>