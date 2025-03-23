<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <script>
        window.addEventListener("DOMContentLoaded", function() {
            document.getElementById("sort-by").addEventListener("change", function() {
                const selectedValue = this.value;
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set("sort", selectedValue);
                window.location.search = urlParams.toString();
            });

            const minOut = document.querySelector("#min-value");
            const minIn = document.querySelector("#min");
            minOut.textContent = minIn.value;
            minIn.addEventListener("input", (event) => {
                minOut.textContent = event.target.value;
            });

            const maxOut = document.querySelector("#max-value");
            const maxIn = document.querySelector("#max");
            maxOut.textContent = maxIn.value;
            maxIn.addEventListener("input", (event) => {
                maxOut.textContent = event.target.value;
            });

        }, false);
    </script>
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
                <option value="default" {{ $sortBy == 'default' ? "selected" : "" }}>Default</option>
                <option value="price-asc" {{ $sortBy == 'price-asc' ? "selected" : "" }}>Price: Low to High</option>
                <option value="price-desc" {{ $sortBy == 'price-desc' ? "selected" : "" }}>Price: High to Low</option>
                <option value="new-arrivals" {{ $sortBy == 'new-arrivals' ? "selected" : "" }}>New Arrivals</option>
            </select>
           <div>
                <p>| {{ $stockList->count() }} product{{ $stockList->count() != 1 ? "s" : "" }} found</p>
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
    <form id="filter-form" action="{{ $submitToBrand ? "/shop/brand/$brandId" : "/shop" }}">
        <!-- Price -->
        <div>
            <h4>Price</h4>
            <label for="min">Minimum: £<output id="min-value"></output></label>
            <input name="min" id="min" type="range" min="0" max="{{ $mostExpensive }}" step="10" value="{{ $minQuery ? $minQuery : 0 }}" />

            <label for="max">Maximum: £<output id="max-value"></output></label>
            <input name="max" id="max" type="range" min="0" max="{{ $mostExpensive }}" step="10" value="{{ $maxQuery ? $maxQuery : $mostExpensive }}" />
        </div>

        <!-- Size -->
        <div>
            <h4>Size</h4>
            <select id="shoe-size" name="size">
                <option value="">No Preference</option>
                @foreach($sizes as $size)
                    <option {{ $sizeQuery ? $size == $sizeQuery ? "selected" : "" : "" }}>{{ $size }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="filter-btn">Apply Filters</button>
    </form>
</aside>

        <section class="product-grid" id="product-grid">
            @if($stockList->isEmpty())
                <p>There are no items listed right now. Please check back later or edit your search parameters.</p>
            @else
                @foreach($stockList as $stock)
                    <div class="product-wrapper">
                        <a href="/shop/{{$stock->id}}" class="product-item">
                            <div class="product-image-container">
                                <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}" class="product-image">
                                @if($stock->curatedOutfit != null)
                                    <div class="curated-badge">CURATED OUTFIT</div>
                                @endif
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

<style>
    .product-image-container {
        position: relative;
        display: inline-block;
    }

    .curated-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #ffa500;
        color: white;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }
</style>
