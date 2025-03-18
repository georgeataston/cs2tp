<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Crep Culture</title>
    <!-- Link to CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userreturns.css') }}">
    <link rel="stylesheet" href="{{asset('css/unifiedheaders.css')}}">
</head>
<body>
    @include('header')

    <div class="returns-container">
    <h2>Return Your Order</h2>
    <form>
      <label for="order-number">Order Number</label>
      <input type="text" id="order-number" name="order_number" placeholder=" Please enter your order number" required>

      <label for="return-reason">Return Reason</label>
      <select id="return-reason" name="return_reason" required>
        <option value="">Select a reason</option>
        <option value="damaged">Damaged Item</option>
        <option value="wrong_item">Wrong Item Received</option>
        <option value="size_issue">Size/Fit Issue</option>
        <option value="other">Other</option>
      </select>

      <button type="submit" class="return-btn">Submit Return Request</button>
    </form>
  </div>


    @include('footer')
</body>
</html>
