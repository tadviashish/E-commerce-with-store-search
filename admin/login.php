<?php
require('database.php');

    if(isset($_GET['button']))
    {
      $user = $_GET['username'];
      $pass = $_GET['pass'];
      if($user!="" && $pass!="")
      {

        $sql = "SELECT * FROM admin_login WHERE username = '$user' AND password = '$pass'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
          session_start();
          $_SESSION['username'] = $user;
          $_SESSION['pass'] = $pass;
          header("Location:seller_information.php");
        } 
        else{
          echo "The record was not found ---> ".mysqli_error($conn); 
        } 
      }
      else
      {
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
        <img src="../seller/bgimage.jpg" alt="" />
      </div>
      <div class="right">
        <h3>ADMIN LOGIN</h3>
        <form action="login.php" method="get">
          <input type="text" name="username" placeholder="Username" />
          <input type="password" name="pass" placeholder="Password" />
          <button type="submit" name="button">LOGIN</button>
        </form>
        
      </div>
    </div>
  </body>
</html>
