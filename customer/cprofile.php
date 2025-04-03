<?php
require('database.php');
session_start();

if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT cust_id FROM customer_login WHERE cmobile = '$mobile' AND cpassword='$pass'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id =  $row['cust_id'];

    $_SESSION['cust'] = $id;


    echo $_SESSION['cust'];
    
    // echo $row['name'];
    // echo $mobile;

}

if (isset($_GET['submit'])) {
    $name = $_GET['name'];
    $mobile = $_GET['mobile'];
    $state = $_GET['state'];
    $dist = $_GET['dist'];
    $city = $_GET['city'];
    $pincode = $_GET['pincode'];

    $length = strlen($mobile);
    if ($name != "" && $mobile != "" && $pass != "" && $state!="" &&  $dist!="" &&  $city!="" &&  $pincode!="" &&   $length == 10) {
      $sql = "SELECT * FROM cust_data WHERE cust_mobile = '$mobile'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 0) {
  
        $sql =  "INSERT INTO cust_data(cust_id,cust_name, cust_mobile, cust_state, cust_dist, cust_city, cust_pincode) VALUES ('$id','$name','$mobile','$state','$dist','$city','$pincode')";
        $result = mysqli_query($conn, $sql);
        if ($result) 
        {
          header("refresh:1;url=cprofile.php");
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

        #customer {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customer td,
        #customer th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customer tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customer tr:hover {
            background-color: #ddd;
        }

        #customer th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .right {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
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

        .content {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: column;
        }
    </style>
</head>

<body>   
    <div class="container">
        <?php
        require('chome.php');
        ?>

        <div class="container2">
            <div class="header">
               
            </div>
            <div class="content">
                <?php
                $sql = "SELECT * FROM cust_data  WHERE cust_id='$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                //   $id =  $row['cust_id'];
                if ($row > 0) {
                ?>
                    <h1>Your Details</h1>
                    <table id="customer">

                        <tr>
                            <th>Customer ID : </th>
                            <td><?php echo $row['cust_id'];  ?></td>
                        </tr>
                        <tr>
                            <th>Name : </th>
                            <td><?php echo $row['cust_name'];  ?></td>
                        </tr>
                        <tr>
                            <th>Mobile No : </th>
                            <td><?php echo $row['cust_mobile'];  ?></td>
                        </tr>
                        <tr>
                            <th>State : </th>
                            <td><?php echo $row['cust_state'];  ?></td>
                        </tr>
                        <tr>
                            <th>District : </th>
                            <td><?php echo $row['cust_dist'];  ?></td>
                        </tr>
                        <tr>
                            <th>City : </th>
                            <td><?php echo $row['cust_city'];  ?></td>
                        </tr>
                        <tr>
                            <th>Pincode : </th>
                            <td><?php echo $row['cust_pincode'];  ?></td>
                        </tr>


                    </table>
                <?php } else {
                ?>

                    <div class="right">
                        <h3>Enter Your Details</h3>
                        <form id="form" action="cprofile.php" method="get" enctype="multipart/form-data">
                            <input type="text" name="name" placeholder="Full Name" />
                            <input type="number" name="mobile" placeholder="Mobile No" />
                            <input type="text" name="state" placeholder="State" />
                            <input type="text" name="dist" placeholder="District">
                            <input type="text" name="city" placeholder="City" />
                            <input type="number" name="pincode" placeholder="Pincode" />
                            <input class="btn " type="submit" name="submit"/>
                        </form>
                    </div>
                <?php
                }
                ?>
                <!-- <form action="supdate2.php" method="get">
          <button type="submit" name="update" value="<?php echo $row['customer_id']; ?>">UPDATE</button>
        </form>
        <form action="sdelete.php" method="get">
          <button style="background: red;" type="submit" name="delete" value="<?php echo $row['customer_id']; ?>">DELETE ACCOUNT</button>
        </form> -->
            </div>
        </div>
    </div>
</html>