
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$stock->category->name}} {{$stock->name}} - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/productdisplay.css')}}">
</head>
<body>
    @include("header")
    <main class="product-display">
        <div class="product-image-section">
            <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}">
        </div>
        <div class="product-info-section">
            <h1>{{$stock->category->name}}</h1>
            <h2>{{$stock->name}}</h2>
            <p class="price">£{{$stock->price}}</p>
            <form class="product-options">
                <label for="size">Size</label>
                <select id="size" name="size">
                    <option>Select</option>
                    <option>UK 4</option>
                    <option>UK 5</option>
                    <option>UK 6</option>
                    <option>UK 7</option>
                    <option>UK 8</option>
                    <option>UK 9</option>
                    <option>UK 10</option>
                    <option>UK 11</option>
                    <option>UK 12</option>
                    <option>UK 13</option>
                </select>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
            <p class="description">{{$stock->description}}</p>
        </div>
    </main>
    @include('footer')
</body>
</html>
