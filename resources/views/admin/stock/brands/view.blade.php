<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand #{{ $brand->bid }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Brand #{{ $brand->bid }}: {{ $brand->name }}</h2>
        <h3 class="mb-3">Details</h3>
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
        <h3 class="mb-4">Update Details</h3>
        <form method="post" action="/admin/stock/api/brands/update">
            @csrf
            <div class="form-group">
                <label for="name">Brand Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter brand name" value="{{ old('name') ? old('name') : $brand->name }}">
            </div>
            <input hidden type="number" name="brand_id" value="{{$brand->bid}}"/>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>

        <br>
        <h3 class="mb-4">Other Actions</h3>
        <button class="btn btn-secondary" onclick="location.href = '/admin/stock/brands'">Back</button>
    </div>

</body>
