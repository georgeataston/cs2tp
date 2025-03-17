<!DOCTYPE html><!--Using HTML-->
<html lang="en"><!--English as the language-->
<head>
    <meta charset="UTF-8"><!--Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>418 - Crep Culture</title><!--Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to stylesheet for CSS-->
</head>
<body>
<!-- Header Section -->
@include("header")

<!--About us section-->
<section class="about">
    <div class="about-content"><!-- Id for styling-->
        <h2>Error 418</h2><!--Heading-->
        <p>You're attempting to talk to a tea pot. Considering tea pots can only pour tea, it probably can't do what you want it to do. Therefore: stop.</p>
    </div>
</section>

@include("footer")
</body>
</html>
