<!DOCTYPE html> <!-- HTML for making pages-->
<html lang="en"><!-- English as the language -->
<head>
    <meta charset="UTF-8"> <!-- Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you! - Crep Culture</title><!--Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to style sheet for UI-->
</head>
<body>
    <!-- Header Section -->
    @include("header")

    <!--Section for the contact form-->
    <section class="contact">
        <div class="contact-content"><!-- Assigns id to use for when styling-->
            @if(session('orderId') == null)
                <h2>Oops! Something went wrong.</h2>
                <p>
                    An error has occurred. You were not charged. Please contact support for further assistance or try placing your order again.
                </p>
            @else
                <h2>Thank you!</h2>
                <p>
                    Your order has been placed successfully! Your order number is <b>#{{session('orderId')}}</b>. A confirmation email has been sent to <b>{{session('email')}}</b>
                    <br><br>
                    If you have any questions regarding your order, please do not hesitate to contact us.
                    <br><br>
                    - Crep Culture Team
                </p>
            @endif
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
</style>
