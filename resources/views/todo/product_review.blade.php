<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews - Shoe Reselling Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #212529;
            color: #ffffff;
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
            background-color: #e67e00;
            border-color: #e67e00;
        }

        .card {
            background-color: #343a40;
            border: none;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .card-title {
            color: #ff8c00;
        }

        .card-body {
            background-color: #2f3438;
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
        <h2 class="text-center mb-4">Product Reviews</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Review Form -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leave a Review</h5>
                        <form>
                            <div class="form-group">
                                <label for="reviewerName">Your Name</label>
                                <input type="text" class="form-control" id="reviewerName" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="productRating">Rating</label>
                                <select class="form-control" id="productRating">
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reviewText">Your Review</label>
                                <textarea class="form-control" id="reviewText" rows="3" placeholder="Write your review here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
                <!-- Reviews Section -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer Reviews</h5>
                        <div class="media mb-3">
                            <div class="media-body">
                                <h6 class="mt-0">John Doe <small class="text-muted">- 5 stars</small></h6>
                                <p>Great product! Really comfortable and stylish. Will definitely buy again.</p>
                            </div>
                        </div>
                        <div class="media mb-3">
                            <div class="media-body">
                                <h6 class="mt-0">Jane Smith <small class="text-muted">- 4 stars</small></h6>
                                <p>Very happy with my purchase. The shoes are well-made and arrived on time.</p>
                            </div>
                        </div>
                        <div class="media mb-3">
                            <div class="media-body">
                                <h6 class="mt-0">Mark Johnson <small class="text-muted">- 3 stars</small></h6>
                                <p>Decent product, but took longer to arrive than expected.</p>
                            </div>
                        </div>
                    </div>
                </div>
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