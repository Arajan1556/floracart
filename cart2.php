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

// Handle Cart Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($_POST['action'] === 'add') {
        // Check if the product is already in the cart
        $check_cart_query = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
        $check_cart_query->bind_param('ii', $user_id, $product_id);
        $check_cart_query->execute();
        $check_cart_query->store_result();

        if ($check_cart_query->num_rows > 0) {
            $check_cart_query->bind_result($cart_id, $existing_quantity);
            $check_cart_query->fetch();

            // Update quantity
            $new_quantity = $existing_quantity + $quantity;
            $update_query = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $update_query->bind_param('ii', $new_quantity, $cart_id);
            $update_query->execute();
            $update_query->close();
        } else {
            // Insert new product into cart
            $insert_query = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insert_query->bind_param('iii', $user_id, $product_id, $quantity);
            $insert_query->execute();
            $insert_query->close();
        }
        $check_cart_query->close();
    } elseif ($_POST['action'] === 'update') {
        // Update product quantity in the cart
        $update_query = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $update_query->bind_param('iii', $quantity, $user_id, $product_id);
        $update_query->execute();
        $update_query->close();
    } elseif ($_POST['action'] === 'delete') {
        // Remove the product from the cart
        $delete_query = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $delete_query->bind_param('ii', $user_id, $product_id);
        $delete_query->execute();
        $delete_query->close();
    }

    header("Location: cart2.php");
    exit();
}

// Fetch cart items
$cart_query = $conn->prepare("
    SELECT products.id, products.name, products.price, cart.quantity, (products.price * cart.quantity) AS total 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?");
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
                    <img src="Flora-Earth.png" alt="Logo" class="img-logo">
                </div>
                <div class="nav-center pad_left20">
                    <h1 class="site-name head_col">Flora Earth</h1>
                    <ul class="nav-links">
                        <li><a href="index.php" class="colour-text">Home</a></li>
                        <li><a href="about_us.html" class="colour-text">About Us</a></li>
                        <!-- <li><a href="cart1.php" class="colour-text">Cart</a></li> -->
                        <li><a href="productcss.php" class="colour-text">Products</a></li>
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
            </nav>
        </div>
    </header>
    <main>
        <section class="cart">
            <div class="txt-alng">
                <h2 class="colour-text">Your Cart</h2>
            </div>
            <form method="post" action="cart2.php">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php 
    $grand_total = 0;
    while ($item = $cart_items->fetch_assoc()):
        $grand_total += $item['total'];
    ?>
    <tr>
        <td><?php echo htmlspecialchars($item['name']); ?></td>
        <td>$<?php echo htmlspecialchars($item['price']); ?></td>
        <td>
            <form method="post" action="cart2.php" class="update-form">
                <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                <button type="submit">Update</button>
            </form>
        </td>
        <td>$<?php echo htmlspecialchars($item['total']); ?></td>
        <td>
            <form method="post" action="cart2.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                <button type="submit">Remove</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>

                </table>
            </form>
            <div class="cart-summary">
                <p>Total: $<?php echo $grand_total; ?></p>
                <!-- <button class="btn">Update Cart</button> -->
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
    document.getElementById("proceed-btn").addEventListener("click", function () {
        alert("Your product is on the way! Thank you for shopping with us!");
    });
</script>

<?php
$conn->close();
?> on