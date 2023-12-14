<?php

include 'database.php';

session_start();

if(isset($_POST['submit'])){
    $naam = isset($_POST['naam']) ? mysqli_real_escape_string($conn, $_POST['naam']) : '';
    $emailadres = isset($_POST['emailadres']) ? mysqli_real_escape_string($conn, $_POST['emailadres']) : '';
    $pass = isset($_POST['password']) ? md5($_POST['password']) : '';
    
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    $select = "SELECT * FROM klanten WHERE emailadres = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $select);
    mysqli_stmt_bind_param($stmt, "ss", $emailadres, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:pageg.php');
        } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:winkelmand.html');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Login Form</title>
    
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="email" name="emailadres" required placeholder="Enter your email"><br>
            <input type="password" name="password" required placeholder="Enter your password"><br>
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
        </form>
    </div>
</body>
</html>
