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

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $db_password = $row['password'];

                    if (md5($pass) == $db_password) {
                        $this->startSession($email, $row['inlogid']);
                        header("location: autoshow.html");
                        exit();
                    } else {
                        echo '<script>alert("Voer een juist wachtwoord in")</script>';
                    }
                } else {
                    echo '<script>alert("Voer een correct e-mailadres in")</script>';
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
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car MC</title>
    <link rel="stylesheet" href="styleee.css">
</head>
<body>
    <header>
        <img src="logo.png" width="200" height="200" alt="XXL Nutrition Logo">
        <h1>Rent a Car MC</h1>
        <div id="nava">
            <nav>
                <ul>
                    <li><a href="AutoShow.html"><b>Auto's</b></a></li>
                    <li><a href="form.html"><b>Toevoegen Auto's</b></a></li>
                    <li><a href="login_form.php"><b>Inloggen</b></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <h2>Ontdek de perfecte voertuigen</h2>
        <br>
        <p>Verbeter uw rijplezier met de prachtige auto's.</p>
        <br>
        <a href="AutoShow.html" class="cta-button">Bekijk voertuigen</a>
    </section>


    <div class="slider" x-data="{start: true, end: false}" style="padding-top: 150px;">
      <div class="slider__content" x-ref="slider" x-on:scroll.debounce="$refs.slider.scrollLeft == 0 ? start = true : start = false; Math.abs(($refs.slider.scrollWidth - $refs.slider.offsetWidth) - $refs.slider.scrollLeft) < 5 ? end = true : end = false;">
        <div class="slider__item">
          <img class="slider__image" src="Preworkout 1.jpg" alt="Image" width="100" height="100">
          <div class="slider__info">
            <h2>Card 1</h2>
          </div>
        </div>
        <div class="slider__item">
          <img class="slider__image" src="Preworkout 1.jpg" alt="Image" width="100" height="100">
          <div class="slider__info">
            <h2>Card 2</h2>
          </div>
        </div>
        <div class="slider__item">
          <img class="slider__image" src="Preworkout 1.jpg" alt="Image" width="100" height="100">
          <div class="slider__info">
            <h2>Card 3</h2>
          </div>
        </div>
        <div class="slider__item">
          <img class="slider__image" src="Preworkout 1.jpg" alt="Image" width="100" height="100">
          <div class="slider__info">
            <h2>Card 4</h2>
          </div>
        </div>
      <div class="slider__nav" style="display: flex;justify-content: center;">
        <button class="slider__nav__button" x-on:click="$refs.slider.scrollBy({left: $refs.slider.offsetWidth * -1, behavior: 'smooth'});" x-bind:class="start ? '' : 'slider__nav__button--active'">Previous</button>
        <button class="slider__nav__button" x-on:click="$refs.slider.scrollBy({left: $refs.slider.offsetWidth, behavior: 'smooth'});" x-bind:class="end ? '' : 'slider__nav__button--active'">Next</button>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.js"></script>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
    
</div>
    <footer>
        <div class="footer-info">
            <h3>INFORMATIE</h3>
            <ul>
                <li><a href="#">Algemene Voorwaarden</a></li>
                <li><a href="#">Verzenden & Retourneren</a></li>
                <li><a href="#">Privacy Verklaring</a></li>
            </ul>
        </div>

        <div class="footer-kosso">
            <h3>Rent a Car MC</h3>
            <ul>
                <li><a href="#">Rent a Car MC</a></li>
                <li><a href="#">Rent a Car MC KLEDING & ACCESSOIRES</a></li>
               
            </ul>
        </div>
    </footer>
    <script>
        
        
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productName = button.getAttribute('data-name');
                    const productPrice = parseFloat(button.getAttribute('data-price'));

                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    cart.push({ name: productName, price: productPrice });
                    localStorage.setItem('cart', JSON.stringify(cart));

                    window.location.href = 'AutoShow.html';
                });
            });
        });

        let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
    </script>
</body>
</html>
