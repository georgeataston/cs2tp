<header>
    <img src="{{ asset('img/logo.png') }}" alt="Crep Culture Logo"> <!-- The logo for our website-->
    <nav>
        <a href="/">Home</a><!-- Linking the index page with the Home button-->
        <a href="/shop">Shop</a><!-- Linking shop page with the Shop button-->
        <a href="/about">About Us</a><!--Linking about us page with the About Us button-->
        <a href="/contact">Contact</a><!-- Linking contact page with the contact button-->
        @if(session('id') == null)
            <div class="auth-buttons"> <!-- Putting login and sign-up buttons in a class to make it easier for styles to affect all-->
                <a href="/login" class="auth-btn login-btn cta">Login</a> <!-- Link to the login page with login button while assigning buttons in the same class-->
                <a href="/signup" class="auth-btn signup-btn cta">Sign Up</a><!-- Link sign-up button to the sign-up page while being in same class-->
            </div>
        @else
            <div class="auth-buttons"> <!-- Putting login and sign-up buttons in a class to make it easier for styles to affect all-->
                <a href="/account" class="auth-btn login-btn cta">Account</a> <!-- Link to the login page with login button while assigning buttons in the same class-->
                <a href="/logout" class="auth-btn signup-btn cta">Sign Out</a><!-- Link sign-up button to the sign-up page while being in same class-->
            </div>
        @endif
    </nav>

    <!--Class for the basket logo which will by styled and displayed on the home page-->
    <div class="basket">
        <a href="/cart"> <!--Linking to the basket page-->
            <img src="{{ asset('img/cart.png') }}" alt="Basket" /> <!--The basket logo-->
            <span class="cart-count">0</span> <!--Displays number of items in the basket -->
        </a>
    </div>
</header>
