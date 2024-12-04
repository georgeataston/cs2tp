<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Crep Culture</title>
    <!-- Link to CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/useraccount.css') }}">
</head>
<body>
    @include('header')

    <!-- Main account section -->
    <section class="hero">
        <div class="hero-content">
            <h2>My Account</h2>
            <p>Welcome back, {{$name}}! View your order history and manage your account details.</p>
        </div>
    </section>

    <!-- Account details form -->
    <section class="account-details">
        <h2>Update Account Details</h2>
        <form class="update-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="{{$fullName}}">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{$email}}">

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit" class="update-btn">Update Details</button>
        </form>
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
                    </tr>
                </thead>
                <tbody>
                    <!-- Insert data for orders below? -->
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    @include('footer')
</body>
</html>
