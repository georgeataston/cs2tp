<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category #{{ $category->cid }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Category #{{ $category->cid }}: ({{ $category->brand->name }}) {{ $category->name }}</h2>
        <h3 class="mb-3">Details</h3>
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
            <tr>
                <td>{{ $category->cid }}</td>
                <td>{{ $category->brand->name }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->stockCount() }}</td>
            </tr>
            </tbody>
        </table>
        <h3 class="mb-4">Update Details</h3>
        <form method="post" action="/admin/stock/api/categories/update">
            @csrf
            <div class="form-group">
                <label for="brand">Parent Brand</label>
                <select class="form-control" id="brand">
                    @foreach($brands as $brand)
                        <option {{ $category->brand->bid == $brand->bid ? "selected" : "" }} value="{{ $brand->bid }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter brand name" value="{{ old('name') ? old('name') : $category->name }}">
            </div>
            <input hidden type="number" name="category_id" value="{{$category->cid}}"/>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>

        <br>
        <h3 class="mb-4">Other Actions</h3>
        <button class="btn btn-secondary" onclick="location.href = '/admin/stock/categories'">Back</button>
    </div>

</body>
