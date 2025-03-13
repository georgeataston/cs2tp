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
        function showStockForm() {
            document.getElementById("createStockButton").style.display = "none";
            document.getElementById("stockCreator").style.display = "block";
        }

        function hideStockForm() {
            document.getElementById("createStockButton").style.display = "inline-block";
            document.getElementById("stockCreator").style.display = "none";
        }
    </script>
</head>
<body>
@include('admin.header')

<!-- Page Content -->
<div class="container page-container">
    <h2 class="text-center mb-4">Stock & Size Manager</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Stock ID</th>
                    <th>Parent Brand</th>
                    <th>Parent Category</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr class="{{$stock->deleted == 1 ? "text-danger" : ""}}">
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->category->brand->name }}</td>
                            <td>{{ $stock->category->name }}</td>
                            <td>{{ $stock->name }}</td>
                            @if ($stock->deleted == 0)
                                <td>{{ $stock->quantity }}</td>
                                <td>£{{ $stock->price }}</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/stock/manage/{{$stock->id}}'">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="location.href = '/admin/stock/manage/{{$stock->id}}/delete'">Archive</button>
                                </td>
                            @else
                                <td>-</td>
                                <td>-</td>
                                <td>Archived</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($stocks->count() == 0)
                <p class="text-center">There is no stock to manage.</p>
            @endif
            <button class="btn btn-primary" id="createStockButton" onclick="showStockForm()">Create Stock</button>
            <div id="stockCreator" style="display: none">
                <h3 class="mb-2">Create Stock</h3>
                <form method="post" action="/admin/stock/api/manage/create">
                    @csrf
                    <div class="form-group">
                        <label for="brand">Parent Category</label>
                        <select class="form-control" id="category" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->cid }}">{{ $category->name }} ({{ $category->brand->name }})</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">The product will inherit the brand of the selected category.</small>
                        @error('category_id')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Stock Display Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Low 'Black White'" value="{{ old('name') ? old('name') : "" }}">
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">£</div>
                            </div>
                            <input type="number" min="0.00" step="0.01" class="form-control" id="price" name="price" placeholder="199.99" value="{{ old('price') ? old('price') : ''}}">
                            @error('price')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Stock Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" placeholder="https://i.postimg.cc/MheiEa242" value="{{ old('image') ? old('image') : "" }}">
                        @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter product description" rows="4">{{ old('description') ? old('description') : ''}}</textarea>
                        <small class="form-text text-muted">Optional field. This can be added later.</small>
                        @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="hideStockForm()">Cancel</button>
                    @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                    <br><br>
                </form>
            </div>
            <button class="btn btn-secondary" onclick="location.href = '/admin/stock/'">Back</button>
            <br><br>
        </div>
    </div>
</div>
