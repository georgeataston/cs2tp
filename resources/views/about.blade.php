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
            <p>Welcome to Crep Culture, the ultimate destination for sneaker enthusiasts and luxury footwear lovers. Founded in 2023, Crep Culture was born out of a passion for high-quality kicks that make a statement.</p>
            <p>Our mission is simple: to bring the latest in luxury sneakers to a community that appreciates style, comfort, and quality. We curate a collection from the world’s leading brands, offering something for everyone who values exceptional footwear.</p>
            <p>Join us on our journey as we step into the future of sneaker culture!</p> <!-- About us message to give the customers some back story-->
        </div>
    </section>

    @include("footer")
</body>
</html>
