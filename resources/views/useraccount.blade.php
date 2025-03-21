<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Crep Culture</title>
    <!-- Link to CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/useraccount.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{asset('css/unifiedheaders.css')}}">
</head>
<body>
    @include('header')

    <!-- Main account section -->
    <section class="unified-header">
        <h1>My Account</h1>
        <p>Welcome back, {{$name}}! View your order history and manage your account details.</p>
        @if(session('success'))
            <br>
            <p id="form-success">{{ session('success') }}</p>
        @endif
    </section>

    <!-- Order history section -->
    <section class="featured-products">
        <h2>Order History</h2>
        <div class="products">

            <!-- Table displaying order details -->
            <table>
                <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{$order->id}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @if($order->status == 0)
                                Order Submitted
                            @elseif($order->status == 1)
                                Order Processing
                            @elseif($order->status == 2)
                                Awaiting Dispatch
                            @elseif($order->status == 3)
                                Complete / Dispatched
                            @endif
                        </td>
                        <td>£{{$order->total_price}}</td>
                        <td><a id="white-link" href="/account/order/{{ $order->id }}">View Order</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- New 'Start a Return' button -->
        <button class="return-btn" onclick="window.location.href = '/returns'">Start a Return</button>
        </div>
    </section>

    <!-- Account details form -->
    <section class="account-details">
        <h2 id="orange">Account Details</h2><br>
        <h2>Update Personal Details</h2><br>
        <form class="update-form" action="/account/update/details" method="post">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $fullName }}">
            @error('name')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{ old('email') ? old('email') : $email }}">
            @error('email')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <label for="password">Current Password:</label>
            <input type="password" id="password" name="password">
            @error('password')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <button type="submit" class="update-btn">Update Details</button>
            @error('submit')<p id="form-error">{{ $message }}</p><br><br>@enderror
        </form>

        <br><br>
        <h2>Update Password</h2><br>
        <form class="update-form" action="/account/update/password" method="post">
            @csrf
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword">
            @error('currentPassword')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">
            @error('newPassword')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <label for="repeatPassword">Repeat Password:</label>
            <input type="password" id="repeatPassword" name="repeatPassword">
            @error('repeatPassword')<p id="form-error">{{ $message }}</p><br><br>@enderror

            <button type="submit" class="update-btn">Update Password</button><br>
            @error('pwSubmit')<p id="form-error">{{ $message }}</p><br><br>@enderror
        </form>
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
