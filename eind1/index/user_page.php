<?php

@include 'database.php';

session_start();

if(!isset($_SESSION['naam'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>
   <style>
    body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-image:url(1.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
}

.form-container {
    text-align: center;
    background-color: #ffcc33;
    padding: 50px;
    border-radius: 75px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
    margin: 1;
}

.login-button {
    background-color: #ffcc33;
    color: #000;
    border: none;
    padding: 15px 80px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

    </style>
   <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['naam'] ?></span></h1>
      <p>this is an user page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>