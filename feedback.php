<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "jewelry_db";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Database Connection Failed : ".$conn->connect_error);
}

$message = "";

if(isset($_POST['submit_feedback'])){

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $feedback = trim($_POST['feedback']);

    if(empty($name) || empty($email) || empty($feedback)){

        $message = "
        <div class='alert alert-danger'>
            Please fill all required fields.
        </div>";

    }else{

        $stmt = $conn->prepare("
            INSERT INTO feedback
            (name,email,feedback)
            VALUES(?,?,?)
        ");

        $stmt->bind_param(
            "sss",
            $name,
            $email,
            $feedback
        );

        if($stmt->execute()){

            $message = "
            <div class='alert alert-success'>
                Thank you! Your feedback has been submitted successfully.
            </div>";

        }else{

            $message = "
            <div class='alert alert-danger'>
                Database Error : ".$stmt->error."
            </div>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Feedback | Jewellers</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f6f9;
}

.feedback-wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 15px;
}

.feedback-card{
    width:100%;
    max-width:800px;
    background:#fff;
    border-radius:25px;
    padding:40px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    border-top:6px solid #d4af37;
}

.feedback-header{
    text-align:center;
    margin-bottom:30px;
}

.feedback-header i{
    font-size:70px;
    color:#d4af37;
    margin-bottom:15px;
}

.feedback-header h1{
    color:#222;
    margin-bottom:10px;
}

.feedback-header p{
    color:#666;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#222;
}

input,
textarea{
    width:100%;
    padding:15px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:15px;
    color:#222;
    background:#fff;
}

input:focus,
textarea:focus{
    outline:none;
    border-color:#d4af37;
    box-shadow:0 0 10px rgba(212,175,55,.20);
}

textarea{
    height:180px;
    resize:none;
}

.btn-submit{
    width:100%;
    height:55px;
    border:none;
    border-radius:50px;
    background:#d4af37;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.btn-submit:hover{
    background:#b89322;
}

.alert{
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    text-align:center;
}

.alert-success{
    background:#d4edda;
    color:#155724;
}

.alert-danger{
    background:#f8d7da;
    color:#721c24;
}

.home-link{
    text-align:center;
    margin-top:20px;
}

.home-link a{
    text-decoration:none;
    color:#d4af37;
    font-weight:600;
}

.home-link a:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="feedback-wrapper">

<div class="feedback-card">

    <div class="feedback-header">

        <i class="fas fa-gem"></i>

        <h1>Jewelry Store Feedback</h1>

        <p>We value your opinion and suggestions.</p>

    </div>

    <?php echo $message; ?>

    <form method="POST">

        <div class="form-group">

            <label>
                <i class="fa fa-user"></i>
                Full Name
            </label>

            <input type="text"
                   name="name"
                   placeholder="Enter your full name">

        </div>

        <div class="form-group">

            <label>
                <i class="fa fa-envelope"></i>
                Email Address
            </label>

            <input type="email"
                   name="email"
                   placeholder="Enter your email address">

        </div>

        <div class="form-group">

            <label>
                <i class="fa fa-comment"></i>
                Feedback
            </label>

            <textarea
                name="feedback"
                placeholder="Write your feedback here..."></textarea>

        </div>

        <button type="submit"
                name="submit_feedback"
                class="btn-submit">

            <i class="fa fa-paper-plane"></i>
            Submit Feedback

        </button>

    </form>

    <div class="home-link">

        <a href="index.php">

            <i class="fa fa-arrow-left"></i>
            Back To Home

        </a>

    </div>

</div>

</div>

</body>
</html>

<?php
$conn->close();
?>
