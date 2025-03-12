<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crep Culture - Shoe Reselling</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #1a1a1a;
            border-bottom: 1px solid #333;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo {
            height: 50px;
        }

        .logo img {
            height: 100%;
            width: auto;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            padding: 10px 15px;
            background-color: #2a2a2a;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-menu a:hover {
            background-color: #3a3a3a;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .nav-buttons .login {
            background-color: #ff6200;
            color: #fff;
        }

        .nav-buttons .login:hover {
            background-color: #e65c00;
        }

        .nav-buttons .signup {
            background-color: #ff6200;
            color: #fff;
        }

        .nav-buttons .signup:hover {
            background-color: #e65c00;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 100px; /* Adjust for fixed header height */
        }

        /* Product Header */
        .product-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-header h1 {
            color: #ff6200;
            font-size: 24px;
        }

        .product-header p {
            color: #ccc;
            font-size: 14px;
        }

        /* Search and Sort */
        .search-sort {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
            flex-wrap: wrap;
            position: relative;
            z-index: 998; /* Ensure search bar stays above filter sidebar */
        }

        .search-sort input[type="text"] {
            width: 70%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            outline: none;
        }

        .search-sort select {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            width: 200px;
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            position: absolute;
            left: 20px;
            top: 250px; /* Moved further down to avoid overlapping search bar */
            display: none;
            z-index: 999;
        }

        .filter-sidebar h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .filter-sidebar label {
            display: block;
            margin-bottom: 5px;
            color: #ccc;
        }

        .filter-sidebar select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
        }

        .filter-sidebar button {
            width: 100%;
            padding: 10px;
            background-color: #ff6200;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-left: 220px; /* Space for filter sidebar */
            padding-bottom: 20px;
        }

        .product-card {
            background-color: #333;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .product-card h3 {
            color: #ff6200;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-card p {
            color: #ccc;
            font-size: 16px;
        }

        /* Single Product View (Search Result) */
        .single-product {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
            margin-left: 220px; /* Align with filter sidebar */
        }

        .single-product .product-card {
            width: 500px; /* Larger size for single product */
            padding: 30px;
            min-height: 400px;
        }

        .single-product .product-card img {
            width: 100%;
            height: 300px; /* Larger image for single product */
            object-fit: contain;
            margin-bottom: 20px;
        }

        .single-product .product-card h3 {
            font-size: 24px;
        }

        .single-product .product-card p {
            font-size: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                flex-direction: column;
                gap: 10px;
                position: absolute;
                top: 80px;
                left: 0;
                right: 0;
                background-color: #1a1a1a;
                padding: 10px;
                display: none;
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-buttons {
                flex-direction: column;
            }

            .header {
                flex-direction: column;
                gap: 10px;
            }

            .search-sort {
                flex-direction: column;
                align-items: stretch;
            }

            .search-sort input[type="text"] {
                width: 100%;
            }

            .search-sort select {
                width: 100%;
            }

            .product-grid, .single-product {
                margin-left: 0;
                grid-template-columns: 1fr;
            }

            .filter-sidebar {
                position: static;
                width: 100%;
                margin-bottom: 20px;
            }

            .container {
                margin-top: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="https://via.placeholder.com/150x50?text=Crep+Culture+Logo" alt="Crep Culture Logo">
        </div>
        <div class="nav-menu">
            <a href="#">HOME</a>
            <a href="#">SHOP</a>
            <a href="#">ABOUT US</a>
            <a href="#">CONTACT</a>
            <div class="nav-buttons">
                <button class="login">LOGIN</button>
                <button class="signup">SIGN UP</button>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Product Header -->
        <div class="product-header">
            <h1>All Products</h1>
            <p>Purchase a range of shoes here on our shoe reselling website. Connect with resellers for cheaper products.</p>
        </div>

        <!-- Search and Sort -->
        <div class="search-sort">
            <input type="text" id="searchInput" placeholder="Search all products...">
            <select id="sortSelect">
                <option value="default">Sort by: Default</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
            </select>
        </div>

        <!-- Product Grid -->
        <div class="product-grid" id="productGrid">
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+1+Chicago" alt="Air Jordan 1 Retro High OG 'Chicago'">
                <h3>Air Jordan 1 Retro High OG 'Chicago'</h3>
                <p>€400.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+1+Mocha" alt="Air Jordan 1 Travis Scott Retro High OG 'Mocha'">
                <h3>Air Jordan 1 Travis Scott Retro High OG 'Mocha'</h3>
                <p>€2000.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+1+Dior" alt="Air Jordan 1 Dior High">
                <h3>Air Jordan 1 Dior High</h3>
                <p>€1500.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+4+White+Thunder" alt="Air Jordan 4 Retro 'White Thunder'">
                <h3>Air Jordan 4 Retro 'White Thunder'</h3>
                <p>€400.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+4+Military+Black" alt="Air Jordan 4 Retro 'Military Black'">
                <h3>Air Jordan 4 Retro 'Military Black'</h3>
                <p>€500.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+4+University+Blue" alt="Air Jordan 4 Retro 'University Blue'">
                <h3>Air Jordan 4 Retro 'University Blue'</h3>
                <p>€350.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+5+Racer+Blue" alt="Air Jordan 5 Retro 'Racer Blue'">
                <h3>Air Jordan 5 Retro 'Racer Blue'</h3>
                <p>€300.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+5+UNC" alt="Air Jordan 5 Retro 'UNC'">
                <h3>Air Jordan 5 Retro 'UNC'</h3>
                <p>€270.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Jordan+5+Quai+54" alt="Air Jordan 5 Retro 'Quai 54' 2021">
                <h3>Air Jordan 5 Retro 'Quai 54' 2021</h3>
                <p>€320.00</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/200x200?text=Nike+Dunk+Low" alt="Nike Dunk Low 'Black White'">
                <h3>Nike Dunk Low 'Black White'</h3>
                <p>€150.00</p>
            </div>
        </div>

        <!-- Filter Sidebar -->
        <div class="filter-sidebar" id="filterSidebar">
            <h3>Filters</h3>
            <label>Price Range: €251-500</label>
            <select id="sizeFilter">
                <option value="all">Select Shoe Size</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
            </select>
            <button onclick="applyFilters()">Apply Filters</button>
        </div>
    </div>

    <script>
        // Search Functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const productCards = document.getElementsByClassName('product-card');
            let found = false;

            for (let card of productCards) {
                const title = card.getElementsByTagName('h3')[0].textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                    found = true;
                } else {
                    card.style.display = 'none';
                }
            }

            // Show filter sidebar and adjust layout for single product
            const visibleCards = Array.from(productCards).filter(card => card.style.display !== 'none');
            if (found && visibleCards.length === 1) {
                document.getElementById('filterSidebar').style.display = 'block';
                document.getElementById('productGrid').classList.add('single-product');
            } else {
                document.getElementById('filterSidebar').style.display = 'none';
                document.getElementById('productGrid').classList.remove('single-product');
            }

            // Update header for search results
            const header = document.querySelector('.product-header h1');
            if (searchTerm) {
                header.textContent = `Search Results for ${searchTerm}`;
            } else {
                header.textContent = 'All Products';
            }
        });

        // Sort Functionality
        document.getElementById('sortSelect').addEventListener('change', function() {
            const sortBy = this.value;
            const productCards = Array.from(document.getElementsByClassName('product-card'));
            productCards.sort((a, b) => {
                const priceA = parseFloat(a.getElementsByTagName('p')[0].textContent.replace('€', '').replace(',', ''));
                const priceB = parseFloat(b.getElementsByTagName('p')[0].textContent.replace('€', '').replace(',', ''));
                if (sortBy === 'price-asc') return priceA - priceB;
                if (sortBy === 'price-desc') return priceB - priceA;
                return 0;
            });
            const productGrid = document.getElementById('productGrid');
            productGrid.innerHTML = '';
            productCards.forEach(card => productGrid.appendChild(card));
        });

        // Filter Functionality
        function applyFilters() {
            const size = document.getElementById('sizeFilter').value;
            if (size === 'all') return;

            const productCards = document.getElementsByClassName('product-card');
            for (let card of productCards) {
                card.style.display = size === 'all' ? 'block' : 'none';
            }
        }
    </script>
</body>
</html>