<?php
require('database.php');

    if(isset($_POST['button']))
    {
      $mobile = $_POST['mobile'];
      $pass = $_POST['pass'];
      if($mobile!="" && $pass!="")
      {

        $sql = "SELECT * FROM customer_login WHERE cmobile = '$mobile' OR cemail = '$mobile' AND cpassword = '$pass'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $num = mysqli_num_rows($result);
        if($num==1)
        {
          session_start();
          $id =  $row['cust_id'];
          $_SESSION['cust'] = $id;
          $_SESSION['mobile'] = $mobile;
          $_SESSION['pass'] = $pass;
          header("Location:homepage.php");
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
    <title>SignUp</title>
    <style>
      .content {
        height: 400px;
        width: 100%;
        border: 1px solid black;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
      }
      .left {
        height: 337px;
        width: 400px;
        border: 1px solid black;
        background: rgb(250, 233, 233);
      }
      .right {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
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

      .login a{
        text-decoration: none;
        color: blue;
      }
    </style>

  </head>
  <body>
    <div class="content">
      <div class="left">
        <img src="login.png" alt="" />
      </div>
      <div class="right">
        <h2>Customer LOGIN</h2>
        <form action="login.php" method="post">
          <input type="text" name="mobile" placeholder="Email or Mobile" />
          <input type="password" name="pass" placeholder="Password" />
          <button type="submit" name="button">LOGIN</button>
        </form>
        <div class="login">
            <span>Create an Account&nbsp;</span><a href="signup.php">Signup</a>
        </div>
      </div>
    </div>
  </body>
</html>
