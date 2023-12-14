<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmand</title>
    <link rel="stylesheet" href="winkelmand.css">
</head>

<body>
    <header>
        <img src="logo.png" width="150" height="150" alt="XXL Nutrition Logo">
        <h1><u><a href="AutoShow.html" class="cart-link">AutoShow</a></u></h1>
        <h1>Winkelmand</h1>
    </header>

    <section class="cart-items">
        <h1>Uw Voorstel</h1>

        <p>Bedankt voor het voorstellen voor een nieuwe auto! Om terug te keren, druk op de onderstaande knop </p>
        <button id="continue-shopping" onclick="goToIndex()">terug gaan</button>
    </section>

    <footer>
        
        <div class="footer-content">
            <div class="contact-info">
                <h2>Contactgegevens</h2>
                <p>Email: info@AutoShow.com</p>
                <p>Telefoon: +31 (0) 123 456 789</p>
            </div>
            <div class="trust-pilot">
                <h2>Klantbeoordelingen</h2>
                <p>Bekijk onze beoordelingen op <a href="https://nl.trustpilot.com" target="_blank" class="trustpilot-link">TrustPilot</a></p>
            </div>
            <div class="payment-methods">
                <h2>Veilige Betalingen</h2>
                <img src="ideal.png" alt="iDEAL">
                <img src="mastercard.png" alt="Mastercard">
            </div>
        </div>
    
    </footer>

    <script>
        function goToIndex() {
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>
