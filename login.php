<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

/* Background */

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(
        rgba(0,0,0,.75),
        rgba(0,0,0,.75)
    ),
    url('https://images.unsplash.com/photo-1617038220319-276d3cfab638');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    padding:20px;
}

/* Container */

.login-container{
    width:100%;
    max-width:450px;
}

/* Logo */

.login-logo{
    text-align:center;
    margin-bottom:25px;
}

.login-logo h1{
    color:var(--gold);
    font-size:32px;
    font-weight:700;
}

.login-logo p{
    color:#fff;
    margin-top:8px;
}

/* Login Card */

.login-card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:20px;
    padding:40px;
    box-shadow:0 15px 35px rgba(0,0,0,.3);
}

/* Title */

.login-title{
    color:#fff;
    text-align:center;
    font-size:26px;
    font-weight:700;
    margin-bottom:25px;
}

/* Input */

.form-control{
    height:52px;
    background:rgba(255,255,255,0.12) !important;
    border:1px solid rgba(255,255,255,0.25);
    border-radius:12px;
    color:#fff !important;
}

.form-control::placeholder{
    color:rgba(255,255,255,.7) !important;
}

.form-control:focus{
    background:rgba(255,255,255,0.15) !important;
    color:#fff !important;
    border-color:var(--gold);
    box-shadow:0 0 12px rgba(212,175,55,.4);
}

/* Autofill */

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus{
    -webkit-text-fill-color:#fff !important;
    transition:background-color 5000s ease-in-out 0s;
}

/* Icons */

.input-group-text{
    background:var(--gold);
    color:#fff;
    border:none;
}

/* Button */

.btn-login{
    background:var(--gold);
    color:#fff;
    border:none;
    border-radius:50px;
    padding:12px;
    font-weight:600;
    transition:.3s;
}

.btn-login:hover{
    background:var(--gold-dark);
    color:#fff;
}

/* Alert */

.alert-danger{
    background:rgba(255,0,0,.2);
    color:#fff;
    border:none;
    border-radius:10px;
}

/* Link */

.register-link{
    text-align:center;
    margin-top:20px;
}

.register-link a{
    color:var(--gold);
    text-decoration:none;
    font-weight:600;
}

.register-link a:hover{
    text-decoration:underline;
}

/* Mobile */

@media(max-width:768px){

    .login-card{
        padding:25px;
    }

    .login-logo h1{
        font-size:24px;
    }

}

</style>

<div class="login-container">

    <div class="login-logo">
        <h1>Online Jewelry Store</h1>
        <p>Welcome Back</p>
    </div>

    <div class="login-card">

        <h3 class="login-title">
            Sign In To Your Account
        </h3>

        <form id="login-form">

            <div class="input-group mb-3">

                <input type="email"
                       class="form-control"
                       name="email"
                       placeholder="Enter Email Address"
                       required>

                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>

            </div>

            <div class="input-group mb-4">

                <input type="password"
                       class="form-control"
                       name="password"
                       placeholder="Enter Password"
                       required>

                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>

            </div>

            <button type="submit"
                    class="btn btn-login btn-block">

                <i class="fas fa-sign-in-alt"></i>
                Sign In

            </button>

        </form>

        <div class="register-link">
            <a href="signup.php">
                Don't have an account? Create Account
            </a>
        </div>

    </div>

</div>

<script>
$(document).ready(function(){

    $('#login-form').submit(function(e){

        e.preventDefault();

        start_load();

        $('.alert-danger').remove();

        $.ajax({
            url:'admin/ajax.php?action=login2',
            method:'POST',
            data:$(this).serialize(),

            error:function(err){
                console.log(err);
                end_load();
            },

            success:function(resp){

                if(resp == 1){

                    location.href='index.php?page=home';

                }else{

                    $('#login-form').prepend(
                        '<div class="alert alert-danger mb-3">Invalid Email or Password.</div>'
                    );

                    end_load();
                }
            }
        });

    });

});
</script>

<?php include 'footer.php'; ?>

</body>
</html>