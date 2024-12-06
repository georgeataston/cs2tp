<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket - Crep Culture</title>

    <!-- Link to CSS files -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/useraccount.css') }}">
</head>
<body>
    @include('header'
)
    <!-- Main Basket section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Your Basket</h2>
            <p>Review and manage your selected items</p>
        </div>
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
                <tr>
                    <td>Filler</td>
                    <td>£99.99</td>
                    <td>
                        <input type="number" value="1" min="1" max="10">
                    </td>
                    <td>£99.99</td>
                    <td><button class="remove-btn">Remove</button></td>
                </tr>
                <tr>
                    <td>FILLER</td>
                    <td>£299.99</td>
                    <td>
                        <input type="number" value="1" min="1" max="10">
                    </td>
                    <td>£299.99</td>
                    <td><button class="remove-btn">Remove</button></td>
                </tr>
            </tbody>

            <!-- Basket summary goes below -->
        </table>
        <div class="basket-summary">
            <h3>Basket Summary</h3>
            <!-- insert real data beloww -->
            <p>Subtotal: £279.98</p>
            <p>Shipping: £5.00</p>
            <p>Total: £284.98</p>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </section>

    @include('footer')
</body>
</html>
