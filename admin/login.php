<?php
session_start();
include('./db_connect.php');

if(isset($_SESSION['login_id'])){
    header("location:index.php?page=home");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Online Jewelry Store</title>

    <?php include('./header.php'); ?>

    <style>

        :root{
            --gold:#d4af37;
            --gold-dark:#b89322;
        }

        body{
            background:linear-gradient(
                rgba(0,0,0,.70),
                rgba(0,0,0,.70)
            ),
            url('https://images.unsplash.com/photo-1617038220319-276d3cfab638');

            background-size:cover;
            background-position:center;
            min-height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

            padding:30px;
            margin:0;
            font-family:Arial, sans-serif;
        }

        .login-container{
            width:100%;
            max-width:500px;
        }

        .logo{
            text-align:center;
            margin-bottom:25px;
        }

        .logo h1{
            color:var(--gold);
            font-size:32px;
            font-weight:700;
            margin-bottom:10px;
        }

        .logo p{
            color:#fff;
            font-size:16px;
        }

        .login-card{
            background:#fff;
            border-radius:20px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .login-title{
            text-align:center;
            font-size:28px;
            font-weight:700;
            color:#333;
            margin-bottom:30px;
        }

        .form-control{
            height:50px;
            border-radius:10px;
        }

        .input-group-text{
            background:var(--gold);
            color:#fff;
            border:none;
        }

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
        }

        .btn-register{
            background:#2c3e50;
            color:#fff;
            border:none;
            border-radius:50px;
            padding:12px;
            font-weight:600;
            transition:.3s;
            text-decoration:none;
        }

        .btn-register:hover{
            background:#1f2937;
            color:#fff;
            text-decoration:none;
        }

        .divider{
            text-align:center;
            margin:20px 0;
            color:#999;
            font-weight:600;
        }

        @media(max-width:768px){

            .login-card{
                padding:25px;
            }

            .logo h1{
                font-size:24px;
            }

        }

    </style>

</head>

<body>

<div class="login-container">

    <div class="logo">

        <h1>Online Jewelry Store</h1>

        <p>Sign in to access your account</p>

    </div>

    <div class="login-card">

        <h2 class="login-title">
            Login
        </h2>

        <form id="login-form">

            <div id="login-msg"></div>

            <div class="input-group mb-3">

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter Email"
                       required>

                <div class="input-group-append">

                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>

                </div>

            </div>

            <div class="input-group mb-4">

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter Password"
                       required>

                <div class="input-group-append">

                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>

                </div>

            </div>

            <button type="submit"
                    id="login-btn"
                    class="btn btn-login btn-block">

                <i class="fas fa-sign-in-alt"></i>
                Login

            </button>

        </form>

      

</div>

<script>

$('#login-form').submit(function(e){

    e.preventDefault();

    $('#login-msg').html('');

    $('#login-btn')
        .prop('disabled',true)
        .html('Logging in...');

    $.ajax({

        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),

        error:function(){

            $('#login-btn')
                .prop('disabled',false)
                .html('Login');

        },

        success:function(resp){

            if(resp == 1){

                location.href='index.php?page=home';

            }else{

                $('#login-msg').html(
                    '<div class="alert alert-danger">Invalid Email or Password</div>'
                );

                $('#login-btn')
                    .prop('disabled',false)
                    .html('Login');
            }

        }

    });

});

</script>

</body>
</html>