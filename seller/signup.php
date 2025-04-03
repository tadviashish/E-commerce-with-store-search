<?php
require('database.php');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $pass = $_POST['pass'];
  $state = $_POST['state'];
  $dist = $_POST['dist'];
  $city = $_POST['city'];
  $pincode = $_POST['pincode'];
  $shop_name = $_POST['shop_name'];
  $category = $_POST['category'];
  $gstin = $_POST['gstin'];
  $proofid = $_FILES['proof']['name'];

  $imagename = $_FILES['proof']['name'];
  $tempname = $_FILES['proof']['tmp_name'];

  $imgexte = explode('.', $imagename);
  $imgexte = strtolower(end($imgexte));

  $newimgname = uniqid() . '.' . $imgexte;
  move_uploaded_file($tempname, 'idproof/' . $newimgname);

  $allfile[] = $newimgname;

  $allfile = json_encode($allfile);

  $length = strlen($mobile);
  if ($name != "" && $mobile != "" && $pass != "" && $state!="" &&  $dist!="" &&  $city!="" &&  $pincode!="" &&  $shop_name!="" &&  $category!="" &&  $gstin!="" &&   $length == 10) {
    $sql = "SELECT * FROM seller_request WHERE mobile = '$mobile'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {

      $sql =  "INSERT INTO seller_request(name, mobile, password, state, dist, city, pincode, shop_name, category, gstin, address) VALUES ('$name','$mobile','$pass','$state','$dist','$city','$pincode','$shop_name','$category','$gstin','$allfile')";
      $result = mysqli_query($conn, $sql);
      if ($result) 
      {
        echo "Requested for Verification";
        header("refresh:2;url=signup.php");
      } else 
      {
        echo "The record was not inserted successfully " . mysqli_error($conn);
      }
    } 
    else 
    {
      echo "Account Found";
    }
  } 
  else 
  {
    echo "Enter Valid Mobile Number OR fill all details";
    //header("Location:signup.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SignUp</title>
  <style>
    .content {
      height: 500px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      background-color: antiquewhite;
    }

    .left {
      height: 399px;
      width: 515px;
      background: rgb(250, 233, 233);
    }

    .left img {
      height: 100%;
      width: 506px;
    }

    .right {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-left: 100px;
      margin-top: 37px;
    }

    .right form {
      width: 500px;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }

    .right form input {
      height: 28px;
      width: 200px;
      margin: 10px;
      border: none;
      outline: none;
      border-bottom: 1px solid black;

    }

    .right form button {
      margin: 10px;
      width: 313px;
      height: 24px;
      border: 1px solid black;

    }

    .right input::placeholder {
      padding: 12px;
      color: rgb(79, 76, 76);
    }

    .login a {
      text-decoration: none;
      color: blue;
    }

    .right .btn {
      border: 1px solid black;
      margin-left: 125px;
      margin-top: 17px;
    }

    .right select {

      height: 28px;
      width: 200px;
      margin: 10px;
      border: 1px solid black;
    }
  </style>

</head>

<body>
  <div class="content">
    <div class="left">
      <img src="bgimage.jpg" alt="" />
    </div>
    <div class="right">
      <h3>CREATE ACCOUNT</h3>
      <form id="form" action="signup.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Full Name" />
        <input type="number" name="mobile" placeholder="Mobile No" />
        <input type="password" name="pass" placeholder="Password" />
        <input type="text" name="state" placeholder="State" />
        <input type="text" name="dist" placeholder="District">
        <input type="text" name="city" placeholder="City" />
        <input type="number" name="pincode" placeholder="Pincode" />
        <input type="text" name="shop_name" placeholder="Shop Name">

        <select name="category">
          <option>Select Category</option>
          <?php
          $sql = "SELECT * from shop_category";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <option><?php echo $row['category']; ?></option>
          <?php } ?>
        </select>
        
        <input type="text" name="gstin" placeholder="GSTIN No." />
        <input style="width: 150px;" type="file" name="proof" accept=".jpg, .png,.jpeg" />
        <lable>Upload Address ID</lable>
        <input class="btn " type="submit" name="submit" value="SignUp" />
      </form>
      <div class="login">
        <span>Already have an Account&nbsp;</span><a href="login.php">LOGIN?</a>
      </div>
    </div>
  </div>
</body>

</html>