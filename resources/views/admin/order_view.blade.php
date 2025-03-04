<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Order #{{ $order->id }}</h2>
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Order ID</th>
                <th>Order Created</th>
                <th>Order Status</th>
                <th>Total Amount</th>
                <th>Customer Details</th>
                <th>Shipping Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                @if($order->status == 0)
                    <td>New</td>
                @elseif($order->status == 1)
                    <td>Partially Picked</td>
                @elseif($order->status == 2)
                    <td>Ready to Ship</td>
                @elseif($order->status == 3)
                    <td>Complete</td>
                @else
                    <td>Unknown - ID {{$order->status}}</td>
                @endif
                <td>£{{ $order->total_price }}</td>
                <td>{{ $order->fullName }}<br>{{ $order->email }}</td>
                <td>
                    {{ $order->addressLineOne }}<br>
                    {{ $order->addressLineTwo }}<br>
                    {{ $order->city }}<br>
                    {{ $order->postCode }}
                </td>
            </tr>
            </tbody>
        </table>
        <h3 class="mb-4">Items</h3>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Amount Paid</th>
                <th>Picked Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->stock->category->brand->name }} {{ $item->stock->name }}<br>ID: {{ $item->stock->id }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    @if($order->status < 3)
                        @if($item->status == 0)
                            <td>Unpicked</td>
                            <td>
                                <form method="post" action="/admin/orders/api/pick">
                                    @csrf
                                    <input hidden type="number" name="order_id" value="{{$order->id}}"/>
                                    <input hidden type="number" name="order_item_id" value="{{$item->id}}"/>
                                    <button class="btn btn-success btn-sm">Mark as Picked</button>
                                </form>
                            </td>
                        @elseif($item->status == 1)
                            <td>Picked</td>
                            <form method="post" action="/admin/orders/api/unpick">
                                @csrf
                                <input hidden type="number" name="order_id" value="{{$order->id}}"/>
                                <input hidden type="number" name="order_item_id" value="{{$item->id}}"/>
                                <td><button class="btn btn-danger btn-sm">Mark as Unpicked</button></td>
                            </form>
                        @else
                            <td>Unknown - ID {{ $item->status }}</td>
                            <td>
                                <form method="post" action="/admin/orders/api/pick">
                                    @csrf
                                    <input hidden type="number" name="order_id" value="{{$order->id}}"/>
                                    <input hidden type="number" name="order_item_id" value="{{$item->id}}"/>
                                    <button class="btn btn-success btn-sm">Mark as Picked</button>
                                </form>
                                <form method="post" action="/admin/orders/api/unpick">
                                    @csrf
                                    <input hidden type="number" name="order_id" value="{{$order->id}}"/>
                                    <input hidden type="number" name="order_item_id" value="{{$item->id}}"/>
                                    <td><button class="btn btn-danger btn-sm">Mark as Unpicked</button></td>
                                </form>
                            </td>
                        @endif
                    @else
                        @if($item->status == 0)
                            <td>Unpicked</td>
                            <td></td>
                        @elseif($item->status == 1)
                            <td>Picked</td>
                            <td></td>
                        @else
                            <td>Unknown - ID {{ $item->status }}</td>
                            <td></td>
                        @endif
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <h3 class="mb-4">Actions</h3>
        @if ($canShip)
            <form method="post" action="/admin/orders/api/complete">
                @csrf
                <input hidden type="number" name="order_id" value="{{$order->id}}"/>
                <button class="btn btn-success btn-sm">Mark as Shipped</button>
            </form>
        @endif
        <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/orders'">Back</button>
    </div>

</body>
