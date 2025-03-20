<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager | Crep Culture</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">

</head>
<body>
@include('admin.header')

<!-- Page Content -->
<div class="container page-container">
    <h2 class="text-center mb-4">Account Manager</h2>
    @if(session('success'))
        <p class="text-center text-success">{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered" id="ordersTable">
                <thead class="thead-dark">
                <tr>
                    <th>Account ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account Created</th>
                    <th>Is Admin?</th>
                    <th>No. Orders Placed</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->aid }}</td>
                            <td>{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->created_at }}</td>
                            <td>{{ $account->isAdmin == 1 ? "Yes" : "No" }}</td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" onclick="location.href = '/admin/accounts/{{$account->aid}}'">View Details</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($accounts->count() == 0)
                <p class="text-center">There are no accounts to manage.</p>
            @endif
            <button class="btn btn-secondary" onclick="location.href = '/admin'">Back</button>
            <br><br>
        </div>
    </div>
</div>
