<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager | Crep Culture</title>
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
    <h2 class="text-center mb-4">Reports Overview</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-3">Sales</h3>
            <p>This report indicates the amount of money earned from sales.</p>
            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Today</th>
                    <th>This Week</th>
                    <th>This Month</th>
                    <th>This Year</th>
                    <th>All Time</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>£{{ $salesToday }}</td>
                            <td>£{{ $salesWeek }}</td>
                            <td>£{{ $salesMonth }}</td>
                            <td>£{{ $salesYear }}</td>
                            <td>£{{ $salesTotal }}</td>
                        </tr>
                </tbody>
            </table>

            <br>
            <h3 class="mb-3">Item Movement</h3>
            <p>This report details how many items have been sold in the specified amounts of time.</p>
            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Today</th>
                    <th>This Week</th>
                    <th>This Month</th>
                    <th>This Year</th>
                    <th>All Time</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $movementToday }}</td>
                        <td>{{ $movementWeek }}</td>
                        <td>{{ $movementMonth }}</td>
                        <td>{{ $movementYear }}</td>
                        <td>{{ $movementTotal }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <h3 class="mb-3">Outstanding Customer Activity</h3>
            <p>This report details how many orders and returns are awaiting to be fulfilled.</p>
            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Orders</th>
                    <th>Returns</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $outstandingOrders }}</td>
                        <td>{{ $outstandingReturns }}</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <h3 class="mb-3">Sizes Out of Stock</h3>
            <p>This report details which items / sizes are out of stock.</p>
            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Parent Brand</th>
                    <th>Parent Category</th>
                    <th>Parent Item</th>
                    <th>Size</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($oosSizes as $size)
                        <tr>
                            <td>{{ $size->stock->category->brand->name }}<br>ID: {{ $size->stock->category->brand->bid }}</td>
                            <td>{{ $size->stock->category->name }}<br>ID: {{ $size->stock->category->cid }}</td>
                            <td>{{ $size->stock->name }}<br>ID: {{ $size->stock->id}}</td>
                            <td>{{ $size->size }}<br>ID: {{ $size->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-secondary" onclick="location.href = '/admin'">Back</button>
            <br><br>
        </div>
    </div>
</div>
