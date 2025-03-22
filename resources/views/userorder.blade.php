<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Crep Culture</title>
    <!-- Link to CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/useraccount.css') }}">
    <link rel="stylesheet" href="{{asset('css/unifiedheaders.css')}}">
    <link rel="stylesheet" href="{{asset('css/userorder.css')}}">
</head>
<body>
    @include('header')

    <!-- Main account section -->
    <section class="unified-header">
        <h1>Order #{{ $order->id }}</h1>
        <p>
            @if($order->status == 0)
                We have received your order and will begin processing shortly.
            @elseif($order->status == 1)
                We are processing your order.
            @elseif($order->status == 2)
                We are preparing to ship your order.
            @elseif($order->status == 3)
                We have dispatched your order. Thank you for shopping with Crep Culture.
            @endif
        </p>
        @if(session('success'))
            <br>
            <p id="form-success">{{ session('success') }}</p>
        @endif
    </section>


    <section>
        @foreach($order->items as $item)
            @php($stock = $item->size->stock)
            <div class="product-display">
                <div class="product-image-section">
                    <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}">
                </div>
                <div class="product-info-section">
                    <h3>{{$stock->category->brand->name}} {{$stock->category->name}}</h3>
                    <p id="name">{{$stock->name}}</p>
                    <p>{{$item->size->size}}</p>
                    <p>£{{$item->price}}</p>
                    <p>Qty: {{$item->quantity}}</p>
                    <br>
                    @if($order->status == 3)
                        <p>Item arrived not as you expected? Please visit our help page for more information!</p>
                        <br>
                        <p>If you're not happy with this item, <a id="white-link" href="/returns">you can start a return here.</a></p>
                    @else
                        <p>Thank you for your order. We are preparing your order.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </section>
    <section class="unified-header">
        <h2>Shipping and Total</h2>
        <br>
        <p>Order Total: £{{$order->total_price}}</p>
        <br>
        <p>Your order will be shipped to:</p>
        <br>
        <p>{{$order->fullName}}</p>
        <p>{{$order->addressLineOne}}</p>
        <p>{{$order->addressLineTwo}}</p>
        <p>{{$order->city}}</p>
        <p>{{$order->postCode}}</p>
        <br>
        <p>Thank you for choosing Crep Culture, we hope to welcome you back soon!</p>
    </section>

    @include('footer')
</body>
</html>

<style>
    #form-error {
        color: red;
    }

    #form-success {
        color: green;
    }

    #white-link {
        color: white;
        text-decoration: underline;
    }

    #white-link:visited {
        color: white;
        text-decoration: underline;
    }

    #white-link:hover {
        color: white;
        text-decoration: wavy underline;
    }
</style>
