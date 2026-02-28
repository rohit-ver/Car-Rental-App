<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Earnings</title>
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
    <a href="add_car.php"><i class="fa fa-plus me-2"></i> Add Car</a>
    <a href="bookings.php"><i class="fa fa-book me-2"></i> Bookings</a>
    <a href="earnings.php" class="active"><i class="fa fa-wallet me-2"></i> Earnings</a>
    <a href="profile.php"><i class="fa fa-user me-2"></i> Profile</a>
    <a href="change_password.php"><i class="fa fa-key me-2"></i> Change Password</a>
    <a href="../logout.php" class="text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">

    <!-- Top Navbar -->
        <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container-fluid">
            <span class="navbar-brand h5">Earnings</span>

            <?php if(isset($_SESSION['userid'])){ ?>
                <div class="dropdown">
                    <a class="btn btn-light dropdown-toggle" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        👤 <?php echo htmlspecialchars($_SESSION['name']); ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <div>
                    <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="signup.php" class="btn btn-primary">Sign Up</a>
                </div>
            <?php } ?>

        </div>
    </nav>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card card-box p-3">
                <h6>Total Earnings</h6>
                <h3>₹85,000</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-box p-3">
                <h6>This Month</h6>
                <h3>₹18,500</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-box p-3">
                <h6>Admin Commission</h6>
                <h3>₹8,500</h3>
            </div>
        </div>
    </div>

    <!-- Earnings Table -->
    <div class="card card-box">
        <div class="card-body">
            <h5 class="mb-3">Earning History</h5>

            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Car</th>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Owner Share</th>
                        <th>Admin Commission</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Swift</td>
                        <td>#BK1023</td>
                        <td>Amit Sharma</td>
                        <td>₹3,000</td>
                        <td>₹2,700</td>
                        <td>₹300</td>
                        <td>12 Sep 2025</td>
                        <td><span class="badge bg-success">Paid</span></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Creta</td>
                        <td>#BK1028</td>
                        <td>Rahul Verma</td>
                        <td>₹7,500</td>
                        <td>₹6,750</td>
                        <td>₹750</td>
                        <td>18 Sep 2025</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
