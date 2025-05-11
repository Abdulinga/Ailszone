// Interactivity for switching between login and register forms
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const showLoginBtn = document.getElementById("show-login");
    const showRegisterBtn = document.getElementById("show-register");

    showLoginBtn.addEventListener("click", () => {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    });

    showRegisterBtn.addEventListener("click", () => {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    });
});

// Add-to-cart functionality (example)
function addToCart(productId) {
    // Example of adding an item to the cart (expand as needed)
    alert(`Product with ID ${productId} added to the cart!`);
}

// Profile picture preview
function previewProfilePicture(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById("profile-pic-preview");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
// Drag functionality for floating cart
const cart = document.getElementById('floating-cart');
cart.addEventListener('dragstart', (e) => {
    e.dataTransfer.setData("text/plain", "");
});

cart.addEventListener('dragend', (e) => {
    cart.style.left = e.pageX + 'px';
    cart.style.top = e.pageY + 'px';
    cart.style.right = 'auto';
    cart.style.bottom = 'auto';
});
