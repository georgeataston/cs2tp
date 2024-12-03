<!DOCTYPE html> <!-- HTML for making pages-->
<html lang="en"><!-- English as the language -->
<head>
    <meta charset="UTF-8"> <!-- Selecting characterset-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Crep Culture</title><!--Title for the page-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Link to style sheet for UI-->
</head>
<body>
    <!-- Header Section -->
    @include("header")

    <!--Section for the contact form-->
    <section class="contact">
        <div class="contact-content"><!-- Assigns id to use for when styling-->
            <h2>Contact Us</h2><!--Heading-->
            <p>If you have any questions, comments, or just want to say hi, feel free to reach out to us. We'd love to hear from you!</p><!--Sentence for customers asking them to leave us a message-->
            @if (session('success') == "true")
                <p id="form-success">Your request has been submitted successfully! Thank you for contacting us.</p>
            @endif
            <form action="/contact" method="post" class="contact-form"><!--Assigns id and submits data via post method-->
                @csrf
                <label for="name">Name:</label> <!-- Gets name from user-->
                <input type="text" id="name" name="name" value="{{old('name')}}"><!-- Ensures something is entered-->
                @error('name')<p id="form-error">{{ $message }}</p>@enderror

                <label for="email">Email:</label> <!-- Gets email from the user-->
                <input type="text" id="email" name="email" value="{{old('email')}}"><!--Esnures something is entered-->
                @error('email')<p id="form-error">{{ $message }}</p>@enderror

                <label for="message">Message:</label> <!-- Gets the message from the user-->
                <textarea id="message" name="message" rows="5">{{old('message')}}</textarea><!--Ensures something is enetered-->
                @error('message')<p id="form-error">{{ $message }}</p>@enderror

                <button type="submit" class="submit-btn">Send Message</button> <!-- Send message button which is styled using the id-->
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

    #form-success {
        color: green;
    }
</style>
