<!DOCTYPE html><!--Using HTML-->
<html lang="en"><!--English as the language-->
<head>
    <meta charset="UTF-8"><!--Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Crep Culture</title><!--Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to stylesheet for CSS-->
</head>
<body>
<!-- Header Section -->
@include("header")

<!--About us section-->
<section class="about">
    <div class="about-content"><!-- Id for styling-->
        <h2>Error 500</h2><!--Heading-->
        <p>We're sorry, an error has occurred on our end. Please try again in a few minutes or contact us.</p>
    </div>
</section>

@include("footer")
</body>
</html>
