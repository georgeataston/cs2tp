<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processor | Crep Culture</title>
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
    @if($all)
        <h2 class="text-center mb-4">All Orders</h2>
        <p class="text-center">All Crep Culture orders.</p>
    @else
        <h2 class="text-center mb-4">Order Processor</h2>
        <p class="text-center">Manage and action unprocessed orders.</p>
    @endif
    @if(session('success'))
        <p class="text-center" style="color: green">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- Orders Table -->
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
            @if($orders->count() == 0)
                <p class="text-center">There are no orders to process. You are all up-to-date!</p>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function filterOrders() {
        const status = $('#orderStatus').val().toLowerCase();
        const product = $('#searchProduct').val().toLowerCase();

        $('#ordersTable tbody tr').filter(function () {
            const rowStatus = $(this).find('td:eq(3)').text().toLowerCase();
            const rowProduct = $(this).find('td:eq(2)').text().toLowerCase();

            if ((status === 'all' || rowStatus.includes(status)) && rowProduct.includes(product)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
</script>
</body>
</html>
