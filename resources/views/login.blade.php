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
            <form action="/login" method="post">
                @csrf
                <p class="credentials">Enter email</p>
                <input type="email" placeholder="Enter email" name="email" required>

                <p class="credentials">Enter password</p>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit" class="submit-btn">Login</button>
            </form>
        </div>
    </section>

    @include("footer")
</body>
</html>
