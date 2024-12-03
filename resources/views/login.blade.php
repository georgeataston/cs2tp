<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    
    @include("header")
    
    <section class="auth-form"><!-- Section for login -->
        <div class="auth-form-content">
            <h2>Login</h2> 

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
</body>
</html>
