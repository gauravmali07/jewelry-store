<?php
session_start();
include 'header.php';
include('admin/db_connect.php');

if(isset($_SESSION['login_id'])){
    $qry = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['login_id']}");
    foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<body>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

/* Background */

body{
    min-height:100vh;
    background:linear-gradient(
        rgba(0,0,0,.75),
        rgba(0,0,0,.75)
    ),
    url('https://images.unsplash.com/photo-1617038220319-276d3cfab638');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    padding:40px 15px;
}

/* Container */

.register-container{
    width:100%;
    max-width:1000px;
    margin:auto;
}

/* Logo */

.logo{
    text-align:center;
    margin-bottom:25px;
}

.logo h1{
    color:#d4af37;
    font-size:32px;
    font-weight:700;
}

.logo p{
    color:#ffffff;
    font-size:15px;
}

/* Glass Card */

.register-card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:20px;
    padding:40px;
    box-shadow:0 15px 35px rgba(0,0,0,.3);
}

/* Title */

.register-title{
    color:#ffffff;
    text-align:center;
    font-size:28px;
    font-weight:700;
    margin-bottom:30px;
}

/* Inputs */

.form-control{
    background:rgba(255,255,255,0.12) !important;
    border:1px solid rgba(255,255,255,0.20);
    color:#ffffff !important;
    border-radius:12px;
    height:50px;
}

textarea.form-control{
    height:120px;
    resize:none;
}

/* Placeholder */

.form-control::placeholder{
    color:rgba(255,255,255,.75) !important;
}

/* Focus */

.form-control:focus{
    background:rgba(255,255,255,0.15) !important;
    color:#ffffff !important;
    border-color:#d4af37;
    box-shadow:0 0 12px rgba(212,175,55,.4);
}

/* Autofill */

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill{
    -webkit-text-fill-color:#ffffff !important;
    transition:background-color 5000s ease-in-out 0s;
}

/* Icons */

.input-group-text{
    background:#d4af37;
    color:#ffffff;
    border:none;
}

/* Button */

.btn-register,
.btn-primary{
    background:#d4af37 !important;
    border:none !important;
    color:#ffffff !important;
    height:50px;
    border-radius:50px;
    font-weight:600;
    transition:.3s;
}

.btn-register:hover,
.btn-primary:hover{
    background:#b89322 !important;
}

/* Password Match */

#pass_match{
    display:block;
    margin-top:5px;
    margin-bottom:15px;
    font-size:14px;
}

/* Messages */

#msg{
    color:#ffbdbd;
}

/* Login Link */

.login-link{
    text-align:center;
    margin-top:20px;
}

.login-link a{
    color:#d4af37;
    text-decoration:none;
    font-weight:600;
}

.login-link a:hover{
    text-decoration:underline;
}

/* Mobile */

@media(max-width:768px){

    .register-card{
        padding:25px;
    }

    .logo h1{
        font-size:24px;
    }

    .register-title{
        font-size:22px;
    }

}

</style>

<div class="register-container">

    <div class="logo">
        <h1>Online Jewelry Store</h1>
        <p>Create your account and start shopping</p>
    </div>

    <div class="register-card">

        <h2 class="register-title">
            <?php echo !isset($id) ? 'Create Account' : 'Manage Account'; ?>
        </h2>

        <form id="manage-signup">

            <input type="hidden"
                   name="id"
                   value="<?php echo isset($id)?$id:'' ?>">

            <div class="row">

                <div class="col-md-6">

                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               name="firstname"
                               required
                               placeholder="First Name"
                               value="<?php echo isset($firstname)?$firstname:'' ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               name="middlename"
                               placeholder="Middle Name"
                               value="<?php echo isset($middlename)?$middlename:'' ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               name="lastname"
                               required
                               placeholder="Last Name"
                               value="<?php echo isset($lastname)?$lastname:'' ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               name="contact"
                               required
                               placeholder="Mobile Number"
                               value="<?php echo isset($contact)?$contact:'' ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                    </div>

                    <textarea class="form-control mb-3"
                              name="address"
                              required
                              placeholder="Address"><?php echo isset($address)?$address:'' ?></textarea>

                </div>

                <div class="col-md-6">

                    <div class="input-group mb-3">
                        <input type="email"
                               class="form-control"
                               name="email"
                               required
                               placeholder="Email Address"
                               value="<?php echo isset($email)?$email:'' ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <small id="msg"></small>

                    <div class="input-group mb-3">
                        <input type="password"
                               class="form-control"
                               name="password"
                               <?php echo isset($id)?'':'required'; ?>
                               placeholder="Password">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password"
                               class="form-control"
                               name="cpass"
                               <?php echo isset($id)?'':'required'; ?>
                               placeholder="Confirm Password">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>

                    <small id="pass_match" data-status=""></small>

                    <button type="submit"
                            class="btn btn-register btn-block">

                        <?php echo !isset($id)
                        ? 'Create Account'
                        : 'Update Account'; ?>

                    </button>

                </div>

            </div>

        </form>

        <?php if(!isset($id)): ?>
        <div class="login-link">
            <a href="login.php">
                Already have an account? Login
            </a>
        </div>
        <?php endif; ?>

    </div>

</div>

<script>

$(document).ready(function(){

    $('[name="password"],[name="cpass"]').keyup(function(){

        var pass = $('[name="password"]').val();
        var cpass = $('[name="cpass"]').val();

        if(pass == cpass){

            $('#pass_match')
            .attr('data-status','1')
            .html('<span class="text-success">✓ Password Matched</span>');

        }else{

            $('#pass_match')
            .attr('data-status','0')
            .html('<span class="text-danger">✗ Password Does Not Match</span>');
        }

    });

    $('#manage-signup').submit(function(e){

        e.preventDefault();

        if($('#pass_match').attr('data-status') != '1'){
            alert('Passwords do not match');
            return false;
        }

        $.ajax({
            url:'admin/ajax.php?action=signup',
            method:'POST',
            data:$(this).serialize(),

            success:function(resp){

                if(resp == 1){

                    alert('Account Created Successfully');

                    setTimeout(function(){
                        location.href='login.php';
                    },1000);

                }else{

                    $('#msg').html(
                        '<span class="text-danger">Email already exists.</span>'
                    );

                }

            }

        });

    });

});

</script>

<?php include 'footer.php'; ?>

</body>
</html>