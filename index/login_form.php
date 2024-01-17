<?php
if (class_exists('Database')) {
    require_once('dbconn.php');
}

class UserAuthenticator {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function loginUser($email, $pass) {
        if (empty($email) || empty($pass)) {
            echo '<script>alert("Vul de lege velden in")</script>';
        } else {
            try {
                $query = "SELECT * FROM inlog WHERE email = :email";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $db_password = $user['password'];

                    if (password_verify($pass, $db_password)) {
                        $this->startSession($email, $user['inlogid']);
                        header("location: autoshow.html");
                        exit();
                    } else {
                        echo '<script>alert("Ongeldige inloggegevens")</script>';
                    }
                } else {
                    echo '<script>alert("Ongeldige inloggegevens")</script>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    private function startSession($email, $userId) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $userId;
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $userAuthenticator = new UserAuthenticator($database->getPDO());
    $userAuthenticator->loginUser($email, $pass);
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
    <form method="POST" action="">
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