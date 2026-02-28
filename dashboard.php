<?php
session_start();

$lists = include '../includes/fetch_process.php';

// Safety: agar fetch_process.php kuch return na kare
if (!is_array($lists)) {
    $lists = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body { background:#f4f6f9; }
        .sidebar {
            width:250px;
            height:100vh;
            position:fixed;
            background:#111827;
            color:#fff;
        }
        .sidebar a {
            color:#cbd5e1;
            padding:12px 20px;
            display:block;
            text-decoration:none;
        }
        .sidebar a:hover, .active {
            background:#1f2937;
            color:#fff;
        }
        .content {
            margin-left:250px;
            padding:20px;
        }
        .card-box {
            border-radius:12px;
            box-shadow:0 5px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center py-3 border-bottom">Car Owner</h4>
    <a href="dashboard.php"><i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="my_cars.php"><i class="fa fa-car me-2"></i> My Cars</a>
    <a href="add_car.php" class="active"><i class="fa fa-plus me-2"></i> Add Car</a>
    <a href="bookings.php"><i class="fa fa-book me-2"></i> Bookings</a>
    <a href="earnings.php"><i class="fa fa-wallet me-2"></i> Earnings</a>
    <a href="profile.php"><i class="fa fa-user me-2"></i> Profile</a>
    <a href="change_password.php"><i class="fa fa-key me-2"></i> Change Password</a>
    <a href="logout.php" class="text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">

<!-- Top Navbar -->
<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <span class="navbar-brand h5">Dashboard</span>

        <?php if(isset($_SESSION['userid'])){ ?>
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    👤 <?= htmlspecialchars($_SESSION['name']); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>

<!-- Card -->
<div class="card card-box">
    <div class="card-body">
        <h5 class="mb-3">Details</h5>

    <!-- Summary Cards -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card card-box p-3">
                <h6>Total Cars</h6>
                <h3><?= count($lists) ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-box p-3">
                <h6>Active Bookings</h6>
                <h3>3</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-box p-3">
                <h6>Total Earnings</h6>
                <h3>₹45,000</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-box p-3">
                <h6>Pending Requests</h6>
                <h3>2</h3>
            </div>
        </div>
    </div>

    <!-- My Cars Table -->
    <div class="card card-box mt-5">
        <div class="card-body">
            <h5 class="mb-3">My Cars</h5>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Car Name</th>
                        <th>Model</th>
                        <th>Self-Driver-Price / Day</th>
                        <th>With-Driver-Price / Day</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($lists) > 0) { ?>
                        <?php foreach ($lists as $list) { ?>
                            <tr>
                                <td><?= htmlspecialchars($list['id'] ?? '') ?></td>
                                <td><?= htmlspecialchars($list['car_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($list['car_model'] ?? '') ?></td>
                                <td>₹<?= htmlspecialchars($list['self_drive_price'] ?? '0') ?></td>
                                <td>₹<?= htmlspecialchars($list['with_driver_price'] ?? '0') ?></td>
                                <td>
                                    <span class="badge bg-success">Available</span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No cars found
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS (REQUIRED for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
