<?php

@include 'database.php';



if(isset($_POST['submit'])){

   $naam = mysqli_real_escape_string($conn, $_POST['naam']);
   $emailadres = mysqli_real_escape_string($conn, $_POST['emailadres']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM klanten WHERE emailadres = '$emailadres' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO klanten (naam, emailadres, password, user_type) VALUES('$naam','$emailadres','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
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
   
</head>
<body>

<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
    <div class="center">
      <input type="text" name="naam" required placeholder="enter your name"><br>
      <input type="email" name="emailadres" required placeholder="enter your email"><br>
      <input type="password" name="password" required placeholder="enter your password"><br>
      <input type="password" name="cpassword" required placeholder="confirm your password"><br>
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>
   </div>

</div>

</body>
</html>