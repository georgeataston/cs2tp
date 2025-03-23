<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('css/unifiedheaders.css')}}">
</head>
<body>
    @include('header')

    <section class="unified-header">
        <h1>Checkout</h1>
        <p>Complete your purchase</p>
    </section>

    <section class="checkout-content">
        <div class="basket-summary">
            <h3>Basket Summary</h3>
            <ul>
                @foreach($cart as $item)
                    <li>x{{$item['quantity']}} {{$item['name']}} @ £{{$item['price']}}<br>{{$item['size']}}</li>
                @endforeach
            </ul>
            <p class="total">Subtotal: <span>£{{$total}}</span></p>
            <p class="total">Shipping: <span>FREE</span></p>
            <p class="total">Total: <span>£{{$total}}</span></p>
            <br>
            @if(session('id') == null)
                <p><b>You are checking out as a guest. Sign-in to easily save and track your orders!</b></p>
            @else
                <p>Welcome back, {{$user->name}}. Thank you for choosing us again.</p>
            @endif
        </div>

        <div class="checkout-form">
            <h3>Shipping Address</h3>
            <form action="/orders/checkout" method="post">
                @csrf
                @if(session('id') == null)
                    <input type="text" name="fullName" placeholder="Full Name" value="{{old('fullName')}}">
                    @error('fullName')<p id="form-error">{{ $message }}</p>@enderror
                    <input type="text" name="email" placeholder="Email" value="{{old('email')}}">
                    @error('email')<p id="form-error">{{ $message }}</p>@enderror
                @else
                    <input type="text" name="fullName" placeholder="Full Name" value="{{$user->name}}">
                    @error('fullName')<p id="form-error">{{ $message }}</p>@enderror
                    <input type="text" name="email" placeholder="Email" value="{{$user->email}}">
                    @error('email')<p id="form-error">{{ $message }}</p>@enderror
                @endif
                <input type="text" name="addressLineOne" placeholder="Address Line 1" value="{{old('addressLineOne')}}">
                    @error('addressLineOne')<p id="form-error">{{ $message }}</p>@enderror
                <input type="text" name="addressLineTwo" placeholder="Address Line 2" value="{{old('addressLineTwo')}}">
                    @error('addressLineTwo')<p id="form-error">{{ $message }}</p>@enderror
                <input type="text" name="city" placeholder="City" value="{{old('city')}}">
                    @error('city')<p id="form-error">{{ $message }}</p>@enderror
                <input type="text" name="postCode" placeholder="Postcode" value="{{old('postCode')}}">
                    @error('postCode')<p id="form-error">{{ $message }}</p>@enderror

                <h3>Card Details</h3>
                <input type="text" name="cardNumber" placeholder="Card Number" value="{{old('cardNumber')}}">
                    @error('cardNumber')<p id="form-error">{{ $message }}</p>@enderror
                <input type="text" name="cardName" placeholder="Cardholder Name" value="{{old('cardName')}}">
                    @error('cardName')<p id="form-error">{{ $message }}</p>@enderror
                <div class="card-details">
                    <input type="text" name="cardExpiry" placeholder="Expiry Date">
                    @error('cardExpiry')<p id="form-error">{{ $message }}</p>@enderror
                    <input type="text" name="cardCVV" placeholder="CVV">
                    @error('cardCVV')<p id="form-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="checkout-btn">Complete Purchase</button>
            </form>
        </div>
    </section>

    @include('footer')
</body>
</html>

<style>
    #form-error {
        color: red;
    }
</style>
