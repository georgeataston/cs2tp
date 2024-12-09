<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket - Crep Culture</title>

    <!-- Link to CSS files -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basket.css') }}">
    <link rel="stylesheet" href="{{asset('css/unifiedheaders.css')}}">
</head>
<body>
    @include('header')
    @if(session('cart') == null)
        <section class="unified-header">
            <h1>Your Basket is Empty!</h1>
            <p>Come back once you have browsed our amazing selection!</p>
        </section>
    @else
        <!-- Main Basket section -->
        <section class="unified-header">
            <h1>Your Basket</h1>
            <p>Review and manage your selected items</p>
        </section>
        <!-- Contents of the basket displayed here -->
        <section class="basket-content">
            <table class="basket-table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>

                <!-- insert backend basket content data here -->
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->category->brand->name}} {{$item->category->name}} {{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>1</td>
                        <td>£{{$item->price}}</td>
                        <td>
                            <form action="/basket/remove" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}" />
                                <button class="remove-btn">Remove</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>

                <!-- Basket summary goes below -->
            </table>
            <div class="basket-summary">
                <h3>Basket Summary</h3>
                <!-- insert real data beloww -->
                <p>Subtotal: £{{$total}}</p>
                <p>Shipping: FREE</p>
                <p>Total: £{{$total}}</p>
                <a href="/basket/checkout"><button class="checkout-btn">Proceed to Checkout</button></a>
            </div>
        </section>
    @endif

    @include('footer')
</body>
</html>
