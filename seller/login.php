<?php
require('database.php');

if (isset($_GET['button'])) {
  $mobile = $_GET['mobile'];
  $pass = $_GET['pass'];
  if ($mobile != "" && $pass != "") {

    $sql = "SELECT * FROM seller_data WHERE mobile = '$mobile' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      session_start();
      $_SESSION['mobile'] = $mobile;
      $_SESSION['pass'] = $pass;
      header("Location:sprofile.php");
    } else {
      echo "The record was not found ---> " . mysqli_error($conn);
    }
  } else {
    echo "Enter Mobile or Password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .content {
      height: 400px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      background-color: rgb(212, 248, 245);
    }

    .left {
      height: 399px;
      width: 515px;
      background: rgb(250, 233, 233);
    }

    .left img {
      height: 100%;
      width: 100%;
    }

    .right {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-left: 100px;
    }

    .right form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .right form input {
      margin: 10px;
      width: 307px;
      height: 24px;
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
  </style>
</head>

<body>
  <div class="content">
    <div class="left">
      <img src="bgimage.jpg" alt="" />
    </div>
    <div class="right">
      <h3>LOGIN</h3>
      <form action="login.php" method="get">
        <input type="number" name="mobile" placeholder="Email or Mobile" />
        <input type="password" name="pass" placeholder="Password" />
        <button type="submit" name="button">LOGIN</button>
      </form>
      <div class="login">
        <span>Create an Account&nbsp;</span><a href="signup.php">SignUp?</a>
      </div>
    </div>
  </div>
</body>

</html>