<?php
include '../includes/dbConnection.php';
session_start();

$car = [];
$editMode = false;

if (isset($_GET['id'])) {
    $editMode = true;
    $id = (int)$_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM add_cars WHERE id=$id");
    $car = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $editMode ? 'Update Car' : 'Add Car'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
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

<!-- Navbar -->
<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <span class="navbar-brand h5">
            <?= $editMode ? 'Update Car Details' : 'Add New Car'; ?>
        </span>

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
        <h5 class="mb-3">Car Details</h5>

        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" id="flashMessage"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" id="flashMessage"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); } ?>

        <form method="POST" action="../includes/add_car_process.php" enctype="multipart/form-data">

            <!-- Hidden fields -->
            <input type="hidden" name="car_id" value="<?= $car['id'] ?? '' ?>">
            <input type="hidden" name="old_image" value="<?= $car['image'] ?? '' ?>">

            <!-- Row 1 -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Car Name</label>
                    <input type="text" name="car_name" class="form-control"
                           value="<?= $car['car_name'] ?? '' ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Car Model</label>
                    <input type="text" name="car_model" class="form-control"
                           value="<?= $car['car_model'] ?? '' ?>" required>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control"
                           value="<?= $car['brand'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fuel Type</label>
                    <select name="fuel_type" class="form-select">
                        <?php
                        $fuelTypes = ['Petrol', 'Diesel', 'Electric', 'CNG'];
                        $currentFuel = $car['fuel_type'] ?? '';
                        foreach ($fuelTypes as $fuel) {
                            echo "<option value='$fuel' ".($fuel==$currentFuel?'selected':'').">$fuel</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Self Drive Price (₹ / day)</label>
                    <input    <input type="number" name="self_drive_price" class="form-control"
                           value="<?= $car['self_drive_price'] ?? '' ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">With Driver Price (₹ / day)</label>
                    <input type="number" name="with_driver_price" class="form-control"
                           value="<?= $car['with_driver_price'] ?? '' ?>" required>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Car Image</label>
                    <input type="file" name="car_image" class="form-control">
                    <?php if ($editMode && !empty($car['image'])) { ?>
                        <small class="text-muted">Current: <?= $car['image']; ?></small>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Car Number</label>
                    <input type="text" name="car_number" class="form-control"
                           value="<?= $car['car_number'] ?? '' ?>" required>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?= $car['description'] ?? '' ?></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="submit"
                        name="<?= $editMode ? 'update' : 'add' ?>"
                        class="btn <?= $editMode ? 'btn-warning' : 'btn-success' ?>">
                    <i class="fa <?= $editMode ? 'fa-edit' : 'fa-save' ?>"></i>
                    <?= $editMode ? 'Update Car' : 'Add Car' ?>
                </button>
                <a href="my_cars.php" class="btn btn-secondary ms-2">Cancel</a>
            </div>

        </form>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
setTimeout(() => {
    const msg = document.getElementById('flashMessage');
    if (msg) {
        msg.classList.add('hide');

        setTimeout(() => {
            msg.remove();
        }, 800); // CSS duration ke barabar
    }
}, 3000);
</script>


</body>
</html>
