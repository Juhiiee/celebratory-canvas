<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['c_name'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebratory Canvas</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Great+Vibes&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <!--link rel="icon" href="logo.png" type="image/x-icon"-->
    <!--link rel="shortcut icon" href="logo.png" type="image/x-icon"-->

</head>

<>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <a class="navbar-brand" href="#">Celebratory Canvas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto px-4">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Our Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#decorations-themes">Decorations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" title="Logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Background Image Section -->
    <div class="bg-image-section d-flex justify-content-center align-items-center" id="home">
        <div class="content text-center text-white hero-text">

    <p id="p1" class="fade-up">Celebratory Canvas</p>

    <p id="jumcia" class="fade-up delay-1">
        Crafting Moments That Turn Into Lifelong Memories
    </p>

    <a href="#decorations-themes" class="hero-btn fade-up delay-2">
        Explore Decorations
    </a>

</div>
    </div>

    <!-- About us Section -->
    <section id="about" class="about py-5">
        <div class="container">
            <p id="p2">About Us</p>
            <div class="row">
                <div class="col-md-6">
                    <img src="main-imgs/aboutus-img.jpg" class="img-fluid" alt="About Us">
                </div>
                <div class="col-md-6 about-us">
                    <p>Welcome to Celebratory Canvas, your premier destination for exceptional wedding venue
                        decorations. Our expertise lies in creating stunning and personalized decor that transforms any
                        venue into a magical setting for your special day.</p>
                    <p>We specialize exclusively in venue decorations, offering a range of elegant and bespoke solutions
                        tailored to your unique vision. Our team is dedicated to bringing your wedding venue to life
                        with beautiful floral arrangements, sophisticated drapery, and thematic setups that reflect your
                        personal style.</p>
                    <p>At Celebratory Canvas, we understand that every wedding is unique. That's why we work closely
                        with you to ensure that every detail of your venue decoration is perfect. From initial concept
                        to final setup, we handle everything with precision and care to make your celebration truly
                        unforgettable.</p>
                    <p>Thank you for considering us for your wedding venue decorations. We look forward to creating a
                        breathtaking environment that will make your special day even more memorable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-5">
        <div class="container">
            <p id="p2">Our Gallery</p>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img1.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 1">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img4.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 4">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img2.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 2">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img3.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 3">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img5.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 5">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img6.jpg" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 6">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img7.jfif" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 7">
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <img src="gallery-imgs/gallery_img8.jpg" class="img-fluid img-thumbnail gallery-img"
                        alt="Gallery Image 8">
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="gallery.php" class="btn btn-primary">View More</a>
            </div>
        </div>
    </section>

    <!-- Decorations and Themes Section -->
    <section id="decorations-themes" class="py-5">
        <div class="container">
            <p id="p2">Our Decorations & Themes</p>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <a href="wedding.php" class="decor-link">
                        <div class="card">
                            <img src="decor/wedding_decor.jpg" class="card-img" alt="Theme 1">
                            <div class="card-body">
                                <h5 class="card-title">Wedding</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="engagement.php" class="decor-link">
                        <div class="card">
                            <img src="decor/engegment_decor.jpg" class="card-img" alt="Theme 6">
                            <div class="card-body">
                                <h5 class="card-title">Engagement</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="sangeet.php" class="decor-link">
                        <div class="card">
                            <img src="decor/sangeet_decor.jpg" class="card-img" alt="Theme 2">
                            <div class="card-body">
                                <h5 class="card-title">Sangeet</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="haldi.php" class="decor-link">
                        <div class="card">
                            <img src="decor/haldi_decor.jpg" class="card-img" alt="Theme 3">
                            <div class="card-body">
                                <h5 class="card-title">Haldi</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- New row for centering -->
                <div class="col-md-3 mb-4">
                    <a href="mehendi.php" class="decor-link">
                        <div class="card">
                            <img src="decor/mehendi_decor.jpg" class="card-img" alt="Theme 4">
                            <div class="card-body">
                                <h5 class="card-title">Mehendi</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="reception.php" class="decor-link">
                        <div class="card">
                            <img src="decor/reception_decor.jpg" class="card-img" alt="Theme 5">
                            <div class="card-body">
                                <h5 class="card-title">Reception</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section id="reviews" class="reviews py-5">
        <div class="container">
            <p id="p2" class="text-center mb-4">What Our Customers Say</p>
            <div class="row">
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="review">
                        <p class="review-text">"The decorations were absolutely stunning! We couldn't have asked for
                            more."</p>
                        <p class="reviewer"><strong>Rutvi & Kabir</strong></p>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="review">
                        <p class="review-text">"Thank you for making our wedding day so special. The attention to detail
                            was incredible."</p>
                        <p class="reviewer"><strong>Aavni & Het</strong></p>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="review">
                        <p class="review-text">"Everything was perfect! From the flowers to the table settings,
                            everything was just right."</p>
                        <p class="reviewer"><strong>Satvika & Vrund</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="contact py-5">
        <div class="container">
            <p id="p2">Contact Us</p>
            <form action="submit-contact_us.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="c_name" placeholder="Your Name" required
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="c_email" placeholder="Your Email" required
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your Message"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>Email: support@celebratorycanvas.com</p>
                <p>Phone: +91 9824310914, +91 9428348348</p>
            </div>
            <div class="quick-links">
                <a href="index.php#about">About Us</a>
                <a href="index.php#gallery">Gallery</a>
                <a href="index.php#decorations-themes">Decorations</a>
                <a href="index.php#contact">Contact Us</a>
            </div>

            <div class="footer-content">
                <p>&copy; 2024 Celebratory Canvas.</p>
            </div>
        </div>
    </footer>


    <!-- Bootstrap 5.2 JS and dependencies CDN -->
    <!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        const images = [
            'main-imgs/img.jpg',
            'main-imgs/img4.png',
            'main-imgs/img5.jpeg',

        ];

        let currentIndex = 0;
        const section = document.getElementById('home');

        function changeBackground() {
            // Check if the section exists to avoid errors
            if (section) {
                section.style.backgroundImage = `linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('${images[currentIndex]}')`;
                currentIndex = (currentIndex + 1) % images.length;
            }
        }

        // Change every 5 seconds
        setInterval(changeBackground, 5000);

        // Initialize the first image immediately
        changeBackground();
    </script>
</body>

</html>