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
      <form action="search_product.php" method="get">
                <input type="text" name="search" placeholder="search" required />
                <button type="submit" name="searachinfo">SEARCH</button>
            </form>
      </div>
      <div class="content">
      <h2>PRODUCT DETAILS</h2>
        <form action="./addproduct.php" method="get">
          <div class="button">
              <button type="submit" name="deletedata">Delete</button>
              <button style="background: green; width: 168px;" type="submit" name="addproduct">ADD PRODUCT</button>
            </div>
        <table id="seller">
          <tr>
            <th>Select</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Discount Validity</th>
            <th>Images</th>
            <th>Action</th>
          <tr>
            <?php
            $sql = "SELECT * FROM products WHERE seller_id = $id";
            $rows = mysqli_query($conn, $sql);
            foreach ($rows as $row) :
            ?>
          <tr>
            <td> <input style="height: 15px; width:15px" type="checkbox" name="select[]" value="<?php echo $row['pid']; ?>"></td>
            <td><?php echo $row['pname'] ?></td>
            <td><?php echo $row['pdesc'] ?></td>
            <td><?php echo $row['pcategory'] ?></td>
            <td>
                <?php if ($row['pquantity'] <= 0) {
                  echo "out of stock";
                } else {
                  echo $row['pquantity'];
                }
                ?>
              </td>
              <td>
                <?php
                $today = date("d/m/Y");
                $date = $row['discount_valid'];
                $date = date_create($date);
                $discount_date =  date_format($date, "d/m/Y");
                if ($row['discount'] <= 0 || $today > $discount_date) {
                  echo $row['price'];
                } elseif ($today < $discount_date || $today == $discount_date) {
                  if ($row['discount'] > 0) {
                    echo "<del>" . $row['price'] . "</del>" . "<br>";
                    $discount_price = $row['price'] - $row['discount'];
                    echo $discount_price;
                  }
                }
                ?>

              </td>            
              <td><?php echo $row['discount'] ?></td>
              <td>
                <?php
                if ($row['discount'] > 0) {
                  $date = $row['discount_valid'];
                  $date2 = date_create($date);
                  echo date_format($date2, "d/m/Y");
          
                } else {
                  echo $row['discount_valid'];
                }


                ?>


              </td>
            
            <td>
              <?php
              foreach (json_decode($row['image']) as $image) :
              ?>
              <?php endforeach; ?>
              <img src="uploads/<?php echo $image ?>" width="100px" height="100px">
            </td>
            <td>
              <form action=""></form>
              <form action="pupdate.php" method="post" enctype="multipart/form-data">
                <button type="submit" name="edit" value="<?php echo $row['pid']; ?>">Edit</button>
              </form>

              <form action="pdelete.php" method="get">
                <button type="submit" name="delete" value="<?php echo $row['pid']; ?>" style="background: red;">Delete</button>
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