<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Reselling Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Page Styles */
        body {
            background-color: #2c2c2c; /* Light gray background */
            font-family: 'Arial', sans-serif;
        }

        .btn-primary {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }

        .navbar {
            background-color: #343a40; /* Dark gray background for the navbar */
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ff8c00 !important; /* Hover effect color */
        }

        .page-container {
            margin-top: 50px;
        }

        .card {
            border-radius: 10px; /* Rounded corners for cards */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-body {
            background-color: #ffffff;
        }

        .btn-primary {
            background-color: #ff8c00; /* Golden button color */
            border-color: #ff8c00; 
        }

        .btn-primary:hover {
            background-color: #ff8c00; /* Hover effect for button */
            border-color: #ff8c00;
        }

        .footer {
            background-color: #343a40; /* Same as navbar for consistency */
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
        }

        .card-text {
            font-size: 1rem;
            color: #666; /* Slightly muted text color */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Shoe Reselling Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
<<<<<<<< HEAD:resources/views/home.blade.php
                    <a class="nav-link" href="home.html">Home</a>
========
                    <a class="nav-link" href="/admin">Home</a>
>>>>>>>> 99021f065cb89b0edf01ab7cfb4f56989c22ad6f:resources/views/admin/index.blade.php
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/orders/process">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/account">Account</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container page-container">
        <div class="row">
            <!-- Admin Order Processor Section -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Order Processor</h5>
                        <p class="card-text">Search & filter status of selected products and orders.</p>
                        <a href="/admin/orders/process" class="btn btn-primary">Process Orders</a>
                    </div>
                </div>
            </div>

            <!-- Process Orders Section -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Process Orders Received</h5>
                        <p class="card-text">Manage and track the orders received.</p>
                        <a href="/admin/orders" class="btn btn-primary">View Orders</a>
                    </div>
                </div>
            </div>

            <!-- Show Categories Section -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Show Categories</h5>
                        <p class="card-text">Show categories with links to them.</p>
                        <a href="/admin/categories" class="btn btn-primary">Explore Categories</a>
                    </div>
                </div>
            </div>
<<<<<<<< HEAD:resources/views/home.blade.php

========
>>>>>>>> 99021f065cb89b0edf01ab7cfb4f56989c22ad6f:resources/views/admin/index.blade.php
            <!-- Product Display Section -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Display Search</h5>
                        <p class="card-text">Search for products available in inventory.</p>
                        <a href="/admin/products" class="btn btn-primary">Search Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Shoe Reselling Portal. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
