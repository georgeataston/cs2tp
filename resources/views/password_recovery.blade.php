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
            <h2>Password Recovery</h2>
            <p>Please enter your account's e-mail address and a password reset link will be sent to you.</p>
            <br>
            <form action="/recovery" method="post">
                @csrf
                @if (session('error'))
                    <p id="form-error">{{session('error')}}</p>
                    <br>
                @endif
                <p class="credentials">Enter email</p>
                <input type="text" placeholder="Enter email" name="email">
                @error('email')<p id="form-error">{{ $message }}</p>@enderror

                @error('login')<p id="form-error">{{ $message }}</p>@enderror
                <button type="submit" class="submit-btn">Reset Password</button>
                @if (session("success"))
                    <br>
                    <br>
                    <p id="form-success">If an account with that e-mail exists, a password reset link has been sent.</p>
                @endif
            </form>
            <br>
            <p>Don't know your email? <a id="white-link" href="/contact">Contact us.</a></p>
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
