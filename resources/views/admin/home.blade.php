<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Crep Culture</title>
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
        <a class="navbar-brand" href="/admin">Crep Culture Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/stock">Stock</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/accounts">Accounts</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container page-container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Processor</h5>
                        <p class="card-text">Manage and action customer orders.</p>
                        <a href="/admin/orders" class="btn btn-primary">Continue</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stock Management</h5>
                        <p class="card-text">Manage the current stock. Including categories, brands and images.</p>
                        <a href="/admin/stock" class="btn btn-primary">Continue</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Account Management</h5>
                        <p class="card-text">Manager user accounts.</p>
                        <a href="/admin/accounts" class="btn btn-primary">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Crep Culture. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
