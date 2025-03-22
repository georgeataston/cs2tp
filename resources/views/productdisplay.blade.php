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
</div>

<!-- Price History Line Graph -->
<div class="price-history-container">
    <h3>Price History</h3>
    <canvas id="priceChart"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById("priceChart").getContext("2d");
        const lastPrice = {{$stock->price}};
        const months = ["Feb 24", "Mar 24", "Apr 24", "May 24", "Jun 24", "Jul 24", "Aug 24", "Sep 24", "Oct 24", "Nov 24", "Dec 24", "Jan 25", "Mar 25"];
        
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

        const prices = generateRandomData(13, lastPrice);

        new Chart(ctx, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: "Price (£)",
                    data: prices,
                    borderColor: "#007BFF",
                    backgroundColor: "rgba(0, 123, 255, 0.1)",
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { color: "black" }
                    },
                    y: {
                        beginAtZero: false,
                        ticks: { color: "black" }
                    }
                }
            }
        });
    });
</script>

<div class="reviews-container">
    <div class="product-info-section">
        <h2 id="orange">Reviews</h2>
        @if($reviews->count() == 0)
            <p>There are no reviews for this product.</p>
        @else
            <p><span id="gold"><b>{{ $reviewAverage }} star</b></span> review on average from {{ $reviewCount }} shoppers.</p>
        @endif

        @if(session('review_success'))
            <p id="form-success">{{ session('review_success') }}</p>
        @endif

        @if($hasLeftReview)
            <br>
            <p>Thank you for leaving a review. Your opinion supports other shoppers make informed decisions! If you have any problems with your review, please do let us know and contact us.</p>
        @endif

        @if($canLeaveReview)
            <br>
            <h3 id="orange">Thanks for buying this product. Leave a review!</h3>
            <p>Please leave your review, with a title and your opinion. Please also choose a rating, with 5 being outstanding and 1 being very poor.</p>
            <br>
            <form class="product-options" action="/reviews/create" method="post">
                @csrf
                <label for="rating">Rating</label>
                <select id="rating" name="rating">
