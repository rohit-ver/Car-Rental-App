<?php
session_start();
$lists = include '../includes/fetch_profile.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body { background:#f4f6f9; }
.sidebar {
    width:250px; height:100vh; position:fixed;
    background:#111827; color:#fff;
}
.sidebar a {
    color:#cbd5e1; padding:12px 20px; display:block; text-decoration:none;
}
.sidebar a:hover,.active { background:#1f2937; color:#fff; }
.content { margin-left:250px; padding:20px; }
.card-box { border-radius:12px; box-shadow:0 5px 10px rgba(0,0,0,0.05); }
.profile-img { width:120px; height:120px; border-radius:50%; }
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center py-3 border-bottom">Car Owner</h4>
    <a href="dashboard.php"><i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="my_cars.php"><i class="fa fa-car me-2"></i> My Cars</a>
    <a href="add_car.php"><i class="fa fa-plus me-2"></i> Add Car</a>
    <a href="bookings.php"><i class="fa fa-book me-2"></i> Bookings</a>
    <a href="earnings.php"><i class="fa fa-wallet me-2"></i> Earnings</a>
    <a href="profile.php"><i class="fa fa-user me-2"></i> Profile</a>
    <a href="change_password.php"><i class="fa fa-key me-2"></i> Change Password</a>
    <a href="../logout.php" class="text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="content">

<!-- Top -->
<nav class="navbar bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <h5 class="mb-0">My Profile</h5>
        <button class="btn btn-primary" id="editBtn">
            <i class="fa fa-edit"></i> Edit Profile
        </button>
    </div>
</nav>

<div class="card card-box">
<div class="card-body">

<div class="row">
    <!-- Left -->
    <div class="col-md-4 text-center border-end">
        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="profile-img mb-3">
        <h5> <?php echo $_SESSION['name']; ?></h5>
        <p class="text-muted">Car Owner</p>

        <!-- hidden file -->
        <input type="file" class="form-control d-none" id="profileImage">
    </div>

    <!-- Right -->
    <div class="col-md-8">
        <form id="profileForm">
                <?php foreach($lists as $list){ ?>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Full Name</label>
                    <input type="text" class="form-control" value="<?= $list['name']; ?>" disabled>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= $list['email']; ?>" disabled>
                </div>
            </div>
            <?php } ?>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Mobile</label>
                    <input type="text" class="form-control" value="9876543210" disabled>
                </div>
                <div class="col-md-6">
                    <label>City</label>
                    <input type="text" class="form-control" value="Jaipur" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea class="form-control" disabled>Jaipur, Rajasthan</textarea>
            </div>

            <!-- Save / Cancel -->
            <div class="d-none" id="actionBtns">
                <button class="btn btn-success">
                    <i class="fa fa-save"></i> Save
                </button>
                <button type="button" class="btn btn-secondary" id="cancelBtn">
                    Cancel
                </button>
            </div>

        </form>
    </div>
</div>

</div>
</div>
</div>

<script>
const editBtn = document.getElementById("editBtn");
const inputs = document.querySelectorAll("#profileForm input, #profileForm textarea");
const actionBtns = document.getElementById("actionBtns");
const profileImage = document.getElementById("profileImage");

editBtn.onclick = () => {
    inputs.forEach(i => i.disabled = false);
    actionBtns.classList.remove("d-none");
    profileImage.classList.remove("d-none");
    editBtn.classList.add("d-none");
};

document.getElementById("cancelBtn").onclick = () => {
    inputs.forEach(i => i.disabled = true);
    actionBtns.classList.add("d-none");
    profileImage.classList.add("d-none");
    editBtn.classList.remove("d-none");
};
</script>

</body>
</html>
