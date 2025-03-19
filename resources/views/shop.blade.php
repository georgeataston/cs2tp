<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    @include("header")



    <!-- Product Page Header -->
    <section class="product-header">
        <h1>{{$shopTitle}}</h1>
        <p>Browse our fantastic range of shoes here. Discover new styles on Crep Culture.</p>
        <br>
        <form action="/shop" method="get">
            @csrf
            <input type="text" id="search-bar" placeholder="Search all products..." name="search"/>
        </form>
    </section>


       <section class="sort-by-section">
            <label for="sort-by">Sort by:</label>
            <select id="sort-by">
                <option value="default">Default</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
                <option value="popularity">Popularity</option>
                <option value="new-arrivals">New Arrivals</option>
            </select>
           <div>
                <p>| {{ $stockList->count() }} products found</p>
           </div>
        </section>


    <!-- Main Container -->
    <div class="main-container">
        <!-- Filter Section -->
<aside class="filter-section">
    <h3>Browse by Brand</h3>
    <ul>
        @foreach($brands as $brand)
            <li><a href="/shop/brand/{{$brand->bid}}">{{$brand->name}}</a></li>
        @endforeach
    </ul>

    <h3>Filter by</h3>
    <form id="filter-form">
{{--        <!-- Product Type -->
        <div>
            <h4>Product Type</h4>
            <label><input type="checkbox" name="type" value="jordans"> Air Jordans</label><br>
            <label><input type="checkbox" name="type" value="nike"> Nike</label><br>
            <label><input type="checkbox" name="type" value="yeezy"> Yeezy</label>
        </div>

        <!-- Subcategory -->
        <div>
            <h4>Model</h4>
            <label><input type="checkbox" name="model" value="jordan1"> Jordan 1</label><br>
            <label><input type="checkbox" name="model" value="jordan4"> Jordan 4</label><br>
            <label><input type="checkbox" name="model" value="jordan5"> Jordan 5</label><br>
            <label><input type="checkbox" name="model" value="dunk"> Dunk</label><br>
            <label><input type="checkbox" name="model" value="airmax95"> Air Max 95</label><br>
            <label><input type="checkbox" name="model" value="airmax1"> Air Max 1</label><br>
            <label><input type="checkbox" name="model" value="yeezy350"> Yeezy 350</label><br>
            <label><input type="checkbox" name="model" value="yeezy380"> Yeezy 380</label><br>
            <label><input type="checkbox" name="model" value="yeezy450"> Yeezy 450</label>
        </div>--}}

        <!-- Price -->
        <div>
            <h4>Price</h4>
            <label><input type="checkbox" name="price" value="low"> £0 - £50</label><br>
            <label><input type="checkbox" name="price" value="medium"> £51 - £100</label><br>
            <label><input type="checkbox" name="price" value="high"> £101-250</label><br>
            <label><input type="checkbox" name="price" value="higher"> £251-500 </label>
        </div>

        <!-- Size -->
<div>
    <h4>Size</h4>
    <label for="shoe-size">Select Shoe Size:</label>
    <select id="shoe-size" name="size">
        <option value="">--Select Size--</option>
        <option value="4">UK Size 4</option>
        <option value="5">UK Size 5</option>
        <option value="6">UK Size 6</option>
        <option value="7">UK Size 7</option>
        <option value="8">UK Size 8</option>
        <option value="9">UK Size 9</option>
        <option value="10">UK Size 10</option>
        <option value="11">UK Size 11</option>
        <option value="12">UK Size 12</option>
        <option value="13">UK Size 13</option>
    </select>
</div>



        <button type="submit" class="filter-btn">Apply Filters</button>
    </form>
</aside>

        <section class="product-grid" id="product-grid">
            @if($stockList->isEmpty())
                <p>There are no items listed right now. Please check back later.</p>
            @else
                @foreach($stockList as $stock)
                    <div class="product-wrapper">
                        <a href="/shop/{{$stock->id}}" class="product-item">
                            <div class="product-image-container">
                                <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}" class="product-image">
                            </div>
                            <h3 class="product-brand">{{$stock->category->brand->name}} {{$stock->category->name}}</h3>
                            <h3 class="product-name">{{$stock->name}}</h3>
                            <p class="product-price">£{{$stock->price}}</p>
                        </a>
                    </div>
                @endforeach
            @endif
        </section>
    </div>

    @include("footer")
</body>
</html>
