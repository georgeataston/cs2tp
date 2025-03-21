<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$stock->category->brand->name}} {{$stock->category->name}} {{$stock->name}} - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/productdisplay.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <style>
        .price-history-container {
            margin-top: 20px;
            text-align: center;
        }
        #my-chart {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }
        .y-axis {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
            margin-right: 10px;
            font-size: 14px;
            text-align: right;
        }
        .charts-css.area tbody tr td {
            background-color: #4A90E2;
            opacity: 0.8;
        }
        .months-labels {
            display: flex;
            justify-content: space-between;
            max-width: 500px;
            margin: 10px auto;
            font-size: 14px;
            text-align: center;
            gap: 10px;
        }
    </style>
    <script>
        function generateRandomData(points, lastPrice) {
            let prices = [];
            let prevValue = lastPrice * (Math.random() * 0.5 + 0.5);
            for (let i = 0; i < points - 1; i++) {
                let newValue = Math.max(lastPrice * 0.5, Math.min(lastPrice * 1.5, prevValue + (Math.random() - 0.5) * lastPrice * 0.3));
                prices.push(newValue);
                prevValue = newValue;
            }
            prices.push(lastPrice);
            return prices;
        }

        function updateYAxis(maxPrice) {
            const yAxis = document.getElementById("y-axis");
            yAxis.innerHTML = "";
            for (let i = 4; i >= 0; i--) {
                let span = document.createElement("span");
                span.textContent = `£${Math.round((maxPrice / 4) * i)}`;
                yAxis.appendChild(span);
            }
        }

        function populateChart(lastPrice) {
            const prices = generateRandomData(12, lastPrice);
            const tableBody = document.querySelector("#price-history tbody");
            tableBody.innerHTML = "";
            for (let i = 0; i < prices.length - 1; i++) {
                let row = document.createElement("tr");
                let cell = document.createElement("td");
                cell.style.setProperty("--start", prices[i] / lastPrice);
                cell.style.setProperty("--end", prices[i + 1] / lastPrice);
                row.appendChild(cell);
                tableBody.appendChild(row);
            }
            updateYAxis(lastPrice);
        }

        function populateMonths() {
            const months = ["Feb 24", "Mar 24", "Apr 24", "May 24", "Jun 24", "Jul 24", "Aug 24", "Sep 24", "Oct 24", "Nov 24", "Dec 24", "Jan 25", "Mar 25"];
            const labelsContainer = document.getElementById("months-labels");
            labelsContainer.innerHTML = "";
            months.forEach(month => {
                let span = document.createElement("span");
                span.textContent = month;
                labelsContainer.appendChild(span);
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const lastPrice = {{$stock->price}};
            populateMonths();
            populateChart(lastPrice);
        });
    </script>
</head>
<body>
    @include("header")
    <div class="product-display">
        <div class="product-image-section">
            <img src="{{$stock->images->first()->image_path}}" alt="{{$stock->category->name}} {{$stock->name}}">
        </div>
        <div class="product-info-section">
            <h1>{{$stock->category->brand->name}} {{$stock->category->name}}</h1>
            <h2>{{$stock->name}}</h2>
            @if(!$stock->isOutOfStock())
                <p class="price">£{{$stock->price}}</p>
            @endif
            @if ($stock->isOutOfStock())
                <br>
                <div class="alert out-of-stock">Out of Stock</div>
                <br>
            @elseif ($stock->isLowStock())
                <div class="alert low-stock">Low in Stock: Only {{ $stock->quantity }} left!</div>
                <br><br>
            @endif
            @if (!$stock->isOutOfStock())
                <form class="product-options" action="/basket/add" method="post">
                    @csrf
                    <label for="size">Size</label>
                    <select id="size" name="size">
                        <option>Select</option>
                        @foreach($sizes as $size)
                            @if($size->quantity <= 0)
                                <option disabled value="{{ $size->id }}">{{ $size->size }} (OUT OF STOCK)</option>
                            @else
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('size')<p id="form-error">{{ $message }}</p><br>@enderror
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="{{old('quantity') ? old('quantity') : 1}}">
                    @error('quantity')<p id="form-error">{{ $message }}</p><br>@enderror
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    @if (session('success') == "added")
                        <p id="form-success">Item has been added to your basket!</p>
                        <br>
                    @endif
                </form>
            @endif
            <p class="description">{{$stock->description}}</p>
            
            <!-- Price History Section -->
            <div class="price-history-container">
                <h3>Price History</h3>
                <div id="my-chart">
                    <div class="y-axis" id="y-axis"></div>
                    <table class="charts-css area show-heading" id="price-history">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="months-labels" id="months-labels"></div>
            </div>
        </div>
    </div>
    @include('footer')
</body>
</html>
