

// Fade-in animation for elements when scrolling down on page
document.addEventListener('scroll', () => { //Looks out for scrolling on page
    const products = document.querySelectorAll('.product'); // Elements with .product class
    const scrollPosition = window.scrollY + window.innerHeight; //Calculates current scroll position

    products.forEach((product) => { //Goes through each .product element.
        if (product.offsetTop < scrollPosition) { //Checks if the element is visible
            product.classList.add('fade-in'); //Using fade in class for animations when scrolling
        }
    });
});

// CSS fade-in class
const style = document.createElement('style'); //Creates a style tag
style.innerHTML = `
    .fade-in {
        opacity: 1; 
        transform: translateY(0);
        transition: opacity 0.6s ease, transform 0.6s ease;
    } 
    .product {
        opacity: 0;
        transform: translateY(20px);
    }
`;
//Opacity 1: Makes elements fully visible
//transform: Moves element to original position
//transiiton: animated between opacity and position smoothly
document.head.appendChild(style);
// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup-form");// Gets the element with the given id
    const password = document.getElementById("password");//Grabs input field for password
    const confirmPassword = document.getElementById("confirm-password");//Grabs confirm password field
    const passwordError = document.getElementById("password-error");//Grabs text with the given id for error message

    // Password confirmation check on form submission
    form.addEventListener("submit", function (event) {
        if (password.value !== confirmPassword.value) {//Checks if field and confirm password are different
            event.preventDefault(); // If passwords don't match, it will prevent the form from being submitted
            passwordError.style.display = "block"; // Using block style to display the error message
        } else { //If the passwords are matching
            passwordError.style.display = "none"; // Will not display the error message if the passwords are matching
        }
    });
});


let cartCount = 0; // Tracker for counitng how many items are in the basket, currently set to 0

function updateCartCount() {//To update the items in the basket
    const cartCountElement = document.querySelector('.cart-count');//Gets elements with the given id
    cartCountElement.textContent = cartCount;//cartCount is the value which will be displayed to signify how many items are in the basket
}

// Example: Add an item to the cart
function addToCart() {//Addins item to the cart
    cartCount++; //Adds 1 to the count variable which will signify another item in the basket
    updateCartCount();//Update the visible count of items in the basket and display it
}

addToCart(); // When user adds item to basket this will be called