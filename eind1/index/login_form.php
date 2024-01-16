<?php
$db['host'] = "localhost:3307"; // Host name
$db['user'] = "root"; // MySQL username
$db['pass'] = ""; // MySQL password
$db['name'] = "RAC"; // Database name

include('config.php');

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']};charset=utf8", $db['user'], $db['pass']);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";

    // Process form submission
    if (isset($_POST['send'])) {
        // Get form data
        $inlogid = htmlspecialchars($_POST['inlogid']);
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO inlog (inlogid, email, password) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $hash);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} finally {
    // Close the PDO connection
    $pdo = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form method="POST" action="index.html">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                            <label for="reg-log"></label>
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Log In</h4>
                                                <div class="form-group">
                                                    <input type="email" class="form-style" placeholder="Email" name="email">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>	
                                                <div class="form-group mt-2">
                                                    <input type="password" class="form-style" placeholder="Password" name="password">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Login</button>
                                                <p class="mb-0 mt-4 text-center"><a href="https://www.web-leb.com/code" class="link">Forgot your password?</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-back">
                <div class="center-wrap">
                  <div class="section text-center">
                    <h4 class="mb-3 pb-3">Sign Up</h4>
                    <div class="form-group">
                      <input type="text" class="form-style" placeholder="Full Name">
                      <i class="input-icon uil uil-user"></i>
                    </div>	
                    <div class="form-group mt-2">
                      <input type="tel" class="form-style" placeholder="Phone Number">
                      <i class="input-icon uil uil-phone"></i>
                    </div>	
                    <div class="form-group mt-2">
                      <input type="email" class="form-style" placeholder="Email">
                      <i class="input-icon uil uil-at"></i>
                    </div>
                    <div class="form-group mt-2">
                      <input type="password" class="form-style" placeholder="Password">
                      <i class="input-icon uil uil-lock-alt"></i>
                    </div>
                    <a href="index.html" class="btn mt-4">Register</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
  </form>
</body>
</html>
