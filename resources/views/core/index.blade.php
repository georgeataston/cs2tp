<!DOCTYPE html> <!-- Using HTML-->
<html lang="en"><!-- Selecting English as the language-->
<head>
    <meta charset="UTF-8"> <!-- Choosing characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crep Culture - Luxury Sneakers</title> <!-- Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to the CSS for styling the pages-->
</head>
<body>
    @include("header")

    <section class="hero">
        <div class="hero-content">
            <h2>Crep Culture</h2> <!-- Displays a slogan on the page-->
            <p>Explore the finest sneakers curated just for you. Elevate your style with Crep Culture.</p><!-- A sentence displayed along with the slogan-->
            <a href="/shop" class="cta">Shop Now</a> <!-- Labelled as shop in order to make the css for the section-->
        </div>
    </section>

    <!-- Featured product section at the bottom-->

    <section class="featured-products" id="shop">
        <h2>Featured Products</h2> <!-- Heading for the section-->
        <div class="products"><!-- Putting some products under the products class to have them displayed as featured products on the home page along with CSS styling.-->
            @foreach($features as $feature)
                <a href="/shop/{{$feature->id}}" class="product">
                    <img src="{{$feature->images->first()->image_path}}" alt="{{$feature->category->name}} {{$feature->name}}"> <!-- Linking picture to product under the class to have it displayed on the home page-->
                    <h3>{{$feature->category->brand->name}} {{$feature->category->name}}</h3> <!-- Name of the product-->
                    <span class="price">£{{$feature->price}}</span> <!-- Price of the product-->
                </a>
            @endforeach
        </div>
    </section>

    @include("footer")
</body>
</html>
