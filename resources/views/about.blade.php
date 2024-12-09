<!DOCTYPE html><!--Using HTML-->
<html lang="en"><!--English as the language-->
<head>
    <meta charset="UTF-8"><!--Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Crep Culture</title><!--Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to stylesheet for CSS-->
</head>
<body>
    <!-- Header Section -->
    @include("header")

    <!--About us section-->
    <section class="about">
        <div class="about-content"><!-- Id for styling-->
            <h2>Our Story</h2><!--Heading-->
            <p>Welcome to Crep Culture, the greatest destination for sneakerheads and luxury shoe collectors. Crep Culture, which was founded in 2023, was inspired by a desire to make a statement with high-quality kicks.</p>
            <p>Our objective is straightforward: to deliver the latest premium sneakers to a community that values style, comfort, and quality. We curate a variety of the world's top brands, so there's something for everyone who values high-quality footwear.</p>
            <p>Join us on a journey as we explore the future of sneaker culture.</p> <!-- About us message to give the customers some back story-->
    </section>

    @include("footer")
</body>
</html>
