
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$stock->category->brand->name}} {{$stock->category->name}} {{$stock->name}} - Crep Culture</title>
    <link rel="stylesheet" href="{{asset('css/productdisplay.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script>
        function onDelete(id) {
            let btn = document.getElementById(id);
            if (btn.innerHTML === "delete") {
                document.getElementById(id + "-form").style.display = "block";
                btn.innerHTML = "cancel";
            } else if (btn.innerHTML === "cancel") {
                document.getElementById(id + "-form").style.display = "none";
                btn.innerHTML = "delete";
            }
        }

        function onEdit(id) {
            let btn = document.getElementById(id);
            if (btn.innerHTML === "edit") {
                document.getElementById(id + "-form").style.display = "block";
                btn.innerHTML = "cancel";
            } else if (btn.innerHTML === "cancel") {
                document.getElementById(id + "-form").style.display = "none";
                btn.innerHTML = "edit";
            }
        }

        function onRestore(id) {
            let btn = document.getElementById(id);
            if (btn.innerHTML === "restore") {
                document.getElementById(id + "-form").style.display = "block";
                btn.innerHTML = "cancel";
            } else if (btn.innerHTML === "cancel") {
                document.getElementById(id + "-form").style.display = "none";
                btn.innerHTML = "restore";
            }
        }
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
        </div>
    </div>
    <div class="price-history-container">
    <h3>Price History</h3>
    <div id="my-chart">
        <div class="y-axis" id="y-axis"></div>
        <table class="charts-css line show-heading" id="price-history">
        <tbody></tbody>
        </table>
    </div>
    <div class="months-labels" id="months-labels"></div>
</div>
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
                        <option value="0"  {{!old('rating') ? 'selected' : ''}} disabled hidden>Choose rating</option>
                        <option value="5" {{old('rating') == 5 ? 'selected' : ''}}>5 stars</option>
                        <option value="4" {{old('rating') == 4 ? 'selected' : ''}}>4 stars</option>
                        <option value="3" {{old('rating') == 3 ? 'selected' : ''}}>3 stars</option>
                        <option value="2" {{old('rating') == 2 ? 'selected' : ''}}>2 stars</option>
                        <option value="1" {{old('rating') == 1 ? 'selected' : ''}}>1 star</option>
                    </select>
                    @error('rating')<p id="form-error">{{ $message }}</p>@enderror

                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Your review title" value="{{old('title') ? old('title') : ""}}">
                    @error('title')<p id="form-error">{{ $message }}</p>@enderror

                    <label for="content">Your review</label>
                    <textarea type="text" id="content" name="content" placeholder="Your review">{{old('content') ? old('content') : ""}}</textarea>
                    @error('content')<p id="form-error">{{ $message }}</p>@enderror

                    <input type="hidden" name="sid" value="{{$stock->id}}" />
                    <button type="submit" class="add-to-cart-btn">Submit Review</button>
                    @error('submit')<p id="form-error">{{ $message }}</p>@enderror
                </form>
            @endif

            @if($reviews->count() != 0) <br>@endif
            @foreach($reviews as $review)
                <div class="review">
                    @if(session('isAdmin') && $review->deleted == 1)
                        <p id="form-error"><b>REVIEW DELETED</b></p>
                    @endif
                    @if(session('isAdmin') && $review->edited == 1)
                        <p id="form-success"><b>REVIEW EDITED</b></p>
                    @endif
                    <h3 id="orange">{{ $review->title }}</h3>
                    <p id="gold"><b>{{ $review->rating }} stars</b></p>
                    <p>by {{ $review->user->name }}</p><br>
                    <p>{{ $review->content }}</p>
                    @if (session('isAdmin'))
                        <br>
                        @if($review->deleted == 0)
                                <p class="link-grey">admin controls: <a id="review-{{$review->rid}}-edit" onclick="onEdit('review-{{$review->rid}}-edit')">edit</a> <a id="review-{{$review->rid}}-delete" onclick="onDelete('review-{{$review->rid}}-delete')">delete</a> | review id #{{ $review->rid }}</p>
                        @else
                                <p class="link-grey">admin controls: <a id="review-{{$review->rid}}-edit" onclick="onEdit('review-{{$review->rid}}-edit')">edit</a> <a id="review-{{$review->rid}}-restore" onclick="onRestore('review-{{$review->rid}}-restore')">restore</a> | review id #{{ $review->rid }}</p>
                        @endif
                        @if($review->deleted == 1)
                            <br>
                            <p><span id="form-error">Deleted by</span> {{ $review->deleter->name }}<span id="form-error"> | Reason:</span> "{{ $review->deleted_reason }}"</p>
                        @endif
                        @if($review->edited == 1)
                            <br>
                            <p><span id="form-success">Edited by</span> {{ $review->editor->name }}<span id="form-success"> | Reason:</span> "{{ $review->edited_reason }}"</p>
                        @endif
                        <div id="review-{{$review->rid}}-edit-form" style="display: none">
                            <br>
                            <form class="product-options" action="/admin/reviews/edit" method="post">
                                @csrf

                                <label for="title">Edit title</label>
                                <input type="text" id="title" name="title" placeholder="Review title" value="{{old('title') ? old('title') : $review->title}}"/>
                                @error('title')<p id="form-error">{{ $message }}</p>@enderror

                                <label for="content">Edit review</label>
                                <textarea type="text" id="content" name="content" placeholder="Review content">{{old('content') ? old('content') : $review->content}}</textarea>
                                @error('content')<p id="form-error">{{ $message }}</p>@enderror

                                <label for="reason">Reason for edit</label>
                                <textarea type="text" id="reason" name="reason" placeholder="Your reason">{{old('reason') ? old('reason') : ""}}</textarea>
                                @error('reason')<p id="form-error">{{ $message }}</p>@enderror

                                <input type="hidden" name="rid" value="{{$review->rid}}" />
                                <button type="submit" class="add-to-cart-btn">Edit Review</button>
                            </form>
                        </div>

                        <div id="review-{{$review->rid}}-delete-form" style="display: none">
                            <br>
                            <form class="product-options" action="/admin/reviews/delete" method="post">
                                @csrf
                                <label for="reason">Reason for deletion</label>
                                <textarea type="text" id="reason" name="reason" placeholder="Your reason">{{old('reason') ? old('reason') : ""}}</textarea>
                                @error('reason')<p id="form-error">{{ $message }}</p>@enderror

                                <input type="hidden" name="rid" value="{{$review->rid}}" />
                                <button type="submit" class="add-to-cart-btn">Delete Review</button>
                            </form>
                        </div>

                        <div id="review-{{$review->rid}}-restore-form" style="display: none">
                            <br>
                            <form class="product-options" action="/admin/reviews/restore" method="post">
                                @csrf

                                <input type="hidden" name="rid" value="{{$review->rid}}" />
                                <button type="submit" class="add-to-cart-btn">Restore Review</button>
                            </form>
                        </div>
                    @endif
                </div>
                <br>
            @endforeach
        </div>

    </div>
</body>
</html>

<style>
    #form-success {
        color: green;
    }

    #form-error {
        color: red;
    }

    #gold {
        color: gold;
    }

    #grey {
        color: grey;
    }

    .link-grey {
        color: grey;

        a {
            text-decoration: underline;
        }

        :hover {
            cursor: pointer;
            color: grey;
            text-decoration-color: gray;
            text-decoration-style: wavy;
        }
    }

    .edit-box {
        display: none;
    }

    .delete-box {
        display: none;
    }
    .price-history-container {
    margin-top: 20px;
    text-align: center;
}
</style>

                            
