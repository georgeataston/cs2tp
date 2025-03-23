<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return #{{ $return->id }} | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

    <script>
        function approveItem(id) {
            var status = document.getElementById(id);
            status.value = "2";
            return true;
        }

        function denyItem(id) {
            var status = document.getElementById(id);
            status.value = "1";
            return true;
        }

        function defaultItem(id) {
            var status = document.getElementById(id);
            status.value = "0";
            return true;
        }

        function receiveItem(id) {
            var status = document.getElementById(id);
            status.value = "3";
            return true;
        }

        function undoItemReceive(id) {
            var status = document.getElementById(id);
            status.value = "2";
            return true;
        }

        function receiveItemApprove(id) {
            var status = document.getElementById(id);
            status.value = "4";
            return true;
        }

        function receiveItemDeny(id) {
            var status = document.getElementById(id);
            status.value = "5";
            return true;
        }
    </script>
</head>
<body>
    @include('admin/header')
    <div class="container page-container">
        <h2 class="text-center mb-4">Return #{{ $return->id }}</h2>
        @if(session('success'))
            <p class="text-center text-success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-center text-danger">{{ session('error') }}</p>
        @endif
        <h3 class="mb-3">Details</h3>
        <table class="table table-striped table-bordered" id="ordersTable">
            <thead class="thead-dark">
            <tr>
                <th>Return/Order ID</th>
                <th>Customer Details</th>
                <th>Status</th>
                <th>Request Date</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#{{ $return->id }} / #{{ $return->order->id }}</td>
                    <td>{{ $return->order->fullName }}<br>{{ $return->order->email }}</td>
                    <td>{{ $return->statusText() }}</td>
                    <td>{{ $return->created_at }}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <h3 class="mb-4">Items</h3>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Amount Paid</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($return->items as $item)
                    <tr>
                    <td>{{ $item->orderItem->stock()->category->brand->name }} {{ $item->orderItem->stock()->name }}<br>Stock ID: {{ $item->orderItem->stock()->id }} / Order Item ID: {{ $item->orderItem->id }}</td>
                    <td>{{ $item->orderItem->size->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->orderItem->price }}</td>
                    <td>{{ $item->statusText() }}</td>
                    <td>
                        @if($item->return->status == 0 || $item->return->status == 1)
                            @if($item->status == 0)
                                <form method="post" action="/admin/returns/api/item/update">
                                    @csrf
                                    <input hidden type="number" name="return_item_id" value="{{$item->id}}"/>
                                    <input hidden type="number" name="status" id="newForm-{{$item->id}}-status" value="0"/>
                                    <button class="btn btn-success btn-sm" onclick="approveItem('newForm-{{$item->id}}-status')">Approve</button>
                                    <button class="btn btn-danger btn-sm" onclick="denyItem('newForm-{{$item->id}}-status')">Deny</button>
                                </form>
                            @elseif($item->status == 1)
                                <form method="post" action="/admin/returns/api/item/update">
                                    @csrf
                                    <input hidden type="number" name="return_item_id" value="{{$item->id}}"/>
                                    <input hidden type="number" name="status" value="0"/>
                                    <button class="btn btn-secondary btn-sm">Undo Denial</button>
                                </form>
                            @elseif($item->status == 2)
                                <form method="post" action="/admin/returns/api/item/update">
                                    @csrf
                                    <input hidden type="number" name="return_item_id" value="{{$item->id}}"/>
                                    <input hidden type="number" name="status" id="approveForm-{{$item->id}}-status" value="0"/>
                                    <button class="btn btn-success btn-sm" onclick="receiveItem('approveForm-{{$item->id}}-status')">Mark as Received</button>
                                    <button class="btn btn-secondary btn-sm" onclick="defaultItem('approveForm-{{$item->id}}-status')">Undo Approval</button>
                                </form>
                            @elseif($item->status == 3)
                                <form method="post" action="/admin/returns/api/item/update">
                                    @csrf
                                    <input hidden type="number" name="return_item_id" value="{{$item->id}}"/>
                                    <input hidden type="number" name="status" id="receiveForm-{{$item->id}}-status" value="0"/>
                                    <button class="btn btn-success btn-sm" onclick="receiveItemApprove('receiveForm-{{$item->id}}-status')">Approve Item</button>
                                    <button class="btn btn-danger btn-sm" onclick="receiveItemDeny('receiveForm-{{$item->id}}-status')">Deny Item</button>
                                    <button class="btn btn-secondary btn-sm" onclick="undoItemReceive('receiveForm-{{$item->id}}-status')">Undo Receive</button>
                                </form>
                            @elseif($item->status == 4 || $item->status == 5)
                                <form method="post" action="/admin/returns/api/item/update">
                                    @csrf
                                    <input hidden type="number" name="return_item_id" value="{{$item->id}}"/>
                                    <input hidden type="number" name="status" value="3"/>
                                    <button class="btn btn-secondary btn-sm">Undo {{ $item->buttonStatusText() }}</button>
                                </form>
                            @endif
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <h3 class="mb-4">Return Reason</h3>
        <div class="card">
            <div class="card-body bg-dark">
                {{ $return->reason }}
            </div>
        </div>

        <br>
        <h3 class="mb-4">Actions</h3>
        @if ($return->canSignOff())
            <form method="post" action="/admin/returns/api/signoff">
                @csrf
                <input hidden type="number" name="return_id" value="{{$return->id}}"/>
                <button type="submit" class="btn btn-success">Sign Off</button>
                <button type="button" class="btn btn-secondary" onclick="location.href = '/admin/returns'">Back</button>
                <small class="form-text text-muted">You must click 'sign off' to process the return. Your changes have been saved.</small>
            </form>
        @else
            <button class="btn btn-secondary" onclick="location.href = '/admin/returns'">Back</button>
        @endif
    </div>

</body>
