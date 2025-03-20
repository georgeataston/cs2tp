<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account #{{ $account->aid }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Account #{{ $account->aid }}: {{ $account->name }}</h2>
        @if(session('success'))
            <p class="text-center text-success">{{ session('success') }}</p>
        @endif
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Account ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Account Created</th>
                <th>Is Admin?</th>
                <th>No. Orders Placed</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>#{{ $account->aid }}</td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->email }}</td>
                <td>{{ $account->created_at }}</td>
                <td>{{ $account->isAdmin == 1 ? "Yes" : "No" }}</td>
                <td>{{ $account->orderCount() }}</td>
            </tr>
            </tbody>
        </table>

        <h3 class="mb-3">Orders</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Products</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->fullName }}</td>

                    <td>
                        @foreach($order->items as $item)
                            {{ $item->stock()->category->brand->name }} {{ $item->stock()->name }}
                            ({{ $item->size->size }}) (Qty: {{ $item->quantity }})<br>
                        @endforeach
                        <br>
                        Total: £{{ $order->total_price }}
                    </td>

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
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <button class="btn btn-secondary btn-sm"
                                onclick="location.href = '/admin/orders/{{$order->id}}'">View Details
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if ($orders->count() == 0)
            <p class="text-center">This user has not placed any orders.</p>
        @endif

        <h3 class="mb-4">Update Details</h3>
        <form method="post" action="/admin/accounts/api/update">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter customer's name" value="{{ old('name') ? old('name') : $account->name }}">
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror

                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter customer's email" value="{{ old('email') ? old('email') : $account->email }}">
                @error('email')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <input hidden type="number" name="account_id" value="{{$account->aid}}"/>
            <button type="submit" class="btn btn-primary">Update Details</button>
            @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
        </form>

        <br>
        <h3 class="mb-4">Other Actions</h3>
        <!--<button class="btn btn-danger" onclick="location.href = '/admin/stock/brands//delete'">Archive</button>-->
        <form action="/admin/accounts/api/passwordreset" method="post">
            @csrf
            <input hidden type="number" name="account_id" value="{{$account->aid}}"/>
            <button type="submit" class="btn btn-danger">Reset Password</button>
            <button type="button" class="btn btn-secondary" onclick="location.href = '/admin/accounts'">Back</button>
            @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
        </form>
        <br><br>
    </div>

</body>
