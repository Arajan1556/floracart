<?php
session_start(); // Start the session to access session variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flora Earth</title>
    <link rel="stylesheet" href="assets.css">
</head>
<body>
    <header>
        <div class="container colour-text">
            <nav class="navbar" >
                <div class="logo">
                    <img src="Flora-Earth.png" alt="Logo" class="img-logo"> <!-- Replace with your logo path -->
                </div>
                <div class="nav-center pad_left20" >
                    <h1 class="site-name  head_col">Flora Earth</h1>
                    <ul class="nav-links">
                        <li><a href="about_us.html" class="colour-text">About Us</a></li>
                        <li><a href="productcss.php" class="colour-text">Product</a></li>
                        <li><a href="cart1.php" class="colour-text">Cart</a></li>
                        
                        <!-- <li><a href="#" class="colour-text">Gallery</a></li> -->
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
                    <button class="btn sign-in btn-sigincol"><a href="signin.php" class="colour">Sign In</a></button>
                    <button class="btn sign-up btn-sigupcol"><a href="signup.php">Sign Up</a></button>
                </div> -->
            </nav>
        </div>
    </header>
    <main>
        <section class="banner bck_imgh">
            <div class="pad-top25">
                <h1>Welcome to Flora Earth</h1>
                <p>Explore our world of organic products.</p>
            </div>
        </section>
        <div class="txt-alng">
            <h2 class="colour-text">Why Flora Earth?</h2>
        </div>
        <section class="cards card-pad">
            <div class="card">
                <img src="picky.png" class="card-img">
                <h3 class="txt-alng">Get picky</h3>
                <p class="txt-alng">Choose from the best local organic produce, pantry staples, sustainable meat, seafood and more!</p>
            </div>
            <div class="card">
                <img src="delivery.png" class="card-img">
                <h3 class="txt-alng">Enjoy flexible delivery</h3>
                <p class="txt-alng">Choose your preferred delivery day in the GTA or opt for multiple deliveries in a week</p>
            </div>
            <div class="card">
                <img src="woman.png" class="card-img">
                <h3 class="txt-alng">Unbox, eat, repeat</h3>
                <p class="txt-alng">Enjoy Earth-approved reusable packaging and the convenience of subscription options to boot</p>
            </div>
            <div class="card">
                <img src="make.png" class="card-img">
                <h3 class="txt-alng">Make an impact</h3>
                <p class="txt-alng">Reduce food waste and support local donations to hunger-fighting organizations</p>
            </div>
        </section>
        
        <!-- PRODUCT Sections -->
        <section class="products">
            <div class="txt-alng">
                <h2 class="colour-text">Our Products</h2>
                <p>Explore our wide range of organic products, including fresh produce, dairy, meat, and more.</p>
            </div>
            <div class="cards card-pad">
                <div class="card">
                    <img src="fresh-produce.jpg" class="card-img">
                    <h3 class="txt-alng">Fresh Produce</h3>
                </div>
                <div class="card">
                    <img src="dairy-products.jpg" class="card-img">
                    <h3 class="txt-alng">Dairy Products</h3>
                </div>
                <div class="card">
                    <img src="organic-meat.jpg" class="card-img">
                    <h3 class="txt-alng">Organic Meat</h3>
                </div>
                <div class="card">
                    <img src="pantry-staples.jpg" class="card-img">
                    <h3 class="txt-alng">Pantry Staples</h3>
                </div>
            </div>
            
        </section>
      

        <!-- <section class="testimonials">
            <div class="txt-alng">
                <h2 class="colour-text">Customer Testimonials</h2>
                <p>See what our satisfied customers have to say about our organic products.</p>
            </div>
            <div class="cards card-pad">
                <div class="card">
                    <p class="txt-alng">"Flora Earth has the best organic products. I love the freshness and quality!" - Jane Doe</p>
                </div>
                <div class="card">
                    <p class="txt-alng">"Amazing service and top-notch products. Highly recommended!" - John Smith</p>
                </div>
                <div class="card">
                    <p class="txt-alng">"The flexible delivery options make my life so much easier." - Sarah Lee</p>
                </div>
            </div>
        </section> -->
        <section class="testimonials">
    <div class="txt-alng">
        <h2 class="colour-text">Customer Testimonials</h2>
        <p>See what our satisfied customers have to say about our organic products.</p>
    </div>
    <div class="cards card-pad">
        <div class="card">
            <div class="customer-info">
                <img src="team_member1.jpg" alt="Jane Doe" class="customer-image ">
                <p class="customer-name">Jane Doe</p>
                <div class="rating">
                    <span>⭐️⭐️⭐️⭐️⭐️</span>
                </div>
            </div>
            <p class="txt-alng">"Flora Earth has the best organic products. I love the freshness and quality!"</p>
        </div>
        <div class="card">
            <div class="customer-info">
                <img src="team_member2.jpg" alt="John Smith" class="customer-image ">
                <p class="customer-name">John Smith</p>
                <div class="rating">
                    <span>⭐️⭐️⭐️⭐️⭐️</span>
                </div>
            </div>
            <p class="txt-alng">"Amazing service and top-notch products. Highly recommended!"</p>
        </div>
        <div class="card">
            <div class="customer-info">
                <img src="team_member3.jpg" alt="Sarah Lee" class="customer-image">
                <p class="customer-name">Sarah Lee</p>
                <div class="rating">
                    <span>⭐️⭐️⭐️⭐️⭐️</span>
                </div>
            </div>
            <p class="txt-alng">"The flexible delivery options make my life so much easier."</p>
        </div>
    </div>
</section>


        <section class="video">
            <div class="txt-alng">
                <h2 class="colour-text">Discover Organic Living</h2>
                <p>Watch our video to learn more about the benefits of organic living and how Flora Earth supports a healthy lifestyle.</p>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/lRyXlvIJFWI" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; 
                    encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <!-- <video controls>
                    <source src="organic-living.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video> -->
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
