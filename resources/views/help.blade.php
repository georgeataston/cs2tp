<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Crep Culture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include("header") --

    <section class="help">                                  <!-- this is a quick demo plz dont kill me -->
        <div class="container">
            <h2>Help Center</h2>
            <div class="row">
                <!-- -first Column -->
                <div class="column">
                    <div class="topic-index">
                        <h3><a href="/help/account">Account</a></h3>
                        <p>1 article in this topic</p>
                        <ul>
                            <li><a href="/help/account/create">How do I create an account and what are the benefits?</a></li>
                        </ul>
                    </div>
                    <div class="topic-index">
                        <h3><a href="/help/shipping">Shipping & Delivery</a></h3>
                        <p>5 articles in this topic</p>
                        <ul>
                            <li><a href="/help/shipping/countries">Do you ship to my country?</a></li>
                            <li><a href="/help/shipping/tax">Tax & Import Duty</a></li>
                            <li><a href="/help/shipping/options">What are your shipping options?</a></li>
                            <li><a href="/help/shipping/delivery">Who will deliver my item?</a></li>
                            <li><a href="/help/shipping/pricing">Why does your pricing vary?</a></li>
                        </ul>
                    </div>
                    <div class="topic-index">
                        <h3><a href="/help/returns">Returns</a></h3>
                        <p>5 articles in this topic</p>
                        <ul>
                            <li><a href="/help/returns/charges">Do you charge for returns?</a></li>
                            <li><a href="/help/returns/processing">How long will my return take?</a></li>
                            <li><a href="/help/returns/tagging">Tagging policy for online orders</a></li>
                            <li><a href="/help/returns/online">Return policy for online purchases</a></li>
                        </ul>
                    </div>
                </div>

                <!-- second Column base -->
                <div class="column">
                    <div class="topic-index">
                        <h3><a href="/help/gift-cards">Gift Cards</a></h3>
                        <p>1 article in this topic</p>
                        <ul>
                            <li><a href="/help/gift-cards/redeem">How long do I have to redeem my gift card?</a></li>
                        </ul>
                    </div>
                    <div class="topic-index">
                        <h3><a href="/help/click-and-collect">Click and Collect</a></h3>
                        <p>1 article in this topic</p>
                        <ul>
                            <li><a href="/help/click-and-collect/store">Can I collect my order from your store?</a></li>
                        </ul>
                    </div>
                    <div class="topic-index">
                        <h3><a href="/help/size-and-fit">Size and Fit</a></h3>
                        <p>1 article in this topic</p>
                        <ul>
                            <li><a href="/help/size-and-fit/nike">Is this page legit?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("footer")
</body>
</html>
