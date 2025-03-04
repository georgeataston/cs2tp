<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    @include("header")

    <section class="auth-form">
        <div class="auth-form-content">
            <h2>Login to Account</h2>
            @if (session('fail') == "invalidsession")
                <p id="form-error">Please log in to access this page.</p>
                <br>
            @elseif (session('success'))
                <p id="form-success">{{session('success')}}</p>
                <br>
            @endif
            <form action="/login" method="post">
                @csrf
                <p class="credentials">Enter email</p>
                <input type="text" placeholder="Enter email" name="email">
                @error('email')<p id="form-error">{{ $message }}</p>@enderror

                <p class="credentials">Enter password</p>
                <input type="password" placeholder="Enter Password" name="password">
                @error('password')<p id="form-error">{{ $message }}</p>@enderror

                @if (session('redirect'))
                    <input hidden type="text" name="redirect" value="/{{session("redirect")}}">
                @else
                    <input hidden type="text" name="redirect" value="/">
                @endif

                @error('login')<p id="form-error">{{ $message }}</p>@enderror
                <button type="submit" class="submit-btn">Login</button>
            </form>
            <br>
            <p>Forgotten your password? <a id="white-link" href="/recovery">Recover your account.</a></p>
        </div>
    </section>

    @include("footer")
</body>
</html>

<style>
    #form-error {
        color: red;
    }

    #form-success {
        color: green;
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
