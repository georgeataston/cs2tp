<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Manager | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

    <script>
        function showBrandForm() {
            document.getElementById("createBrandButton").style.display = "none";
            document.getElementById("brandCreator").style.display = "block";
        }

        function hideBrandForm() {
            document.getElementById("createBrandButton").style.display = "block";
            document.getElementById("brandCreator").style.display = "none";
        }
    </script>
</head>
<body>
@include('admin.header')

<!-- Page Content -->
<div class="container page-container">
    <h2 class="text-center mb-4">Brand Manager</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Brand ID</th>
                    <th>Brand Name</th>
                    <th>Total Categories</th>
                    <th>Total Products</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->bid }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->categoryCount() }}</td>
                            <td>{{ $brand->stockCount() }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/stock/brands/{{$brand->bid}}'">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="location.href = '/admin/stock/brands/{{$brand->bid}}/delete'">Archive</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($brands->count() == 0)
                <p class="text-center">There are no brands to manage.</p>
            @endif
            <button class="btn btn-primary" id="createBrandButton" onclick="showBrandForm()">Create Brand</button>
            <div id="brandCreator" style="display: none">
                <h3 class="mb-2">Create Brand</h3>
                <form method="post" action="/admin/stock/api/brands/create">
                    @csrf
                    <div class="form-group">
                        <label for="name">Brand Display Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nike" value="{{ old('name') ? old('name') : "" }}">
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="hideBrandForm()">Cancel</button>
                    @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                </form>
            </div>
        </div>
    </div>
</div>
