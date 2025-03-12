<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Crep Culture</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
       @include("header")
    </header>

    <main class="help-center">
        <div class="container">
            <h1>Welcome to the Crep Culture Help Center</h1>
            <p>Your go-to place for all support and inquiries. Browse the topics below to find the help you need.</p>
            <div class="faq-section">
                <div class="faq-item">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="#">How do I create an account and what are the benefits?</a></li>
                    </ul>
                </div>
                <div class="faq-item">
                    <h2>Shipping & Delivery</h2>
                    <ul>
                        <li><a href="#">Do you ship to my country?</a></li>
                        <li><a href="#">Tax & Import Duty</a></li>
                        <li><a href="#">Who will deliver my item?</a></li>
                        <li><a href="#">Why does the price vary for the same product type?</a></li>
                    </ul>
                </div>
                <div class="faq-item">
                    <h2>Returns</h2>
                    <ul>
                        <li><a href="#">Do you charge for returns?</a></li>
                        <li><a href="#">How long do orders take to be processed?</a></li>
                        <li><a href="#">What’s the return policy for online purchases?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer>
       @include("footer")
    </footer>
</body>
</html>
