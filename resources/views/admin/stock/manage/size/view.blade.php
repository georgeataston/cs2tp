<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Size #{{ $size->id }} | Crep Culture</title>
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
        <h2 class="text-center mb-4">Size #{{ $size->id }}: {{ $size->size }} ({{ $size->stock->category->brand->name . ' ' . $size->stock->category->name }} {{ $size->stock->name }})</h2>
        @if(session('success'))
            <p class="text-center text-success">{{ session('success') }}</p>
        @endif
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Size ID</th>
                <th>Size</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $size->id }}</td>
                <td>{{ $size->size }}</td>
                <td>{{ $size->quantity }}</td>
            </tr>
            </tbody>
        </table>
        <h3 class="mb-4">Update Quantity</h3>
        <form method="post" action="/admin/stock/api/manage/size/update">
            @csrf
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter product name" value="{{ old('quantity') ? old('quantity') : $size->quantity }}">
                @error('quantity')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <input hidden type="number" name="size_id" value="{{$size->id}}"/>
            <button type="submit" class="btn btn-primary">Update Quantity</button>
            @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
        </form>

        <br>
        <h3 class="mb-4">Other Actions</h3>
        <button class="btn btn-secondary" onclick="location.href = '/admin/stock/manage/' + {{ $size->stock->id }}">Back</button>
    </div>

</body>
