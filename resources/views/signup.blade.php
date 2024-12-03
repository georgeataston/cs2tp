<!DOCTYPE html> <!--Using HTML-->
<html lang="en"><!--English as the language-->
<head>
    <meta charset="UTF-8"> <!--Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Crep Culture</title><!--Page title-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to style sheet for UI-->
    <script src="{{ asset('js/script.js') }} }}" defer></script> <!-- Link to the javascript page for the needed validation-->
</head>
<body>
    @include("header")

    <section class="auth-form"><!-- Section for creating account-->
        <div class="auth-form-content"><!--Fields for creating account using User input-->
            <h2>Create a New Account</h2> <!-- Displays to user about creating a new account-->
            <form id="signup-form" action="/register" method="post"> <!--Assigns id to the form and submits data via post method-->
                @csrf
                <label for="fName">Full Name:</label> <!-- Gets First Name from the user  -->
                <input type="text" id="fName" name="fName" value="{{old('fName')}}" >
                @error('fName')<p id="form-error">{{ $message }}</p>@enderror

                <label for="email">Email:</label> <!-- Gets the email from the user-->
                <input type="email" id="email" name="email" value="{{old('email')}}" >
                @error('email')<p id="form-error">{{ $message }}</p>@enderror

                <label for="password">Password:</label> <!-- Gets the password from the user-->
                <input type="password" id="password" name="password">
                @error('password')<p id="form-error">{{ $message }}</p>@enderror

                <label for="cPassword">Confirm Password:</label> <!-- Gets password again from the user-->
                <input type="password" id="cPassword" name="cPassword" >

                <!-- If the 2 passwords don't match it will tell the user about it with red text-->
                @error('cPassword')<p id="password-error">{{ $message }}</p>@enderror
                <button type="submit" class="submit-btn">Sign Up</button> <!-- Submit button which is styled using the class name-->
            </form><!-- End of form-->
        </div>
    </section>

    @include("footer")
</body>
</html>

<style>
    #form-error {
        color: red;
    }

    #password-error {
        color: red;
    }
</style>
