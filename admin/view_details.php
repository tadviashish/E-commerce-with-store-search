<?php
require('database.php');
session_start();

$id = $_GET['viewdetails'];
// echo $id;

if(isset($_GET))

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Home Page</title>
    <style>
      .container {
        display: flex;
      }

      .container section {
        margin: 10px;
        height: 100%;
      }
      .navbar {
        width: 14vw;
        height: 44vw;
        display: flex;
        justify-content: flex-start;
        flex-direction: column;
        background: rgb(89, 145, 168);
      }
      .navbar ul {
        margin-top: 32px;
        margin-left: -44px;
      }
      .navbar ul li {
        list-style: none;
        list-style: none;
        margin: 7px;
        border: 1px solid black;
        padding: 6px;
        cursor: pointer;
      }
      .navbar ul li a {
        text-decoration: none;
        cursor: pointer;
        color: black;
      }
      .navbar ul li a:hover {
        color: white;
      }

      section {
        height: 100%;
        width: 100vh;
        display: flex;
        flex-direction: column;
      }
      .hnav {
        height: 60px;
        width: 100%;
        background: rgb(244, 168, 244);
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .hnav .left {
        margin-left: 40px;
      }
      .hnav .right {
        margin-right: 30px;
        display: flex;
        align-items: center;
      }

      .right input {
        width: 220px;
        border-radius: 25px;
        height: 20px;
        border: 1px solid black;
      }
      .search{
        margin: 10px;
        width: 100px;
        cursor: pointer;
      }
      .btn{
        cursor: pointer;
        width: 100px;
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
    .content{
        margin-left: 23px;
    }
    </style>
  </head>
  <body>
  <div class="hnav">
        <div class="left">ADMIN</div>
        <div class="right">
            <input type="text" name="search" />
            <button class="search">SEARCH</button>
            <form action="adminhomepage.php" method="get">
                <button class="btn" name="logout">LOGOUT</button>
            </form>
        </div>
    </div>
    <div class="container">
      <nav class="navbar">
        <ul>
          <li><a href="seller_information.php">Seller information</a></li>
          <li><a href="seller_request.php">Seller Verification</a></li>
          <li><a href="product_request.php">Product Verification</a></li>
          <li><a href="category.php">Category Update</a></li>
        </ul>
      </nav>
      <div class="content">
      <h1>Seller Details</h1>
        <table id="seller" >
          <?php
          $sql = "SELECT * FROM seller_data  WHERE seller_id='$id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          $id =  $row['seller_id'];
          ?>
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
          <tr>
            <th>Address Proof : </th>
            <td><?php
                        foreach (json_decode($row['address']) as $image) :
                        ?>
                            <img src="../seller/idproof/<?php echo $image ?>" width="100px" height="100px">
                        <?php endforeach; ?></td>
          </tr>
        </table>


        <h2>PRODUCT DETAILS</h2>
            <table id="seller">
                <tr>
                    <th>Seller id</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Images</th>
                <tr>
                    <?php
                    $sql = "SELECT * FROM products WHERE seller_id='$id'";
                    $rows = mysqli_query($conn, $sql);
                    foreach ($rows as $row) :
                    ?>
                <tr>
                    <td><?php echo $row['seller_id'] ?></td>
                    <td><?php echo $row['pname'] ?></td>
                    <td><?php echo $row['pdesc'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><?php echo $row['discount'] ?></td>
                    <td><?php echo $row['discount_valid'] ?></td>
                    <td>
                        <?php
                        foreach (json_decode($row['image']) as $image) :
                        ?>
                            <img src="../seller/uploads/<?php echo $image ?>" width="100px" height="100px">
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
      </div>
    </div>
  </body>
</html>
