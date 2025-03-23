<!DOCTYPE html><!--Using HTML-->
<html lang="en"><!--English as the language-->
<head>
    <meta charset="UTF-8"><!--Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to stylesheet for CSS-->
</head>
<body>
    <!--About us section-->
    <section class="">
        <div class="about-content"><!-- Id for styling-->
            <h2>Reset Your Password</h2><!--Heading-->
            <p>
                <br>
                Hi {{ $account->name }},
                <br><br>
                If you did not request this password reset, please disregard this e-mail. Your account has not been compromised.
                <br><br>
                To reset your password, <a href="https://{{ env('APP_URL') }}/recovery/{{ $passwordReset->token }}">please click here to create a new password.</a>
                <br><br>
                Can't click? Please paste the following URL into your browser:
                <br>
                https://{{ env('APP_URL') }}/recovery/{{ $passwordReset->token }}
                <br><br>
                This request will expire in 30 minutes. If you require any further assistance please reply to this e-mail.
                <br><br>
                Kind regards,
                <br><br>
                The Crep Culture Team
            </p>
        </div>
    </section>

    @include("footer")
</body>
</html>
