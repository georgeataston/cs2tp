<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive #{{ $brand->bid }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4 text-danger">Archiving Brand #{{ $brand->bid }}: {{ $brand->name }}</h2>
        <p class="text-center">Please review the below brand, categories and stock to be archived.</p>
        <h3 class="mb-3">Brand to Archive</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Brand ID</th>
                <th>Brand Name</th>
                <th>Total Categories</th>
                <th>Total Products</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $brand->bid }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->categoryCount() }}</td>
                <td>{{ $brand->stockCount() }}</td>
            </tr>
            </tbody>
        </table>

        <h3 class="mb-3">Categories to Archive</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Category ID</th>
                <th>Parent Brand</th>
                <th>Category Name</th>
                <th>Total Products</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                @if($category->deleted == 1)
                    @continue
                @endif
                <tr>
                    <td>{{ $category->cid }}</td>
                    <td>{{ $category->brand->name }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->stockCount() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3 class="mb-3">Stock to Archive</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Stock ID</th>
                <th>Parent Brand</th>
                <th>Parent Category</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                @if($category->deleted == 1)
                    @continue
                @endif
                @foreach($category->items as $stock)
                    @if($stock->deleted == 1)
                        @continue
                    @endif
                    <tr>
                        <td>{{ $stock->id }}</td>
                        <td>{{ $stock->category->brand->name }}</td>
                        <td>{{ $stock->category->name }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>£{{ $stock->price }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>

        <h3 class="mb-4">Please Read and Confirm</h3>
        <p class="text-danger">
            <b>WARNING:</b> You are about to archive an entire brand. This will automatically archive <b>ALL ASSOCIATED CATEGORIES AND PRODUCTS.</b>
            <br><br>
            <b>This cannot be undone.</b>
            <br>
            Are you sure you want to continue?</p>
        <form method="post" action="/admin/stock/api/brands/delete">
            @csrf
            <input hidden type="number" name="brand_id" value="{{$brand->bid}}"/>
            <button type="submit" class="btn btn-danger">Archive 1 brand, {{ $brand->categoryCount() }} categories & {{ $brand->stockCount() }} products</button>
            <button type="button" class="btn btn-secondary" onclick="location.href = '/admin/stock/brands/{{$brand->bid}}'">Cancel</button>
        </form>
        <br><br>
    </div>

</body>
