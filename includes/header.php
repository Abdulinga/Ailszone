<?php
// Start the session to check user login status
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ailszone</title>
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Link to the CSS -->
    <script src="../assets/js/script.js" defer></script> <!-- Link to JavaScript -->
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">
                <a href="../index.php" class="logo">
                    <img src="../assets/images/logo.png" height="100px" width="100px" style="border-radius:50%;" alt="AilsZone Logo">
                </a>
            </div>

            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <ul class="nav-links">
                <li><a href="/ailszone/pages/home.php">Home</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="../admin/dashboard.php">Admin Dashboard</a></li>
                        <li><a href="../admin/manage_products.php">Manage Products</a></li>
                        <li><a href="../admin/add_product.php">Add Products</a></li>
                        <li><a href="../admin/add_sellers.php">Add Sellers</a></li>
                        <li><a href="../admin/manage-sellers.php">Manage Sellers</a></li>
                    <?php elseif ($_SESSION['role'] === 'user'): ?>
                        <li><a href="../pages/cart.php">Cart</a></li>
                        <li><a href="../pages/profile.php">Profile</a></li>
                    <?php endif; ?>
                    <li><a href="/ailszone/pages/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="/ailszone/pages/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Floating Cart Icon as a Link -->
    <a href="../pages/cart.php" id="floating-cart" title="Go to Cart 🛒">
        🛒
    </a>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header Styles */
        header {
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Logo Styles */
        .logo a {
            text-decoration: none;
            color: #34495e;
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 2px;
            transition: color 0.3s ease;
        }

        .logo a:hover {
            color: #007bff;
        }

        /* Navigation Links Styles */
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .nav-links li a {
            color: #34495e;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-links li a:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Responsive Menu for Mobile */
        .nav-toggle {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        .nav-toggle .bar {
            width: 25px;
            height: 3px;
            background-color: #34495e;
            border-radius: 5px;
        }

        .nav-links.show {
            display: flex;
            flex-direction: column;
            background-color: #34495e;
            position: absolute;
            top: 60px;
            right: 0;
            width: 100%;
            height: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Floating Cart Icon */
        #floating-cart {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 20px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove underline */
        }

        #floating-cart:hover {
            background-color: #0056b3;
        }

        /* Media Query for Mobile */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                align-items: center;
                background-color: #34495e;
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                height: auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li a {
                font-size: 1.2rem;
                padding: 12px 20px;
            }

            .nav-toggle {
                display: flex;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navLinks = document.querySelector(".nav-links");
            const toggleButton = document.querySelector(".nav-toggle");

            if (toggleButton) {
                toggleButton.addEventListener("click", () => {
                    navLinks.classList.toggle("show");
                });
            }
        });
    </script>

</body>
</html>
