<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    @include("header")

    <div class="container">
        <h1 class="title">Login to Account</h1>
        <form action="submit" method="post">
            <p class="credentials">Enter email</p>
            <input type="email" placeholder="Enter email" name="email" required>

            <p class="credentials">Enter password</p>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" class="button">Login</button>
        </form>
    </div>

    @include("footer")
</body>
</html>
