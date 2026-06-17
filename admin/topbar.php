<!-- =========================
     ADMIN TOPBAR
========================= -->

<nav class="main-header navbar navbar-expand navbar-dark custom-navbar">

    <!-- Left Side -->

    <ul class="navbar-nav align-items-center">

        <?php if(isset($_SESSION['login_id'])): ?>

        <li class="nav-item">

            <a class="nav-link menu-btn"
               data-widget="pushmenu"
               href="#"
               role="button">

                <i class="fas fa-bars"></i>

            </a>

        </li>

        <?php endif; ?>

        <li class="nav-item">

            <a href="./"
               class="navbar-brand d-flex align-items-center">

                <img src="gs.png"
                     alt="Logo"
                     class="brand-logo">

                <div class="brand-content">

                    <span class="brand-title">
                        Online Jewelry
                    </span>

                    <small class="brand-subtitle">
                        Admin Dashboard
                    </small>

                </div>

            </a>

        </li>

    </ul>

    <!-- Right Side -->

    <ul class="navbar-nav ml-auto align-items-center">

        <?php if(isset($_SESSION['login_id'])): ?>

        <li class="nav-item">

            <span class="admin-badge">

                <i class="fas fa-user-shield"></i>

                Admin

            </span>

        </li>

        <?php endif; ?>

        <li class="nav-item">

            <a class="nav-link fullscreen-btn"
               data-widget="fullscreen"
               href="#"
               role="button">

                <i class="fas fa-expand-arrows-alt"></i>

            </a>

        </li>

    </ul>

</nav>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
    --dark:#1f2937;
}

/* Navbar */

.custom-navbar{
    background:var(--dark) !important;
    border-bottom:3px solid var(--gold);
    min-height:75px;
    padding:0 20px;
    box-shadow:0 4px 15px rgba(0,0,0,.15);
}

/* Brand */

.navbar-brand{
    text-decoration:none !important;
}

.brand-logo{
    width:50px;
    height:50px;
    border-radius:50%;
    border:2px solid var(--gold);
    padding:2px;
    margin-right:12px;
}

.brand-content{
    display:flex;
    flex-direction:column;
}

.brand-title{
    color:#fff;
    font-size:22px;
    font-weight:700;
    line-height:1;
}

.brand-subtitle{
    color:#d1d5db;
    font-size:12px;
}

/* Menu Button */

.menu-btn,
.fullscreen-btn{
    color:#fff !important;
    font-size:18px;
    transition:.3s;
}

.menu-btn:hover,
.fullscreen-btn:hover{
    color:var(--gold) !important;
}

/* Admin Badge */

.admin-badge{
    background:var(--gold);
    color:#fff;
    padding:8px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
    margin-right:15px;
}

/* Mobile */

@media(max-width:768px){

    .brand-title{
        font-size:16px;
    }

    .brand-subtitle{
        display:none;
    }

    .brand-logo{
        width:40px;
        height:40px;
    }

    .admin-badge{
        display:none;
    }

}

</style>