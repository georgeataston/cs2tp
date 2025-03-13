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
                <div class="topic-box" id="account-box">
                    <h3><a href="#" onclick="toggleTopic('account')">Account</a></h3>
                    <p>1 article in this topic</p>
                    <ul>
                        <li><a href="#" onclick="toggleContent('account-create')">How do I create an account and what are the benefits?</a></li>
                    </ul>
                    <div id="account" class="hidden topic-content">
                        <p>Manage your Crep Culture account with ease. Learn how to create an account, access your order history, and track your purchases using your order number.</p>
                        <div id="account-create" class="hidden">To create an account navigate to Sign up button and enter credentials. The benefit of creating an account is that you can access your order history and query orders with order number.</div>
                    </div>
                </div>
                <div class="topic-box" id="shipping-box">
                    <h3><a href="#" onclick="toggleTopic('shipping')">Shipping & Delivery</a></h3>
                    <p>4 articles in this topic</p>
                    <ul>
                        <li><a href="#" onclick="toggleContent('shipping-countries')">Do you ship to my country?</a></li>
                        <li><a href="#" onclick="toggleContent('shipping-tax')">Tax & Import Duty</a></li>
                        <li><a href="#" onclick="toggleContent('shipping-delivery')">Who will deliver my item?</a></li>
                        <li><a href="#" onclick="toggleContent('shipping-price')">Why does the price vary for the same product type?</a></li>
                    </ul>
                    <div id="shipping" class="hidden topic-content">
                        <p>Questions regarding shipping and delivery of your sneaker.</p>
                        <div id="shipping-countries" class="hidden">We ship to multiple countries worldwide.</div>
                        <div id="shipping-tax" class="hidden">Tax and import duties depend on your location.</div>
                        <div id="shipping-delivery" class="hidden">We partner with reliable courier services such as Evri and DPD to ensure timely delivery of your items.</div>
                        <div id="shipping-price" class="hidden">Prices may vary based on shipping location and mainly on the brand of the sneaker.</div>
                    </div>
                </div>
                <div class="topic-box" id="returns-box">
                    <h3><a href="#" onclick="toggleTopic('returns')">Returns</a></h3>
                    <p>3 articles in this topic</p>
                    <ul>
                        <li><a href="#" onclick="toggleContent('returns-charges')">Do you charge for returns?</a></li>
                        <li><a href="#" onclick="toggleContent('returns-processing')">How long do orders take to be processed?</a></li>
                        <li><a href="#" onclick="toggleContent('returns-policy')">What’s the return policy for online purchases?</a></li>
                    </ul>
                    <div id="returns" class="hidden topic-content">
                        <p>Learn more about our return policy here!</p>
                        <div id="returns-charges" class="hidden">We offer free returns within 14 days.</div>
                        <div id="returns-processing" class="hidden">Orders are typically processed within 24 hours.</div>
                        <div id="returns-policy" class="hidden">Our return policy allows returns within 14 days for online purchases. The sneaker must be in the same condition with original packaging.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us">
        <div class="container">
            <h3>Contact Us</h3>
            <p>Not finding what you're looking for? <a href="/contact" class="contact-link">Contact Us Directly</a></p>
        </div>
    </section>

    @include("footer")

    <script>
        function toggleTopic(topicId) {
            document.querySelectorAll('.topic-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(topicId).classList.toggle('hidden');
        }
        function toggleContent(contentId) {
            let content = document.getElementById(contentId);
            content.classList.toggle('hidden'); // Toggle visibility without hiding others
        }

    </script>
</body>
</html>
