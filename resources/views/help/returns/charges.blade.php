<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Charges - Crep Culture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include("header")

    <section class="help">
        <div class="container">
            <h2>When will I receive my refund?</h2>
            <p>Refunds are processed within 5 business days after we receive and inspect the returned item. The amount will be credited back to your original payment method.</p>
        </div>
    </section>


    <section class="contact-us">
        <div class="container">
            <h3>Contact Us</h3>
            <p>Not finding what you're looking for? <a href="/contact" class="contact-link">Contact Us Directly</a></p>
        </div>
    </section>

    @include("footer")
</body>
</html>
