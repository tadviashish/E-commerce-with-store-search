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

if (isset($_POST['edit'])) {
  $pid = $_POST['edit'];
  $sql = "SELECT * FROM products WHERE pid ='$pid'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
  } else {
    echo "Error: Product not found";
    exit;
  }
}

if (isset($_POST['update'])) {
  $pid = $_POST['pid'];
  $name = $_POST['pname'];
  $desc = $_POST['desc'];
  $cat = $_POST['category'];
 $quantity = $_POST['pquantity'];
  $price = $_POST['price'];
  $discount = $_POST['discount'];
  $discount_valid = $_POST['discount_valid'];
  // $files = count($_FILES['image']['name']);
  // $allfile = array();
  // for ($i = 0; $i < $files; $i++) {
  //   $imagename = $_FILES['image']['name'][$i];
  //   $tempname = $_FILES['image']['tmp_name'][$i];

  //   $imgexte = explode('.', $imagename);
  //   $imgexte = strtolower(end($imgexte));

  //   $newimgname = uniqid() . '.' . $imgexte;
  //   move_uploaded_file($tempname, 'uploads/' . $newimgname);

  //   $allfile[] = $newimgname;
  // }

  // $allfile = json_encode($allfile);
  $sql = "UPDATE products SET pname='$name',pdesc='$desc',pcategory='$cat',pquantity='$quantity',price='$price',discount='$discount',discount_valid='$discount_valid' WHERE pid='$pid'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location:sproduct.php");
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

    .content table tr td input {
      height: 28px;
      width: 40%;
    }

    .content table tr td select {
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
        <form action="pupdate.php" method="post" enctype="multipart/form-data">

          <table id="seller">
            <tr style="display: none;">
              <th>id : </th>
              <td><input style="display: none;" type="text" name="pid" value="<?php echo $row['pid']; ?>" placeholder="Product Name">
              </td>
            </tr>
            <tr>
              <th>product Name : </th>
              <td><input type="text" name="pname" value="<?php echo $row['pname']; ?>" placeholder="Product Name">
              </td>
            </tr>
            <tr>
              <th>Description : </th>
              <td><input type="text" name="desc" value="<?php echo $row['pdesc']; ?>" placeholder="Product Description">
              </td>
            </tr>

            <tr>
              <th>Quantity:</th>
              <td><input type="number" name="pquantity" value="<?php echo $row['pquantity']; ?>" placeholder="Quantity"></td>
            </tr>

            <tr>
              <th>Price </th>
              <td><input type="number" name="price" value="<?php echo $row['price']; ?>" placeholder="Price"></td>
            </tr>
            <tr>
              <th>Discount </th>
              <td><input type="number" name="discount" value="<?php echo $row['discount']; ?>" placeholder="Discount"></td>
            </tr>
            <tr>
              <th>Discount Validity </th>
              <td><input type="date" name="discount_valid" value="<?php echo $row['discount_valid']; ?>" placeholder="Discount Validity"></td>
            </tr>

            <tr>
              <th>Category : </th>
              <td> <input type="text" name="cat" value="<?php echo $row['pcategory']; ?>" readonly>
                <select name="category">
                  <option><?php echo $row['pcategory']; ?></option>
                  <?php
                  $sql = "SELECT * from product_category";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <option><?php echo $row['product_category']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <th>images </th>
              <td>
                <?php
                $sql = "SELECT * from products WHERE pid='$pid'";
                $result = mysqli_query($conn, $sql);
                $row2 = mysqli_fetch_array($result);
                foreach (json_decode($row2['image']) as $image) :
                ?>
                  <img src="uploads/<?php echo $image ?>" width="100px" height="100px">
                <?php endforeach; ?>
                <input type="file" name="image[]" value="<?php echo $image  ?>" accept=".jpg, .png,.jpeg" multiple>
              </td>
            </tr>
          </table>
          <button type="submit" name="update">Update</button>
        </form>
      </div>
    </div>
  </div>

</html>