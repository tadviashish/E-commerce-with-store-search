
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Home Page</title>
    <style>
        .container{
            display: flex;
        }

        .container section{
            margin: 10px;
            height: 100%;
        }
      .navbar {
        width: 10vw;
        height: 46vw;
        display: flex;
        justify-content: flex-start;
        flex-direction: column;
        background: rgb(145, 192, 239);
      }
      .navbar ul {
        margin-top: 32px;
        margin-left: -44px;
      }
      .navbar ul li {
        list-style: none;
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
      .navbar img {
        border-radius: 50%;
      }

      section{
        height: 100vh;
        width: 100vh;
        display: flex;
        flex-direction: column;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <nav class="navbar">
        <img src="profile.jpeg" alt="" />
        <ul>
          <li><a href="sprofile.php">Profile</a></li>
          <li><a href="sproduct.php">Product</a></li>
          <li><a href="orders.php">Order</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </body>
</html>
