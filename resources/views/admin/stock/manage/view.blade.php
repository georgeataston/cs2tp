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

        function archive(id) {
            console.log(id);
            document.getElementById("archiveSize-" + id).style.display = "none";
            document.getElementById("confirmArchiveSize-" + id).style.display = "inline-block";
        }

        function showOutfitForm() {
            document.getElementById("createOutfitButton").style.display = "none";
            document.getElementById("outfitCreator").style.display = "block";
        }

        function hideOutfitForm() {
            document.getElementById("createOutfitButton").style.display = "block";
            document.getElementById("outfitCreator").style.display = "none";
        }

        function updateOutfit() {
            var form = document.getElementById("outfitUpdateForm");
            form.action = "/admin/stock/api/manage/outfit/update";
            return false;
        }

        function deleteOutfit() {
            var form = document.getElementById("outfitUpdateForm");
            form.action = "/admin/stock/api/manage/outfit/delete";
            return true;
        }
    </script>

</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Stock #{{ $stock->id }}: ({{ $stock->category->brand->name . ' ' . $stock->category->name }}) {{ $stock->name }}</h2>
        @if(session('success'))
            <p class="text-center text-success">{{ session('success') }}</p>
        @endif
        <h3 class="mb-3">Details</h3>
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
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->category->brand->name }}</td>
                <td>{{ $stock->category->name }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>£{{ $stock->price }}</td>
            </tr>
            </tbody>
        </table>
        <h3 class="mb-4">Update Details</h3>
        <form method="post" action="/admin/stock/api/manage/update">
            @csrf
            <div class="form-group">
                <label for="category">Parent Category</label>
                <select class="form-control" id="category" name="category_id">
                    @foreach($categories as $category)
                        <option {{ $stock->category->cid == $category->cid ? "selected" : "" }} value="{{ $category->cid }}">{{ $category->name }} ({{ $category->brand->name }})</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">The product will inherit the brand of the selected category.</small>
                @error('category_id')<p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ old('name') ? old('name') : $stock->name }}">
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter product description" rows="4">{{ old('description') ? old('description') : $stock->description }}</textarea>
                @error('description')<p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">£</div>
                    </div>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="price" name="price" placeholder="199.99" value="{{ old('price') ? old('price') : $stock->price }}">
                    @error('price')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
            </div>

            <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
            <button type="submit" class="btn btn-primary">Update Details</button>
            @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
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
                        <tr class="{{$size->deleted == 1 ? "text-danger" : ""}}">
                            <td>{{ $size->id }}</td>
                            <td>{{ $size->size }}</td>
                            @if ($size->deleted == 0)
                                <td>{{ $size->quantity }}</td>
                                <td>
                                    <form method="post" action="/admin/stock/api/manage/size/delete">
                                        @csrf
                                        <input hidden type="number" name="size_id" value="{{$size->id}}"/>
                                        <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="location.href = '/admin/stock/manage/size/{{$size->id}}'">Edit</button>
                                        <button type="button" id="archiveSize-{{$size->id}}" class="btn btn-danger btn-sm" onclick="archive({{$size->id}})">Archive</button>
                                        <button type="submit" id="confirmArchiveSize-{{$size->id}}" class="btn btn-danger btn-sm" style="display: none">Are you sure?</button>
                                    </form>
                                </td>
                            @else
                                <td>-</td>
                                <td>Archived</td>
                            @endif
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
                            <input type="text" class="form-control" id="size" name="size" placeholder="UK 9" value="{{ old('size') ? old('size') : "" }}">
                            @error('size')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="hideSizeForm()">Cancel</button>
                        @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                    </form>
                </div>
            </div>
        </div>

        <br>
        <h3 class="mb-4">Image Management</h3>
        <img src="{{ $stock->images->first()->image_path }}" alt="{{ $stock->name }}" class="img-thumbnail">
        <br><br>
        <form method="post" action="/admin/stock/api/manage/image/update">
            @csrf
            <div class="form-group">
                <label for="image">Stock Image URL</label>
                <input type="text" class="form-control" id="image" name="image" placeholder="https://i.postimg.cc/MheiEa242" value="{{ old('image') ? old('image') : $stock->images->first()->image_path }}">
                @error('image')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <input hidden type="number" name="image_id" value="{{$stock->images->first()->id}}"/>
            <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
            <button type="submit" class="btn btn-primary">Update Image</button>
            @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
        </form>

        <br>
        <h3 class="mb-4">Curated Outfit</h3>
        @if($stock->curatedOutfit == null)
            <p>This product does not have a curated outfit.</p>
            <button class="btn btn-primary" id="createOutfitButton" onclick="showOutfitForm()">Create Outfit</button>
            <div id="outfitCreator" style="display: none">
                <h3 class="mb-2">Create Outfit</h3>
                <form method="post" action="/admin/stock/api/manage/outfit/create">
                    @csrf
                    <div class="form-group">
                        <label for="image">Stock Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" placeholder="https://i.postimg.cc/MheiEa242" value="{{ old('image') ? old('image') : "" }}">
                        @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" rows="4">{{ old('description') ? old('description') : ''}}</textarea>
                        @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="copyright">Copyright Acknowledgements</label>
                        <input type="text" class="form-control" id="copyright" name="copyright" placeholder="Nike 2024" value="{{ old('copyright') ? old('copyright') : "" }}">
                        @error('copyright')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>

                    <input hidden type="number" name="stock_id" value="{{$stock->id}}"/>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" onclick="hideOutfitForm()">Cancel</button>
                    @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                    <br><br>
                </form>
            </div>
        @else
            <form method="post" id="outfitUpdateForm">
                @csrf
                <div class="form-group">
                    <label for="image">Stock Image URL</label>
                    <input type="text" class="form-control" id="image" name="image" placeholder="https://i.postimg.cc/MheiEa242" value="{{ old('image') ? old('image') : $stock->curatedOutfit->image_url }}">
                    @error('image')<p class="text-danger">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" rows="4">{{ old('description') ? old('description') : $stock->curatedOutfit->description }}</textarea>
                    @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="copyright">Copyright Acknowledgements</label>
                    <input type="text" class="form-control" id="copyright" name="copyright" placeholder="Nike 2024" value="{{ old('copyright') ? old('copyright') : $stock->curatedOutfit->copyright }}">
                    @error('copyright')<p class="text-danger">{{ $message }}</p>@enderror
                </div>

                <input hidden type="number" name="outfit_id" value="{{$stock->curatedOutfit->id}}"/>
                <button type="submit" class="btn btn-primary" onclick="updateOutfit()">Update</button>
                <button type="submit" class="btn btn-danger" onclick="deleteOutfit()">Delete</button>
                @error('submit')<p class="text-danger">{{ $message }}</p>@enderror
                <br><br>
            </form>
        @endif

        <br><br>
        <h3 class="mb-4">Other Actions</h3>
        <button class="btn btn-danger" onclick="location.href = '/admin/stock/manage/{{$stock->id}}/delete'">Archive</button>
        <button class="btn btn-secondary" onclick="location.href = '/admin/stock/manage'">Back</button>
        <br><br>
    </div>

</body>
