<?php
session_start();
include 'header.php';
?>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

<?php include 'topbar.php'; ?>

<div class="content-wrapper">
<div class="container py-5">

<style>

:root{
    --gold:#d4af37;
    --dark:#1f2937;
    --light:#f8f9fa;
}

body{
    background:#f8f9fa;
}

/* Hero Section */

.about-hero{
    background:linear-gradient(
        rgba(0,0,0,.70),
        rgba(0,0,0,.70)
    ),
    url('https://images.unsplash.com/photo-1617038220319-276d3cfab638?auto=format&fit=crop&w=1400&q=80');

    background-size:cover;
    background-position:center;

    border-radius:20px;
    padding:100px 40px;
    text-align:center;
    color:#fff;
    margin-bottom:60px;
}

.about-hero h1{
    font-size:3rem;
    font-weight:700;
    margin-bottom:20px;
}

.about-hero p{
    max-width:900px;
    margin:auto;
    font-size:18px;
    line-height:1.8;
}

/* Section Heading */

.section-title{
    text-align:center;
    color:var(--gold);
    font-weight:700;
    margin-bottom:40px;
}

/* Feature Cards */

.feature-card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;
}

.feature-card:hover{
    transform:translateY(-10px);
}

.feature-card i{
    font-size:50px;
    color:var(--gold);
    margin-bottom:20px;
}

.feature-card h4{
    color:#222;
    font-weight:700;
    margin-bottom:15px;
}

.feature-card p{
    color:#666;
    line-height:1.7;
}

/* Story Section */

.story-card{
    background:#fff;
    border-radius:20px;
    padding:50px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    margin-top:50px;
}

.story-card h2{
    color:var(--gold);
    text-align:center;
    margin-bottom:25px;
    font-weight:700;
}

.story-card p{
    color:#555;
    text-align:center;
    line-height:1.9;
    font-size:17px;
}

/* Contact Card */

.contact-card{
    margin-top:50px;
    background:#fff;
    border-radius:20px;
    padding:40px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.contact-card h3{
    color:var(--gold);
    font-weight:700;
    margin-bottom:20px;
}

.contact-card p{
    color:#444;
    font-size:17px;
}

.contact-card a{
    color:var(--gold);
    text-decoration:none;
    font-weight:600;
}

.contact-card a:hover{
    text-decoration:underline;
}

.btn-gold{
    background:var(--gold);
    color:#fff;
    border:none;
    padding:12px 30px;
    border-radius:50px;
    font-weight:600;
    transition:.3s;
}

.btn-gold:hover{
    background:#b89322;
    color:#fff;
}

/* Mobile */

@media(max-width:768px){

    .about-hero{
        padding:60px 20px;
    }

    .about-hero h1{
        font-size:2rem;
    }

    .story-card{
        padding:30px;
    }

}

</style>

<!-- HERO SECTION -->

<div class="about-hero">

    <h1>✨ About Our Jewelry Store ✨</h1>

    <p>
        Discover timeless elegance and luxury through our exclusive
        jewelry collections. From necklaces and rings to bracelets
        and earrings, every piece is crafted with beauty, precision,
        and passion.
    </p>

</div>

<!-- FEATURES -->

<h2 class="section-title">
    Why Choose Us?
</h2>

<div class="row">

    <div class="col-md-4 mb-4">
        <div class="feature-card">

            <i class="fas fa-gem"></i>

            <h4>Premium Quality</h4>

            <p>
                Every jewelry piece is designed with exceptional
                craftsmanship and premium materials.
            </p>

        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="feature-card">

            <i class="fas fa-shipping-fast"></i>

            <h4>Fast Delivery</h4>

            <p>
                We ensure secure packaging and reliable shipping
                for every order you place.
            </p>

        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="feature-card">

            <i class="fas fa-heart"></i>

            <h4>Customer Satisfaction</h4>

            <p>
                Your happiness is our priority. We provide excellent
                support and a seamless shopping experience.
            </p>

        </div>
    </div>

</div>

<!-- STORY -->

<div class="story-card">

    <h2>Our Story</h2>

    <p>
        Online Jewelry Store was founded with a vision of making
        luxury jewelry accessible to everyone. Inspired by modern
        fashion trends and timeless elegance, we continuously
        introduce stunning collections that celebrate beauty,
        confidence, and special moments in life.
    </p>

</div>

<!-- CONTACT -->

<div class="contact-card">

    <h3>
        <i class="fas fa-phone-alt"></i>
        Contact Us
    </h3>

    <p>
        <strong>Email:</strong><br>
        <a href="mailto:gmali7059@gmail.com">
            gmali7059@gmail.com
        </a>
    </p>

    <br>

    <a href="location.html" class="btn btn-gold">
        <i class="fas fa-map-marker-alt"></i>
        Visit Our Location
    </a>

</div>

</div>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>