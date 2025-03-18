<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Crep Culture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include("header")

    <section class="help">
        <div class="container">
            <h2>Do you ship to my country?</h2>
            <p>We ship to multiple countries worldwide.</p>
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
