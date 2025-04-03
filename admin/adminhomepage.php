
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
        height: 100%;
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
        height: 100vh;
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
      }

      .right input {
        width: 220px;
        border-radius: 25px;
        height: 20px;
        border: 1px solid black;
      }
      .search{
        margin-right: 70px;
        width: 100px;
        cursor: pointer;
      }
      .btn{
        cursor: pointer;
        width: 100px;
      }
    </style>
  </head>
  <body>
    
    <div class="container">
      <nav class="navbar">
        <ul>
          <li><a href="seller_information.php">Seller information</a></li>
          <li><a href="customer_info.php">Customer information</a></li>
          <li><a href="order_info.php">Orders information</a></li>
          <li><a href="seller_request.php">Seller Verification</a></li>
          <li><a href="product_request.php">Product Verification</a></li>
          <li><a href="allproducts.php">Products Details</a></li>
          <li><a href="category.php">Category Update</a></li>
        </ul>
      </nav>
      <div class="content">
        
      </div>
    </div>
  </body>
</html>
