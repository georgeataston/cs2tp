<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Shoe Reselling Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .page-container {
            margin-top: 50px;
        }  
        .navbar-nav .nav-link {
            color: #fff !important;
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
                    <a class="nav-link" href="index.html">Home</a>
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
        <h2 class="text-center mb-4">View Orders Received</h2>
        <div class="row">
            <div class="col-md-12">
                <!-- Orders Table -->
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Shipping Address</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD001</td>
                            <td>John Doe</td>
                            <td>Nike Air Max 270</td>
                            <td>1</td>
                            <td>Pending</td>
                            <td>2024-11-20</td>
                            <td>123 Main St, New York, NY</td>
                            <td>$150.00</td>
                            <td>
                                <button class="btn btn-success btn-sm">Mark as Processed</button>
                                <button class="btn btn-danger btn-sm">Cancel Order</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD002</td>
                            <td>Jane Smith</td>
                            <td>Adidas Ultraboost</td>
                            <td>2</td>
                            <td>Shipped</td>
                            <td>2024-11-18</td>
                            <td>456 Elm St, Los Angeles, CA</td>
                            <td>$300.00</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD003</td>
                            <td>Mark Johnson</td>
                            <td>Puma RS-X</td>
                            <td>1</td>
                            <td>Delivered</td>
                            <td>2024-11-15</td>
                            <td>789 Oak St, Chicago, IL</td>
                            <td>$120.00</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD004</td>
                            <td>Alice Brown</td>
                            <td>Nike Air Force 1</td>
                            <td>3</td>
                            <td>Processed</td>
                            <td>2024-11-16</td>
                            <td>321 Maple St, Houston, TX</td>
                            <td>$300.00</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD005</td>
                            <td>Bob White</td>
                            <td>Reebok Classic</td>
                            <td>1</td>
                            <td>Pending</td>
                            <td>2024-11-21</td>
                            <td>654 Pine St, Phoenix, AZ</td>
                            <td>$80.00</td>
                            <td>
                                <button class="btn btn-success btn-sm">Mark as Processed</button>
                                <button class="btn btn-danger btn-sm">Cancel Order</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD006</td>
                            <td>Chris Green</td>
                            <td>Vans Old Skool</td>
                            <td>2</td>
                            <td>Canceled</td>
                            <td>2024-11-10</td>
                            <td>987 Cedar St, San Antonio, TX</td>
                            <td>$140.00</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD007</td>
                            <td>David Black</td>
                            <td>Converse Chuck Taylor</td>
                            <td>1</td>
                            <td>Delivered</td>
                            <td>2024-11-12</td>
                            <td>159 Spruce St, San Diego, CA</td>
                            <td>$65.00</td>
                            <td>
                                <button class="btn btn-secondary btn-sm">View Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD008</td>
                            <td>Eve White</td>
                            <td>New Balance 574</td>
                            <td>1</td>
                            <td>Processed</td>
                            <td>2024-11-17</td>
                            <td>753 Birch St, Dallas, TX</td>
                            <td>$90.00</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD009</td>
                            <td>Frank Brown</td>
                            <td>Asics Gel-Lyte</td>
                            <td>1</td>
                            <td>Shipped</td>
                            <td>2024-11-19</td>
                            <td>951 Willow St, San Francisco, CA</td>
                            <td>$100.00</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Update Status</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD010</td>
                            <td>Grace Red</td>
                            <td>Jordan 1 Retro</td>
                            <td>1</td>
                            <td>Pending</td>
                            <td>2024-11-22</td>
                            <td>357 Aspen St, Miami, FL</td>
                            <td>$180.00</td>
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
</body>
</html>
