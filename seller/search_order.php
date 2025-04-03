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


if (isset($_GET['searachinfo'])) {
    $search = $_GET['search'];
    // echo $search;
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
    .content button {
            border: 1px solid black;
            margin: 5px;
            padding: 5px;
            background: blue;
            color: white;
            border-radius: 1px;
            width: 70px;
            cursor: pointer;
        }

        .button {
            display: flex;
            margin: 10PX;
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

    .header form{
      margin: 15px;
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
      <form action="search_order.php" method="get">
                <input type="text" name="search" placeholder="search" required />
                <button type="submit" name="searachinfo">SEARCH</button>
            </form>
      </div>
      <div class="content">
      <h2>ORDER DETAILS</h2>
        <form action="./order_accept.php" method="get">
          <div class="button">
              <button type="submit" name="acceptorder">Accept</button>
              <button style="background: green; width: 168px;" type="submit" name="deleteorder">Delete</button>
            </div>
        <table id="seller">
          <tr>
            <th>Select</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Payment Info</th>
            <th>Status</th>
            <th>Action</th>
          <tr>
            <?php
            $sql = "SELECT * FROM order_details WHERE CONCAT(pname,cust_state,cust_name,cust_dist,cust_city,cust_pincode,pcategory,pquantity,price,order_status) LIKE '%$search%'";
            $rows = mysqli_query($conn, $sql);
            foreach ($rows as $row) :
            ?>
          <tr>
            <td> <input style="height: 15px; width:15px" type="checkbox" name="select[]" value="<?php echo $row['order_id']; ?>"></td>
            <td><?php echo $row['cust_name'] ?></td>
            <td><?php echo $row['cust_state']." ,".$row['cust_dist']." ,".$row['cust_city']." ,".$row['cust_pincode']?></td>
            <td><?php echo $row['pname'] ?></td>
            <td><?php echo $row['pquantity'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['payment'] ?></td>
            <td><?php echo $row['order_status'] ?></td>
            <td>
                <form action=""></form>
                <form action="order_accept.php" method="get" enctype="multipart/form-data">
                    <button type="submit" name="accept" value="<?php echo $row['order_id']; ?>">Accept</button>
                    <button type="submit" name="delete" value="<?php echo $row['order_id']; ?>" style="background: red;">Delete</button>
                </form>
                
            </td>

          </tr>
        <?php endforeach; ?>
        </table>
        </form>
      </div>
    </div>
  </div>

</html>