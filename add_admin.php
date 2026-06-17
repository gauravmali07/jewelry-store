<?php
include('admin/db_connect.php');

// Define new admin details
$email = 'admin@jewelry.com';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$firstname = 'Admin';
$lastname = 'User';
$middlename = '';
$type = 1; // Admin

// Check if email already exists
$stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result = $stmt_check->get_result();
if($result->num_rows > 0){
    echo "Admin with this email already exists.";
    exit;
}

// Insert new admin
$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, middlename, type) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $email, $password, $firstname, $lastname, $middlename, $type);
if($stmt->execute()){
    echo "New admin added successfully. Email: $email, Password: admin123";
}else{
    echo "Failed to add admin.";
}
?>
