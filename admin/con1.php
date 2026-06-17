<?php
$conn = mysqli_connect("localhost","root","","jewelry_db");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Customer Feedbacks | Online Jewelry Store</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

body{
    background:#f4f6f9;
    font-family:Arial,sans-serif;
}

.page-header{
    background:#1f2937;
    color:#fff;
    padding:25px;
    text-align:center;
    border-bottom:4px solid var(--gold);
}

.page-header h1{
    margin:0;
    font-size:32px;
    font-weight:700;
}

.feedback-card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    padding:25px;
    margin-top:30px;
}

.btn-gold{
    background:var(--gold);
    color:#fff;
    border:none;
    font-weight:600;
}

.btn-gold:hover{
    background:var(--gold-dark);
    color:#fff;
}

.table thead{
    background:var(--gold);
    color:#fff;
}

.feedback-count{
    font-size:18px;
    font-weight:600;
    color:#555;
}

</style>

</head>

<body>

<div class="page-header">

    <h1>
        <i class="fas fa-comments"></i>
        Customer Feedbacks
    </h1>

</div>

<div class="container">

    <div class="feedback-card">

        <form method="POST">

            <div class="text-center mb-4">

                <button type="submit"
                        name="btndis"
                        class="btn btn-gold btn-lg">

                    <i class="fas fa-eye"></i>
                    View All Feedbacks

                </button>

            </div>

        </form>

<?php

if(isset($_POST['btndis'])){

    $query = "SELECT * FROM feedback";
    $result = mysqli_query($conn,$query);

    $count = mysqli_num_rows($result);

    echo "<p class='feedback-count mb-3'>
            Total Feedbacks : <b>$count</b>
          </p>";

    echo "<div class='table-responsive'>";

    echo "<table class='table table-bordered table-hover'>";

    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Feedback</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    $i=1;

    while($row=mysqli_fetch_assoc($result)){

        echo "<tr>";

        echo "<td>".$i++."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['feedback']."</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
?>

    </div>

</div>

</body>
</html>
