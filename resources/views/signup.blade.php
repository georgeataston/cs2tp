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
            <form id="signup-form" action="#" method="post"> <!--Assigns id to the form and submits data via post method-->
                <label for="fName">First Name:</label> <!-- Gets First Name from the user  -->
                <input type="text" id="fName" name="fName" required minlength="3"> <!-- Ensure it is at least 3 characters long-->

                <label for="lName">Last Name:</label> <!-- Gets Last Name from the user -->
                <input type="text" id="Name" name="Name" required minlength="3"> <!-- Ensure it is at least 3 characters long-->

                <label for="email">Email:</label> <!-- Gets the email from the user-->
                <input type="email" id="email" name="email" required><!--Makes sure the fiels does not remain empty-->

                <label for="password">Password:</label> <!-- Gets the password from the user-->
                <input type="password" id="password" name="password" required minlength="8" pattern=".*[!@#$%^&*(),.?\"].*" title="Password should contain at least one special character."> <!-- Ensure it is at leats 8 characters long and has a special character in there too-->
                <label for="cPassword">Confirm Password:</label> <!-- Gets password again from the user-->
                <input type="password" id="cPassword" name="cPassword" required><!--Ensures field has some data in there and not blank-->

                <p id="password-error" style="color: red; display: none;">Passwords do not match.</p> <!-- If the 2 passwords don't match it will tell the user about it with red text-->

                <button type="submit" class="submit-btn">Sign Up</button> <!-- Submit button which is styled using the class name-->
            </form><!-- End of form-->
        </div>
    </section>

    @include("footer")
</body>
</html>
