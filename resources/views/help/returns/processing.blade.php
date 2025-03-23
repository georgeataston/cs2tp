<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing - Crep Culture</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include("header")

    <section class="help">
        <div class="container">
            <h2>How do I request a refund or check its status?</h2>
            <p><a id="white-link" href="/returns">Please visit the returns centre here.</a></p>
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

<style>
    #form-error {
        color: red;
    }

    #form-success {
        color: green;
    }

    #white-link {
        color: white;
        text-decoration: underline;
    }

    #white-link:visited {
        color: white;
        text-decoration: underline;
    }

    #white-link:hover {
        color: white;
        text-decoration: wavy underline;
    }
</style>
