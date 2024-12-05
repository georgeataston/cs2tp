<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display Search - Shoe Reselling Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #212529;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #d3d3d3 !important;
        }

        .page-container {
            margin-top: 50px;
        }

        .form-control {
            background-color: #495057;
            border: 1px solid #6c757d;
            color: #ffffff;
        }

        .form-control:focus {
            background-color: #343a40;
            border-color: #ff8c00;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }

        .btn-primary:hover {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }

        .table {
            background-color: #343a40;
            color: #ffffff;
        }

        .table th, .table td {
            border-color: #6c757d;
        }

        .table th {
            background-color: #495057;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #2f3438;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #343a40;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        footer {
            background-color: #343a40;
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
                    <a class="nav-link" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.html">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="process_orders.html">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.html">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.html">Account</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container page-container">
        <h2 class="text-center mb-4">Product Display Search</h2>
        <!-- Search Form -->
        <form class="form-inline mb-4" id="searchProductForm">
            <div class="form-group mr-3">
                <label for="searchProduct" class="mr-2">Search Product:</label>
                <input type="text" id="searchProduct" class="form-control" placeholder="Enter product name">
            </div>
            <button type="button" class="btn btn-primary" onclick="searchProducts()">Search</button>
        </form>

        <!-- Products Table -->
        <table class="table table-striped table-bordered" id="productsTable">
            <thead class="thead-dark">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PROD001</td>
                    <td>Nike Air Max 270</td>
                    <td>Nike</td>
                    <td>Sneakers</td>
                    <td>$150.00</td>
                    <td>25</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD002</td>
                    <td>Adidas Ultraboost</td>
                    <td>Adidas</td>
                    <td>Running</td>
                    <td>$180.00</td>
                    <td>30</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD003</td>
                    <td>Puma RS-X</td>
                    <td>Puma</td>
                    <td>Sneakers</td>
                    <td>$120.00</td>
                    <td>40</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD004</td>
                    <td>Reebok Classic Leather</td>
                    <td>Reebok</td>
                    <td>Casual</td>
                    <td>$85.00</td>
                    <td>50</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD005</td>
                    <td>Converse Chuck Taylor</td>
                    <td>Converse</td>
                    <td>Casual</td>
                    <td>$60.00</td>
                    <td>35</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD006</td>
                    <td>Vans Old Skool</td>
                    <td>Vans</td>
                    <td>Skateboarding</td>
                    <td>$70.00</td>
                    <td>45</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD007</td>
                    <td>Nike Air Force 1</td>
                    <td>Nike</td>
                    <td>Casual</td>
                    <td>$110.00</td>
                    <td>20</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD008</td>
                    <td>Adidas Yeezy Boost 350</td>
                    <td>Adidas</td>
                    <td>Limited Edition</td>
                    <td>$300.00</td>
                    <td>10</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD009</td>
                    <td>Puma Suede Classic</td>
                    <td>Puma</td>
                    <td>Casual</td>
                    <td>$75.00</td>
                    <td>60</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
                <tr>
                    <td>PROD010</td>
                    <td>New Balance 574</td>
                    <td>New Balance</td>
                    <td>Casual</td>
                    <td>$90.00</td>
                    <td>25</td>
                    <td>
                        <button class="btn btn-secondary btn-sm">View Details</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Shoe Reselling Portal. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function searchProducts() {
            const productName = $('#searchProduct').val().toLowerCase();
            
            $('#productsTable tbody tr').filter(function () {
                const rowProduct = $(this).find('td:eq(1)').text().toLowerCase();
                
                if (rowProduct.includes(productName)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>
</body>
</html>
