<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Crep Culture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include("header")

    <section class="help">
        <div class="container">
            <h2>Welcome to the Crep Culture Help Center</h2>
            <p>Your go-to place for all support and inquiries. Browse the topics below to find the help you need.</p>
            <div class="diamond-layout">
                <!-- account Section -->
                <div class="topic-box" id="account-box">
                    <h3>Account</h3>
                    <p>1 article in this topic</p>
                    <ul>
                        <li><a href="/help/account-create">How do I create an account and what are the benefits?</a></li>
                    </ul>
                </div>

                <!-- shipping & Delivery Section -->
                <div class="topic-box" id="shipping-box">
                    <h3>Shipping & Delivery</h3>
                    <p>4 articles in this topic</p>
                    <ul>
                        <li><a href="/help/shipping-countries">Do you ship to my country?</a></li>
                        <li><a href="/help/shipping-tax">Tax & Import Duty?</a></li>
                        <li><a href="/help/shipping-delivery">Who will deliver my item?</a></li>
                        <li><a href="/help/shipping-price">Why does the price vary for the same product type?</a></li>
                    </ul>
                </div>

                <!-- returns Section -->
                <div class="topic-box" id="returns-box">
                    <h3>Returns</h3>
                    <p>3 articles in this topic</p>
                    <ul>
                        <li><a href="/help/returns-charges">When will I receive my refund?</a></li>
                        <li><a href="/help/returns-processing">How long do orders take to be processed?</a></li>
                        <li><a href="/help/returns-policy">What’s the return policy for online purchases?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- contact Us Section -->
    <section class="contact-us">
        <div class="container">
            <h3>Contact Us</h3>
            <p>Not finding what you're looking for? <a href="/contact" class="contact-link">Contact Us Directly</a></p>
        </div>
    </section>

    @include("footer")
</body>
</html>
