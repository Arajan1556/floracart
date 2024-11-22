<?php
session_start();
$host = 'localhost';
$db = 'flora_earth';
$user = 'root';
$pass = ''; // Your MySQL root password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You must log in to view your cart.";
    header("Location: signin.php");
    exit();
}

// Fetch logged-in user ID
$username = $_SESSION['username'];
$user_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
$user_query->bind_param('s', $username);
$user_query->execute();
$user_query->bind_result($user_id);
$user_query->fetch();
$user_query->close();

// Fetch cart items
$cart_query = $conn->prepare("
    SELECT products.name, products.price, cart.quantity, (products.price * cart.quantity) AS total 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?
");
$cart_query->bind_param('i', $user_id);
$cart_query->execute();
$cart_items = $cart_query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Flora Earth</title>
    <link rel="stylesheet" href="assets.css">
</head>
<body>
    <header>
        <div class="container colour-text">
            <nav class="navbar">
                <div class="logo">
                    <img src="Flora-Earth.png" alt="Logo" class="img-logo"> <!-- Replace with your logo path -->
                </div>
                <div class="nav-center pad_left20">
                    <h1 class="site-name head_col">Flora Earth</h1>
                    <ul class="nav-links">
                        <li><a href="index.php" class="colour-text">Home</a></li>
                        <li><a href="about_us.html" class="colour-text">About Us</a></li>
                        <li><a href="cart1.php" class="colour-text">Cart</a></li>
                        <li><a href="product.html" class="colour-text">Products</a></li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <?php if (isset($_SESSION['username'])): ?>
                        <p class="welcome-msg">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
                        <button class="btn sign-up btn-sigincol"><a href="logout.php" class="">Logout</a></button>
                    <?php else: ?>
                        <button class="btn sign-in btn-sigincol"><a href="signin.php" class="colour">Sign In</a></button>
                        <button class="btn sign-up btn-sigupcol"><a href="signup.php">Sign Up</a></button>
                    <?php endif; ?>
                </div>
                <!-- <div class="nav-buttons">
                    <button class="btn sign-in btn-sigincol"><a href="signin.html" class="colour">Sign In</a></button>
                    <button class="btn sign-up btn-sigupcol"><a href="signup.html">Sign Up</a></button>
                </div> -->
            </nav>
        </div>
    </header>
    <main>
        <section class="cart">
            <div class="txt-alng">
                <h2 class="colour-text">Your Cart</h2>
            </div>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grand_total = 0;
                    while ($item = $cart_items->fetch_assoc()):
                        $grand_total += $item['total'];
                    ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td><input type="number" value="<?php echo $item['quantity']; ?>" min="1"></td>
                        <td>$<?php echo $item['total']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p>Total: $<?php echo $grand_total; ?></p>
                <button class="btn">Update Cart</button>
                <button class="btn" id="proceed-btn">Proceed to Checkout</button>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>About Us</h4>
                <p>Learn more about Flora Earth and our mission to provide fresh, organic products to our community.</p>
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
</body>
</html>
<script>
    // JavaScript to handle the click event
    document.getElementById("proceed-btn").addEventListener("click", function () {
        alert("Your product is on the way! Thank you for shopping with us!");
    });
</script>

<?php
$conn->close();
?>
