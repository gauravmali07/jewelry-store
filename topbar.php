<nav class="main-header navbar navbar-expand-lg custom-navbar">

    <div class="container">

        <!-- Logo -->

        <a href="./" class="navbar-brand d-flex align-items-center">

            <img src="gs.png"
                 width="55"
                 height="60"
                 class="mr-2 rounded-circle">

            <span class="brand-name">
                Jewellers
            </span>

        </a>

        <!-- Mobile Toggle -->

        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="mainNavbar">

            <!-- Center Menu -->

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a href="./" class="nav-link">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="aboutus.php" class="nav-link">
                        <i class="fa fa-info-circle"></i>
                        About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a href="faq.php" class="nav-link">
                        <i class="fa fa-question-circle"></i>
                        FAQs
                    </a>
                </li>

                <?php if(isset($_SESSION['login_id'])): ?>

                <li class="nav-item">
                    <a href="index.php?page=my_order"
                       class="nav-link">

                        <i class="fa fa-shopping-bag"></i>
                        My Orders

                    </a>
                </li>

                <li class="nav-item">
                    <a href="feedback.php"
                       class="nav-link">

                        <i class="fa fa-comment"></i>
                        Feedback

                    </a>
                </li>

                <?php endif; ?>

            </ul>

            <!-- Right Side -->

            <ul class="navbar-nav ml-auto align-items-center">

                <?php if(!isset($_SESSION['login_id'])): ?>

                <li class="nav-item">

                    <a href="login.php"
                       class="btn btn-gold">

                        <i class="fa fa-sign-in-alt"></i>
                        Sign In

                    </a>

                </li>

                <?php else: ?>

<!-- Cart Menu -->

<li class="nav-item position-relative">

    <a href="javascript:void(0)"
       id="cartBtn"
       class="nav-link cart-link">

        <i class="fa fa-shopping-cart"></i>

        <span class="cart-badge cart-count">
            0
        </span>

        Cart

    </a>

    <!-- Cart Dropdown -->

    <div id="cartDropdown" class="cart-dropdown">

        <!-- Header -->

        <div class="cart-header">

            <i class="fa fa-shopping-bag mr-2"></i>

            Shopping Cart

        </div>

        <!-- Cart Products -->

        <div id="cart_product" class="cart-list">

            <div class="empty-cart">

                <i class="fa fa-shopping-cart fa-2x mb-2"></i>

                <p>No items in cart</p>

            </div>

        </div>

        <!-- Footer -->

        <div class="cart-footer">

            <a href="index.php?page=cart"
               class="btn btn-cart btn-block">

                View Cart

            </a>

        </div>

    </div>

</li>

<style>

  /* Fix Navbar Position */

.custom-navbar{
    position:sticky;
    top:0;
    width:100%;
    z-index:9999;
    background:#fff;
}

.custom-navbar .container{
    max-width:1200px;
    margin:0 auto;
}

/* Prevent logo shifting */

.navbar-brand{
    margin-right:30px !important;
    flex-shrink:0;
}

.brand-name{
    white-space:nowrap;
}

/* Center menu */

.navbar-collapse{
    justify-content:space-between;
}

.navbar-nav.mx-auto{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
}

/* Mobile */

@media(max-width:991px){

    .navbar-nav.mx-auto{
        position:static;
        transform:none;
    }

}

.cart-link{
    position:relative;
    cursor:pointer;
    font-weight:600;
}

.cart-badge{
    position:absolute;
    top:-8px;
    right:-10px;
    width:18px;
    height:18px;
    border-radius:50%;
    background:#d4af37;
    color:#fff;
    font-size:10px;
    text-align:center;
    line-height:18px;
}

/* Dropdown */

.cart-dropdown{
    display:none;
    position:absolute;
    right:0;
    top:100%;
    width:350px;
    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    z-index:9999;
}





.cart-dropdown.show{
    display:block;
}

/* Header */

.cart-header{
    background:#d4af37;
    color:#fff;
    padding:15px;
    text-align:center;
    font-weight:600;
}

/* Cart Items */

.cart-list{
    max-height:300px;
    overflow-y:auto;
}

/* Prevent Huge Images */

.cart-list img{
    width:60px !important;
    height:60px !important;
    object-fit:cover;
    border-radius:8px;
}

/* Footer */

.cart-footer{
    padding:12px;
    background:#f8f9fa;
}

.btn-cart{
    background:#d4af37;
    color:#fff;
    border:none;
    border-radius:30px;
    font-weight:600;
}

.btn-cart:hover{
    background:#b89322;
    color:#fff;
}

.empty-cart{
    text-align:center;
    padding:25px;
    color:#999;
}

</style>

<script>

$(document).ready(function(){

    $('#cartBtn').click(function(e){

        e.stopPropagation();

        $('#cartDropdown').toggleClass('show');

    });

    $(document).click(function(){

        $('#cartDropdown').removeClass('show');

    });

    $('#cartDropdown').click(function(e){

        e.stopPropagation();

    });

});

</script>

                <!-- User -->

                <li class="nav-item dropdown">

                    <a href="#"
                       class="nav-link"
                       data-toggle="dropdown">

                        <i class="fa fa-user-circle"></i>

                        <?php echo ucwords($_SESSION['login_firstname']) ?>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item"
                           href="signup.php">

                            <i class="fa fa-cog"></i>
                            Manage Account

                        </a>

                        <a class="dropdown-item"
                           href="admin/ajax.php?action=logout2">

                            <i class="fa fa-power-off"></i>
                            Logout

                        </a>

                    </div>

                </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

.custom-navbar{
    background:#fff;
    border-bottom:2px solid var(--gold);
    padding:10px 0;
}

.brand-name{
    font-size:2rem;
    font-weight:700;
    color:var(--gold);
    white-space:nowrap;
}

.navbar-nav{
    align-items:center;
}

.nav-link{
    color:#2c3e50 !important;
    font-size:18px;
    font-weight:600;
    white-space:nowrap;
    margin:0 10px;
}

.nav-link:hover{
    color:var(--gold) !important;
}

.nav-link i{
    margin-right:6px;
}

.btn-gold{
    background:var(--gold);
    color:#fff !important;
    border-radius:30px;
    padding:10px 22px;
    font-weight:600;
}

.btn-gold:hover{
    background:var(--gold-dark);
}

.cart-link{
    position:relative;
}

.cart-badge{
    position:absolute;
    top:-8px;
    right:-10px;
    background:var(--gold);
    color:#fff;
    width:20px;
    height:20px;
    border-radius:50%;
    text-align:center;
    line-height:20px;
    font-size:11px;
}

.cart-dropdown{
    width:350px;
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.cart-title{
    background:var(--gold);
    color:#fff;
    text-align:center;
    padding:15px;
    font-weight:600;
}

.cart-list{
    max-height:320px;
    overflow-y:auto;
}

.cart-footer{
    padding:10px;
    background:#f8f9fa;
}

@media(max-width:1200px){

    .brand-name{
        font-size:1.5rem;
    }

    .nav-link{
        font-size:16px;
        margin:0 5px;
    }

}

</style>