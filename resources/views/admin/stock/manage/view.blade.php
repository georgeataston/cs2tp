<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock #{{ $stock->id }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

    <script>
        function showSizeForm() {
            document.getElementById("createSizeButton").style.display = "none";
            document.getElementById("sizeCreator").style.display = "block";
        }

        function hideSizeForm() {
            document.getElementById("createSizeButton").style.display = "block";
            document.getElementById("sizeCreator").style.display = "none";
        }
    </script>

</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Stock #{{ $stock->id }}: ({{ $stock->category->brand->name . ' ' . $stock->category->name }}) {{ $stock->name }}</h2>
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Stock ID</th>
                <th>Parent Brand</th>
                <th>Parent Category</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->category->brand->name }}</td>
                <td>{{ $stock->category->name }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->quantity }}</td>
            </tr>
            </tbody>
        </table>
        <h3 class="mb-4">Update Details</h3>
        <form method="post" action="/admin/stock/api/manage/update">
            @csrf
            <div class="form-group">
                <label for="category">Parent Category</label>
                <select class="form-control" id="category">
                    @foreach($categories as $category)
                        <option {{ $stock->category->cid == $category->cid ? "selected" : "" }} value="{{ $category->cid }}">{{ $category->name }} ({{ $category->brand->name }})</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">The product will inherit the brand of the selected category.</small>
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter product name" value="{{ old('name') ? old('name') : $stock->name }}">
            </div>
            <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>

        <br>
        <h3 class="mb-4">Size Management</h3>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-striped table-bordered" id="ordersTable">
                    <thead class="thead-dark">
                    <tr>
                        <th>Size ID</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sizes as $size)
                        <tr>
                            <td>{{ $size->id }}</td>
                            <td>{{ $size->size }}</td>
                            <td>{{ $size->quantity }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/stock/manage/size/{{$size->id}}'">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($sizes->count() == 0)
                    <p class="text-center">There are no sizes to manage.</p>
                @endif
                <button class="btn btn-primary" id="createSizeButton" onclick="showSizeForm()">Create Size</button>
                <div id="sizeCreator" style="display: none">
                    <h3 class="mb-2">Create Size</h3>
                    <form method="post" action="/admin/stock/api/manage/size/create">
                        @csrf
                        <div class="form-group">
                            <label for="size">Size Display Name</label>
                            <input type="text" class="form-control" id="size" placeholder="UK 9" value="{{ old('size') ? old('size') : "" }}">
                        </div>
                        <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="hideSizeForm()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <h3 class="mb-4">Image Management</h3>

        <h3 class="mb-4">Other Actions</h3>
        <button class="btn btn-secondary" onclick="location.href = '/admin/stock/manage'">Back</button>
    </div>

</body>
