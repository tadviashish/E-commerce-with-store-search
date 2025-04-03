<?php
require('database.php');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $length = strlen( $mobile);
  if ($name != "" && $mobile != "" && $email != "" && $pass!="" && $length == 10) {
    $sql = "SELECT * FROM customer_login WHERE cmobile = '$mobile'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
      $sql =  "INSERT INTO customer_login(cname, cmobile,cemail, cpassword) VALUES ('$name','$mobile','$email','$pass')";
      $result = mysqli_query($conn, $sql);
      if ($result) 
      {
        session_start();
          $_SESSION['mobile'] = $mobile;
          $_SESSION['pass'] = $pass;
          header("Location:cprofile.php");
        // header("refresh:1;url=homepage.php");
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
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="pass" placeholder="Password" />
        <input class="btn " type="submit" name="submit" value="SignUp" />
      </form>
      <div class="login">
        <span>Already have an Account&nbsp;</span><a href="login.php">LOGIN?</a>
      </div>
    </div>
  </div>
</body>

</html>