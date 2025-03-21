<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns Manager | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

</head>
<body>
@include('admin.header')

<!-- Page Content -->
<div class="container page-container">
    <h2 class="text-center mb-4">Returns Manager</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Return/Order ID</th>
                    <th>Customer Name</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($returns as $ret)
                        <tr>
                            <td>#{{ $ret->id }} / #{{ $ret->order->id }}</td>
                            <td>{{ $ret->order->fullName }}</td>
                            <td>
                                @foreach($ret->items as $item)
                                    {{ $item->orderItem->stock()->category->brand->name }} {{ $item->orderItem->stock()->name }}
                                    ({{ $item->orderItem->size->size }}) (Qty: {{ $item->orderItem->quantity }})<br>
                                @endforeach
                            </td>
                            <td>{{ $ret->status }}</td>
                            <td>{{ $ret->created_at }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/returns/{{$ret->id}}'">View Details</button>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/orders/{{$ret->order_id}}'">View Order</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($returns->count() == 0)
                <p class="text-center">There are no returns to manage.</p>
            @endif
            <button class="btn btn-secondary" onclick="location.href = '/admin'">Back</button>
            <br><br>
        </div>
    </div>
</div>
