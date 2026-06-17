<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
    $type_arr = ["", "Admin", "User"];
    $role_colors = ["", "badge-danger", "badge-info"];

    $qry = $conn->query("SELECT *, CONCAT(lastname, ', ', firstname, ' ', middlename) AS name 
                         FROM users 
                         WHERE id = ".$_GET['id'])->fetch_array();
    foreach($qry as $k => $v){ $$k = $v; }

    $avatarPath = $_SERVER['DOCUMENT_ROOT'].'/jewelry/assets/uploads/'.$avatar;
    $avatarUrl  = '/jewelry/assets/uploads/'.$avatar;

    // Example extras
    $status = $status ?? 1; // 1=Active, 0=Inactive
    $last_login = $last_login ?? "Not recorded";
    $phone = $phone ?? "Not provided";
}
?>

<style>
/* Card Enhancements */
.profile-card {
    border-radius: 20px;
    overflow: hidden;
    border: none;
    animation: fadeIn 0.7s ease-in-out;
}

/* Header Gradient */
.profile-header {
    background: linear-gradient(135deg, #1b1b1b, #444);
    padding: 45px 20px 55px;
    text-align: center;
    color: #fff;
}

/* Avatar */
.profile-avatar img,
.profile-avatar span {
    width: 125px;
    height: 125px;
    border-radius: 50%;
    border: 5px solid #ffffff;
    font-size: 45px;
}

/* Fade Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.profile-avatar {
    margin-top: -65px;
}

/* Details */
.profile-details dl dt {
    font-weight: 700;
    margin-bottom: 4px;
    color: #222;
}

.profile-details dl dd {
    margin-bottom: 18px;
    color: #555;
}

/* Divider */
.profile-divider {
    height: 1px;
    background: #e5e5e5;
    margin: 18px 0;
}

/* Status Badge */
.badge-status {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 30px;
}

/* Role Badge */
.role-badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 12px;
}

/* Social Icons */
.social-icons a {
    font-size: 20px;
    margin: 0 8px;
    color: #555;
    transition: 0.3s;
}
.social-icons a:hover {
    transform: scale(1.15);
    color: #000;
}
</style>


<div class="container-fluid">
    <div class="card shadow-lg profile-card">

        <!-- Header -->
        <div class="profile-header">
            <h3 class="font-weight-bold mb-1"><?php echo ucwords($name) ?></h3>
            <p class="mb-1"><?php echo $email ?></p>

            <!-- Status Badge -->
            <span class="badge badge-status <?php echo $status ? 'badge-success' : 'badge-danger'; ?>">
                <?php echo $status ? 'Active' : 'Inactive'; ?>
            </span>
        </div>

        <!-- Avatar -->
        <div class="d-flex justify-content-center profile-avatar">
            <?php if(empty($avatar) || !is_file($avatarPath)): ?>
                <span class="d-flex justify-content-center align-items-center bg-primary text-white">
                    <?php echo strtoupper(substr($firstname, 0,1).substr($lastname, 0,1)) ?>
                </span>
            <?php else: ?>
                <img src="<?php echo $avatarUrl ?>" class="img-fluid rounded-circle" alt="Avatar">
            <?php endif; ?>
        </div>

        <!-- Body -->
        <div class="card-body profile-details">

            <!-- Role Badge -->
            <div class="text-center mb-3">
                <span class="badge role-badge <?php echo $role_colors[$type]; ?>">
                    <?php echo $type_arr[$type]; ?>
                </span>
            </div>

            <div class="profile-divider"></div>

            <dl>
                <dt>Address</dt>
                <dd><?php echo $address ?></dd>

                <dt>Phone</dt>
                <dd><?php echo $phone ?></dd>

                <dt>User Type</dt>
                <dd><?php echo $type_arr[$type] ?></dd>

                <dt>Last Login</dt>
                <dd><?php echo $last_login ?></dd>
            </dl>

            <div class="profile-divider"></div>

            <!-- Social Icons (Optional) -->
            <div class="text-center social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

        </div>
    </div>
</div>

<div class="modal-footer display modal-footer-custom">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<style>
    #uni_modal .modal-footer { display: none; }
    #uni_modal .modal-footer.display { display: flex; }
</style>
