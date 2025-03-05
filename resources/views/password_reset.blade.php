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
            <p>Please enter your new password twice below. Your password will then be reset.</p>
            <br>
            <form action="/recovery/reset" method="post">
                @csrf
                <p class="credentials">Enter new password</p>
                <input type="password" name="password">
                @error('password')<p id="form-error">{{ $message }}</p>@enderror

                <p class="credentials">Repeat new password</p>
                <input type="password" name="repeat_password">
                @error('repeat_password')<p id="form-error">{{ $message }}</p>@enderror

                <input type="text" name="token" value="{{$token}}" hidden="hidden"/>

                @error('submit')<p id="form-error">{{ $message }}</p>@enderror
                <button type="submit" class="submit-btn">Reset Password</button>
                @if (session("success"))
                    <p id="form-success">If an account with that e-mail exists, a password reset link has been sent.</p>
                @endif
            </form>
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
</style>
