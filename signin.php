
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flora Earth - Sign In</title>
    <link rel="stylesheet" href="assets.css">
</head>
<body>
    <header>
        <div class="container colour-text">
            <nav class="navbar">
                <div class="logo">
                    <img src="Flora-Earth.png" alt="Logo" class="img-logo"> <!-- Replace with your logo path -->
                </div>
                <div class="nav-center ">
                    <h1 class="site-name head_col">Flora Earth</h1>
                    <ul class="nav-links">
                        <li><a href="index.php" class="colour-text">Home</a></li>
                        <li><a href="about_us.html" class="colour-text">About Us</a></li>
                        <li><a href="productcss.php" class="colour-text">Products</a></li>
                        <li><a href="#" class="colour-text">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="form-section pad-5">
            <div class="form-container">
                <h2>Sign In</h2>
                <form action="submit_signin.php" method="POST">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- <div class="form-group">
                        <button type="submit" class="btn sign-in btn-sigincol">Sign In</button>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn sign-up btn-sigupcol">Sign In</button>
                    </div>
                </form>
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
