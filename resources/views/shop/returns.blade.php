<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns Centre - Crep Culture</title>
    <!-- Link to CSS file  -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include('header')

    <section class="auth-form">
        <div class="auth-form-content">
            <h2>Returns Centre</h2>
            @if (session('success'))
                <p id="form-success">{{session('success')}}</p>
                <br>
            @endif

            @if(session('continue'))
                <form action="/returns/finish" method="post">
                    @csrf
                    <p>Order Found! Please choose the following items you would like to return:</p><br>
                    @foreach(session('items') as $item)
                        <input type="checkbox" id="{{$item->id}}" name="item-{{$item->id}}">
                        <label for="item-{{$item->id}}">{{ $item->stock()->category->brand->name . ' ' . $item->stock()->category->name . ' ' . $item->stock()->name . ' (' . $item->size->size . ')'}}</label><br>
                    @endforeach
                    <br><br>
                    <p class="credentials">Please briefly sum-up why you are returning your item(s)</p><br>
                    <textarea name="reason" placeholder="Your reason for returning your item(s)..."></textarea>
                    @error('reason')<p id="form-error">{{ $message }}</p>@enderror


                    <input type="hidden" name="order" value="{{session('order')}}" />
                    <input type="hidden" name="email" value="{{session('email')}}" />

                    <button type="submit" class="submit-btn">Submit Return</button>
                    @error('submit')<p id="form-error">{{ $message }}</p>@enderror
                </form>
            @elseif(session('check'))
                <p>{{ session('checkMessage') }}</p>
                <br>
                <p>Your request contains the following items:</p>
                @foreach(session('items') as $item)
                    <input type="checkbox" id="{{$item->id}}" name="item-{{$item->id}}" disabled>
                    <label for="item-{{$item->id}}">{{ $item->orderItem->stock()->category->brand->name . ' ' . $item->orderItem->stock()->category->name . ' ' . $item->orderItem->stock()->name . ' (' . $item->orderItem->size->size . ') - ' . $item->statusText() }}</label><br>
                @endforeach
                <br>
                <button class="submit-btn" onclick="location.href = '/returns'">Back</button>
            @else
                <form action="/returns/start" method="post">
                    @csrf

                    <p class="credentials">Enter order number</p>
                    <input type="text" placeholder="Enter order number" name="order">
                    @error('order')<p id="form-error">{{ $message }}</p>@enderror

                    <p class="credentials">Enter email</p>
                    <input type="text" placeholder="Enter email" name="email">
                    @error('email')<p id="form-error">{{ $message }}</p>@enderror

                    <button type="submit" class="submit-btn">Find Order</button>
                    @error('submit')<p id="form-error">{{ $message }}</p>@enderror
                </form>
                <br>
                <p>Already submitted a request? Check your return status:</p>
                <br>
                <form action="/returns/check" method="post">
                    @csrf
                    <p class="credentials">Enter reference number</p>
                    <input type="text" placeholder="Enter reference number" name="reference">
                    @error('reference')<p id="form-error">{{ $message }}</p>@enderror

                    <p class="credentials">Enter email</p>
                    <input type="text" placeholder="Enter email" name="email">
                    @error('email')<p id="form-error">{{ $message }}</p>@enderror

                    <button type="submit" class="submit-btn">Check Status</button>
                    @error('status-submit')<p id="form-error">{{ $message }}</p>@enderror
                </form>
            @endif
        </div>
    </section>
    @include('footer')
</body>
</html>

<style>
    #form-error {
        color: red;
    }

    #form-success {
        color: green;
    }

    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    #white-link {
        color: white;
        text-decoration: underline;
    }

    #white-link:visited {
        color: white;
        text-decoration: underline;
    }

    #white-link:hover {
        color: white;
        text-decoration: wavy underline;
    }
</style>
