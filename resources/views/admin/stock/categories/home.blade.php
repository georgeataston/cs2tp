<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Manager | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

    <script>
        function showCategoryForm() {
            document.getElementById("createCategoryButton").style.display = "none";
            document.getElementById("categoryCreator").style.display = "block";
        }

        function hideCategoryForm() {
            document.getElementById("createCategoryButton").style.display = "block";
            document.getElementById("categoryCreator").style.display = "none";
        }
    </script>
</head>
<body>
@include('admin.header')

<!-- Page Content -->
<div class="container page-container">
    <h2 class="text-center mb-4">Category Manager</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Category ID</th>
                    <th>Parent Brand</th>
                    <th>Category Name</th>
                    <th>Total Products</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->cid }}</td>
                            <td>{{ $category->brand->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->stockCount() }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/stock/categories/{{$category->cid}}'">Edit</button>
                                <button class="btn btn-danger btn-sm">Archive</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($category->count() == 0)
                <p class="text-center">There are no categories to manage.</p>
            @endif
            <button class="btn btn-primary" id="createCategoryButton" onclick="showCategoryForm()">Create Category</button>
            <div id="categoryCreator" style="display: none">
                <h3 class="mb-2">Create Category</h3>
                <form method="post" action="/admin/stock/api/categories/create">
                    @csrf
                    <div class="form-group">
                        <label for="brand">Parent Brand</label>
                        <select class="form-control" id="brand" name="brand_id">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->bid }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Category Display Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Dunk" value="{{ old('name') ? old('name') : "" }}">
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="hideCategoryForm()">Cancel</button>
                    @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                </form>
            </div>
        </div>
    </div>
</div>
