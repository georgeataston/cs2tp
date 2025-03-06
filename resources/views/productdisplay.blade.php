
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$stock->category->brand->name}} {{$stock->category->name}} {{$stock->name}} - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/productdisplay.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    @include("header")
    <main class="product-display">
        <div class="product-image-section">
            <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}">
        </div>
        <div class="product-info-section">
            <h1>{{$stock->category->brand->name}} {{$stock->category->name}}</h1>
            <h2>{{$stock->name}}</h2>
            <p class="price">£{{$stock->price}}</p>
            @if ($stock->quantity == 0)
                 <div class="alert out-of-stock"> Out of Stock</div>
            @elseif ($stock->quantity > 0 && $stock->quantity < 5)
                 <div class="alert low-stock"> Low in Stock: Only {{ $stock->quantity }} left!</div>
              @endif
            <form class="product-options" action="/basket/add" method="post">
                @csrf
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
                @error('size')<p id="form-error">{{ $message }}</p>@enderror
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <input type="hidden" name="id" value="{{$stock->id}}" />
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                @if (session('success') == "added")
                    <p id="form-success">Item has been added to your basket!</p>
                    <br>
                @endif
            </form>
            <p class="description">{{$stock->description}}</p>
        </div>
    </main>
    @include('footer')
</body>
</html>

<style>
    #form-success {
        color: green;
    }

    #form-error {
        color: red;
    }
</style>
