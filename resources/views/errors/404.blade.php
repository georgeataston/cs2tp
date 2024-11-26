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
        <h2>Error 404</h2><!--Heading-->
        <p>The page you were looking for could not be found. Please check your URL or contact us.</p>
    </div>
</section>

<footer>
    <p>&copy; 2024 Crep Culture | <a href="index.html#privacy">Privacy Policy</a> | <a href="index.html#terms">Terms of Service</a></p> <!-- Footer at the bottom of the page-->
</footer>
</body>
</html>
