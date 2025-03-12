<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Orders - Shoe Reselling Portal</title>
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
            border-color: #004085;
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

        .card {
            background-color: #495057;
            border: none;
            color: #fff;
        }

        .card-title {
            color: #ff8c00;
        }

        .card-body {
            background-color: #343a40;
        }

        .card:hover {
            transform: scale(1.05);
        }

        footer {
            background-color: #343a40;
        }

        .btn-success, .btn-danger, .btn-warning, .btn-secondary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-sm {
            padding: 0.2rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.2rem;
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
        <h2 class="text-center mb-4">Admin Order Return</h2>
        <div class="row">
            <div class="col-md-12">
                <!-- Search Form -->
                <form class="form-inline mb-4" id="searchForm">
                    <div class="form-group mr-3">
                        <label for="orderStatus" class="mr-2">Order Status:</label>
                        <select id="orderStatus" class="form-control">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="processed">Processed</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <label for="searchProduct" class="mr-2">Product:</label>
                        <input type="text" id="searchProduct" class="form-control" placeholder="Enter product name">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="filterOrders()">Search</button>
                </form>

                <!-- Orders Table -->
                <table class="table table-striped table-bordered" id="ordersTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD001</td>
                            <td>John Doe</td>
                            <td>Nike Air Max 270</td>
                            <td>Pending</td>
                            <td>2024-11-20</td>
                            <td>
                                <button class="btn btn-success btn-sm">Mark as Processed</button>
                                <button class="btn btn-danger btn-sm">Cancel Order</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD002</td>
                            <td>Jane Smith</td>
                            <td>Adidas Ultraboost</td>
                            <td>Shipped</td>
                            <td>2024-11-18</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD003</td>
                            <td>Mark Johnson</td>
                            <td>Puma RS-X</td>
                            <td>Delivered</td>
                            <td>2024-11-15</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD004</td>
                            <td>Alice Brown</td>
                            <td>Nike Air Force 1</td>
                            <td>Processed</td>
                            <td>2024-11-16</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD005</td>
                            <td>Bob White</td>
                            <td>Reebok Classic</td>
                            <td>Pending</td>
                            <td>2024-11-21</td>
                            <td>
                                <button class="btn btn-success btn-sm">Mark as Processed</button>
                                <button class="btn btn-danger btn-sm">Cancel Order</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD006</td>
                            <td>Chris Green</td>
                            <td>Vans Old Skool</td>
                            <td>Canceled</td>
                            <td>2024-11-10</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD007</td>
                            <td>David Black</td>
                            <td>Converse Chuck Taylor</td>
                            <td>Delivered</td>
                            <td>2024-11-12</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD008</td>
                            <td>Eve White</td>
                            <td>New Balance 574</td>
                            <td>Processed</td>
                            <td>2024-11-17</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD009</td>
                            <td>Frank Brown</td>
                            <td>Asics Gel-Lyte</td>
                            <td>Shipped</td>
                            <td>2024-11-19</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD010</td>
                            <td>Grace Red</td>
                            <td>Jordan 1 Retro</td>
                            <td>Pending</td>
                            <td>2024-11-22</td>
                            <td>
                                <button class="btn btn-success btn-sm">Mark as Processed</button>
                                <button class="btn btn-danger btn-sm">Cancel Order</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
        function filterOrders() {
            const status = $('#orderStatus').val().toLowerCase();
            const product = $('#searchProduct').val().toLowerCase();
            
            $('#ordersTable tbody tr').filter(function () {
                const rowStatus = $(this).find('td:eq(3)').text().toLowerCase();
                const rowProduct = $(this).find('td:eq(2)').text().toLowerCase();
                
                if ((status === 'all' || rowStatus.includes(status)) && rowProduct.includes(product)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>
</body>
</html>
