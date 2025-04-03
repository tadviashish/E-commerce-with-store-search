<?php
require('database.php');
session_start();

if (!isset($_SESSION['mobile'])) {
    header("Location : login.php");
    exit;
} else {
    $mobile = $_SESSION['mobile'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT cust_id,cname FROM customer_login WHERE cmobile = '$mobile' AND cpassword='$pass'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
      $cid =  $row['cust_id'];
    //   echo $id;
    // echo $row['name'];
    // echo $mobile;

}
if (isset($_GET['cart'])) 
{
    $pid = $_GET['cart'];
    $oquantity = $_GET['quantity'];
    // echo $pid;

    $sql = "SELECT * FROM products WHERE pid='$pid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $pname =  $row['pname'];
    $pdesc =  $row['pdesc'];
    $pcategory =  $row['pcategory'];
    $price =  $row['price'];

    foreach (json_decode($row['image']) as $image) :
    endforeach;
    move_uploaded_file($image,'uploads/');
    $images = json_encode($image);
    $today = date("d/m/Y");
    $date = $row['discount_valid'];
    $date = date_create($date);
    $discount_date =  date_format($date, "d/m/Y");
    if ($row['discount'] <= 0 || $today > $discount_date) 
    {
        echo "<span>&#8377&nbsp</span>" . $row['price'];
        $price =  $row['price'];;
    } elseif ($today < $discount_date || $today == $discount_date) 
    {
        if ($row['discount'] > 0) 
        {
            echo "<span>&#8377 </span>" . $row['discount'] . " " . "off" . "<del>" . $row['price'] . "</del>";
            $discount_price = $row['price'] - $row['discount'];
            echo $discount_price;
            $price = $discount_price;
        }
    }
    $sid = $row['seller_id'];
    $pquantity = $row['pquantity'];
    if($oquantity<$pquantity)
    {
        // $oquantity = $_GET['quantity'];
    }
    else{
        echo "order quantity not full fill";
    }

    $sql = "INSERT INTO cart(seller_id, cust_id,product_id, product_name, product_desc, product_price, product_category,img) VALUES ('$sid','$cid','$pid','$pname','$pdesc','$price','$pcategory','$images')";
    $result = mysqli_query($conn, $sql);

    header("location:productlist.php");
    // $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERS</title>
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

        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .result {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background-color: antiquewhite;
            width: 48vw;
            margin: 14px;
            padding: 14px;
        }

        .data {
            margin-left: 300px;
        }

        .storeinfo {
            width: 45vw;
            margin: 14px;
        }

        .storeinfo li {
            list-style: none;

        }

        .storeinfo li a {
            text-decoration: none;

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
            $sql = "SELECT * FROM order_details WHERE cust_id = '$cid'";
            $rows = mysqli_query($conn, $sql);
            foreach ($rows as $row) : ?>
                <!-- echo $row['shop_name']; -->
                <div class="result">
                    <!-- <img src="../seller/uploads/<?php echo $rows2['image']; ?>" alt="Store" height="100px" width="100px"> -->
                    <div class="storeinfo">
                        <li><strong><a href="productdetails.php?product=<?php echo $row['pid']; ?>"><?php echo $row['pname'] ?></a></strong></li>
                        <p><?php echo $row['pdesc'] ?></p>
                        <p><?php echo "<span>&#8377 </span>".$row['price'] ?></p>
                        <p><?php echo "Order Status :".$row['order_status'] ?></p>
                    </div>
                        <div class="action">
                            <form action="cancel.php" method="get">
                                <!-- <button><a href="cart.php?cart=">Add to Cart</a></button> -->
                                <button type="submit" name="cancel" value="<?php echo $row['order_id']; ?>" style="background: #f2f2f2; width:90px; color:black">CANCEL</button>
                            </form>
                              
                                <!-- <button><a href="order.php?order=<?php echo $row['pid']; ?>" style="background: #f2f2f2; width:70px; color:black">Order</a></button> -->
                        </div>

                </div>
            <?php endforeach;
            ?>

            </div>
        </div>`
            


                <!-- <form action="supdate2.php" method="get">
          <button type="submit" name="update" value="<?php echo $row['seller_id']; ?>">UPDATE</button>
        </form>
        <form action="sdelete.php" method="get">
          <button style="background: red;" type="submit" name="delete" value="<?php echo $row['seller_id']; ?>">DELETE ACCOUNT</button>
        </form> -->
            </div>
        </div>
    </div>

</html>