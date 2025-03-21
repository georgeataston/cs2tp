<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return #{{ $return->id }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Return #{{ $return->id }}</h2>
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Return/Order ID</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Request Date</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#{{ $return->id }} / #{{ $return->order->id }}</td>
                    <td>{{ $return->order->fullName }}</td>
                    <td>{{ $return->statusText() }}</td>
                    <td>{{ $return->created_at }}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <h3 class="mb-4">Items</h3>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Amount Paid</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($return->items as $item)
                    <td>{{ $item->orderItem->stock()->category->brand->name }} {{ $item->orderItem->stock()->name }}<br>Stock ID: {{ $item->orderItem->stock()->id }} / Order Item ID: {{ $item->orderItem->id }}</td>
                    <td>{{ $item->orderItem->size->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->orderItem->price }}</td>
                    <td>{{ $item->statusText() }}</td>
                    <td>
                    </td>
                @endforeach
            </tbody>
        </table>

        <br>
        <h3 class="mb-4">Return Reason</h3>
        <div class="card">
            <div class="card-body bg-dark">
                {{ $return->reason }}
            </div>
        </div>

        <br>
        <h3 class="mb-4">Actions</h3>
        <button class="btn btn-secondary" onclick="location.href = '/admin/returns'">Back</button>
    </div>

</body>
