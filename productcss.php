<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Flora Earth</title>
    <link rel="stylesheet" href="assets.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .containerz {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
        }
        .site-name {
            font-size: 24px;
            margin: 0;
        }
        .btn {
            background-color: #694270;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #694270;
        }
        .sidebar {
            width: 25%;
            padding: 20px;
            background-color: white;
            border-right: 1px solid #ddd;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .products {
            width: 75%;
            padding: 20px;
            text-align: center;
        }
        .cardz {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .icard {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: left;
            overflow: hidden;
        }
        .icard:hover {
            transform: scale(1.05);
        }
        .icard-img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .icard-content {
            text-align: center; /* Center text inside the card */
        }
        #cart-count {
            margin-left: 10px;
            color: #694270;
        }
        h4 {
            margin: 0;
        }
        /* footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .footer-section {
            width: 22%;
            padding: 10px;
        }
        .footer-section a {
            color: #f1c40f;
            text-decoration: none;
        } */
    </style>
</head>
<body>
<?php
// Start session
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in to add items to your cart.');</script>";
    header("Location: signin.php");
    exit();
}
// echo $_SESSION['email'];

// Database connection
$host = 'localhost';
$db = 'flora_earth';
$user = 'root';
$pass = ''; // Update with your database password if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle "Add to Cart" functionality
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
//     // Ensure the user is logged in
//     if (!isset($_SESSION['username'])) {
//         echo "<script>alert('Please log in to add items to your cart.');</script>";
//     } else {
//         // Get user details and product information
//         $user_id = $_SESSION['username']; // Assuming user ID is stored in the session
//         $product_id = $_POST['product_id'];
//         $quantity = $_POST['quantity'];

//         // Insert into cart
//         $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
//         $stmt->bind_param('iii', $user_id, $product_id, $quantity);

//         if ($stmt->execute()) {
//             echo "<script>alert('Product added to cart!');</script>";
//         } else {
//             echo "<script>alert('Failed to add product to cart.');</script>";
//         }
//         $stmt->close();
//     }
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Ensure the user is logged in
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Please log in to add items to your cart.');</script>";
    } else {
        // Fetch user_id based on username
        $username = $_SESSION['username'];
        $query = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $query->bind_result($user_id);
        $query->fetch();
        $query->close();

        // If user_id is found, proceed
        if ($user_id) {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            // Insert into the cart
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param('iii', $user_id, $product_id, $quantity);

            if ($stmt->execute()) {
                echo "<script>alert('Product added to cart!');</script>";
            } else {
                echo "<script>alert('Failed to add product to cart.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Invalid user session. Please log in again.');</script>";
        }
    }
}

?>

    <header>
        <div class="container colour-text">
            <nav class="navbar">
                <div class="logo">
                    <img src="Flora-Earth.png" alt="Logo" class="img-logo">
                </div>
                <div class="nav-center">
                    <h1 class="site-name head_col">Flora Earth</h1>
                    <ul class="nav-links">
                        <li><a href="index.php" class="colour-text">Home</a></li>
                        <li><a href="about_us.html" class="colour-text">About Us</a></li>
                        <li><a href="productcss.php" class="colour-text">Products</a></li>
                        <li><a href="cart1.php" class="colour-text">Cart</a></li>
                        
                        <!-- <li><a href="gallery.html" class="colour-text">Gallery</a></li> -->
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="containerz">
            <aside class="sidebar">
                <h3>Filter Products</h3>
                <div>
                    <h4>Categories</h4>
                    <ul>
                        <li><input type="checkbox"> Fresh Produce</li>
                        <li><input type="checkbox"> Dairy Products</li>
                        <li><input type="checkbox"> Organic Meat</li>
                        <li><input type="checkbox"> Pantry Staples</li>
                    </ul>
                </div>
                <div>
                    <h4>Price Range</h4>
                    <input type="range" min="0" max="10" value="2.99" id="priceRange">
                    <p>Max Price: $<span id="priceValue">2.99</span></p>
                </div>
            </aside>
          
            <section class="products">
    <h2>Our Products</h2>
    <p>Explore our wide range of organic products, including fresh produce, dairy, meat, and more.</p>
    <div class="cardz">
        <?php
        // Fetch products from the database
        $result = $conn->query("SELECT * FROM products");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='icard'>
                    <img src='images/{$row['image']}' class='icard-img' alt='{$row['name']}'>
                    <div class='icard-content'>
                        <h3>{$row['name']}</h3>
                        <p class='star-rating'>⭐⭐⭐⭐☆</p>
                        <p>\${$row['price']} per item</p>
                        <form method='POST' action=''>
                            <input type='hidden' name='product_id' value='{$row['id']}'>
                            <input type='number' name='quantity' value='1' min='1' class='quantity-input'>
                            <button type='submit' name='add_to_cart' class='btn'>Add to Cart</button>
                        </form>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</section>



        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>About Us</h4>
                <h6>Learn more about Flora Earth and our mission to provide fresh, organic products to our community.</h6>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p><a href="mailto:info@floraearth.com">Email: info@floraearth.com</a></p>
                <p>Phone: (123) 456-7890</p>
                <p>Address: 123 Organic St, Green City, GA</p>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <p><a href="#">Facebook</a></p>
                <p><a href="#">Instagram</a></p>
                <p><a href="#">Twitter</a></p>
            </div>
            <div class="footer-section">
                <h4>Newsletter</h4>
                <p>Subscribe to our newsletter to get the latest updates and offers.</p>
                <input type="email" placeholder="Enter your email">
                <button class="btn">Subscribe</button>
            </div>
        </div>
        <p>© 2024 Flora Earth. All rights reserved.</p>
    </footer>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let cartCount = 0;

            // Add to cart functionality
            $('.add-to-cart').click(function() {
                cartCount++;
                $('#cart-count').text(cartCount);
                alert( 'Item has been added to your cart!');
            });

            // Update price range display
            $('#priceRange').on('input', function() {
                $('#priceValue').text($(this).val());
            });
        });
    </script>
</body>
</html>
