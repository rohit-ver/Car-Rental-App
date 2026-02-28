<?php
session_start();
$lists = include '../includes/fetch_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cars</title>
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
        .car-img {
            width:80px;
            border-radius:8px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center py-3 border-bottom">Car Owner</h4>
    <a href="dashboard.php"><i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="my-cars.php" class="active"><i class="fa fa-car me-2"></i> My Cars</a>
    <a href="add_car.php"><i class="fa fa-plus me-2"></i> Add Car</a>
    <a href="bookings.php"><i class="fa fa-book me-2"></i> Bookings</a>
    <a href="earnings.php"><i class="fa fa-wallet me-2"></i> Earnings</a>
    <a href="profile.php"><i class="fa fa-user me-2"></i> Profile</a>
    <a href="change_password.php"><i class="fa fa-key me-2"></i> Change Password</a>
    <a href="../logout.php" class="text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">

    <!-- Top Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <span class="navbar-brand h5">My Cars</span>

        <?php if(isset($_SESSION['userid'])){ ?>
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    👤 <?php echo htmlspecialchars($_SESSION['name']); ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item text-danger" href="../logout.php">Logout</a></li>
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


    <!-- My Cars Card -->
    <div class="card card-box">
        <div class="card-body">
            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') { ?> <!--this is used to show the msg -->
            <div class="alert alert-success">Car deleted successfully</div>
            <?php } ?>


            <div class="d-flex justify-content-between mb-3">
                <h5>My Car List</h5>
                <a href="add_car.php" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New Car
                </a>
            </div>

            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>S No.</th>
                        <th>Image</th>
                        <th>Car Name</th>
                        <th>Model</th>
                        <th>Self-Price / Day</th>
                        <th>With-Driver-Price / Day</th>
                        <th>Status</th>
                        <th width="160">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list) { ?>
                    <tr>
                        <td class="text-center"><?= $list['id']; ?></td>
                        <td><img src="../images/uploads/<?= $list['image'] ?>" class="car-img"></td>
                        <td class="text-center"><?= $list['car_name']; ?></td>
                        <td class="text-center"><?= $list['car_model']; ?></td>
                        <td class="text-center">₹<?= $list['self_drive_price']; ?></td>
                        <td class="text-center">₹<?= $list['with_driver_price']; ?></td>
                        <td>
                        <?php if (isset($list['status']) && $list['status'] != '') { ?>
                            <span class="badge bg-success"><?= $list['status']; ?></span>
                        <?php } else { ?>
                            <span class="badge bg-success">available</span>
                        <?php } ?>
                        </td>

                        <td>
                                <a href="add_car.php?id=<?= $list['id']; ?>" 
                                class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="../Includes/delete_car.php" method="post"
                                    onsubmit="return confirm('Are You Sure to Delete?')"
                                    style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?= $list['id']; ?>">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
