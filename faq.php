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
    --dark:#222;
    --light:#f8f9fa;
}

body{
    background:#f8f9fa;
}

/* Hero Section */

.faq-header{
    background:linear-gradient(
        rgba(0,0,0,.75),
        rgba(0,0,0,.75)
    );
    border-radius:20px;
    padding:80px 30px;
    text-align:center;
    color:white;
    margin-bottom:50px;
}

.faq-header h1{
    font-size:3rem;
    font-weight:700;
    color:#d4af37;
}

.faq-header p{
    margin-top:15px;
    font-size:18px;
}

/* FAQ Cards */

.faq-container{
    max-width:1000px;
    margin:auto;
}

.accordion{
    background:#fff;
    color:#222;
    cursor:pointer;
    padding:20px;
    width:100%;
    border:none;
    text-align:left;
    outline:none;
    font-size:17px;
    font-weight:600;
    margin-bottom:10px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.3s;
}

.accordion:hover,
.accordion.active{
    background:#d4af37;
    color:#fff;
}

.panel{
    display:none;
    background:#fff;
    padding:20px;
    margin-top:-5px;
    margin-bottom:15px;
    border-radius:0 0 12px 12px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    color:#555;
    line-height:1.8;
}

.panel p{
    margin:0;
}

/* Mobile */

@media(max-width:768px){

    .faq-header{
        padding:50px 20px;
    }

    .faq-header h1{
        font-size:2rem;
    }

    .accordion{
        font-size:15px;
    }

}

</style>

<!-- Header -->

<div class="faq-header">

    <h1>Frequently Asked Questions</h1>

    <p>
        Find answers to the most commonly asked questions about our jewelry store.
    </p>

</div>

<div class="faq-container">

<button class="accordion">
1. What is the process of placing an order?
</button>
<div class="panel">
<p>
Browse our collection, select your preferred jewelry,
add it to your cart, and complete the checkout process.
Custom jewelry orders can also be discussed based on your requirements.
</p>
</div>

<button class="accordion">
2. Can I place an order directly on your webstore?
</button>
<div class="panel">
<p>
Yes. You can browse products, add them to your cart,
and securely place orders online.
</p>
</div>

<button class="accordion">
3. What services do you offer?
</button>
<div class="panel">
<p>
• Buying and selling jewelry<br>
• Gold and silver collections<br>
• Category-wise product browsing<br>
• Custom jewelry designs<br>
• Jewelry evaluation services
</p>
</div>

<button class="accordion">
4. Do you offer repair services?
</button>
<div class="panel">
<p>
Currently, we do not provide jewelry repair services.
</p>
</div>

<button class="accordion">
5. What metals do you work with?
</button>
<div class="panel">
<p>
We work with Gold, Silver, and selected mixed-metal designs.
</p>
</div>

<button class="accordion">
6. Why is your jewelry collection limited?
</button>
<div class="panel">
<p>
We focus on carefully selected and exclusive jewelry collections
to maintain quality and uniqueness.
</p>
</div>

<button class="accordion">
7. How long does it take to complete a custom jewelry order?
</button>
<div class="panel">
<p>
Delivery time depends on design complexity, but we always
provide a reasonable estimated completion date.
</p>
</div>

<button class="accordion">
8. Can I see a sample before final completion?
</button>
<div class="panel">
<p>
Yes. We can provide previews or design references before
finalizing custom jewelry orders.
</p>
</div>

<button class="accordion">
9. What if I am unhappy with the final jewelry piece?
</button>
<div class="panel">
<p>
Customer satisfaction is important to us. We will review
your concerns and discuss possible solutions.
</p>
</div>

<button class="accordion">
10. Do you offer gold savings schemes?
</button>
<div class="panel">
<p>
Currently, we do not offer gold savings plans.
</p>
</div>

</div>

<script>

var acc = document.getElementsByClassName("accordion");

for (var i = 0; i < acc.length; i++) {

    acc[i].addEventListener("click", function() {

        this.classList.toggle("active");

        var panel = this.nextElementSibling;

        if(panel.style.display === "block"){
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }

    });

}

</script>

</div>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>
