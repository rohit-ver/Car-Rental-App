<?php
require_once 'includes/session_config.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

/*
  includes/user_booking_list.php
  👉 ye file MUST return an array
  return $bookings;
*/
$user_lists = include 'includes/user_booking_list.php';
if (!is_array($user_lists)) {
    $user_lists = [];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Bookings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  background:#f5f7fa;
  font-family:Segoe UI, sans-serif;
}
.top-bar{
  background:#fff;
  padding:15px 0;
  box-shadow:0 2px 8px rgba(0,0,0,.08);
}
.page-title{
  font-weight:600;
}
.card{
  border:none;
  border-radius:10px;
  box-shadow:0 4px 12px rgba(0,0,0,.08);
}
.table thead{
  background:#f1f1f1;
}
.badge{
  font-size:0.85rem;
}
.table-wrapper{
  max-height:300px;
  overflow-y:auto;
}
</style>
</head>

<body>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="container d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Car Rental</h5>

    <div class="dropdown">
      <a class="btn btn-light dropdown-toggle" href="#" data-bs-toggle="dropdown">
        👤 <?= htmlspecialchars($_SESSION['name']); ?>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="container py-5">

  <!-- PAGE TITLE -->
  <div class="mb-4">
    <h3 class="page-title">My Bookings</h3>
    <p class="text-muted mb-0">
      View your current booking and booking history
    </p>
  </div>

  <!-- CURRENT BOOKING -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="mb-3">Current Booking</h5>

      <?php if (!empty($user_lists)) { 
          $current = $user_lists[0]; ?> <!--it is used to show current booking -->
        
          <div class="row mb-2">
            <div class="col-md-3"><b>Car:</b> <?= $current['car_name']; ?></div>
            <div class="col-md-3"><b>Date:</b> <?= $current['start_date']; ?></div>
            <div class="col-md-3">
              <b>Route:</b> <?= $current['from_city']; ?> → <?= $current['to_city']; ?>
            </div>
            <div class="col-md-2"><b>Amount:</b> ₹ <?= $current['total_price']; ?></div>
            <div class="col-md-1">
              <span class="badge bg-success"><?= $current['booking_status']; ?></span>
            </div>
          </div>
        <div class="mt-3">
          <button class="btn btn-danger btn-sm">Cancel Booking</button>
        </div>

      <?php } else { ?>
        <p class="text-danger text-center mb-0">No current booking found</p>
      <?php } ?>

    </div>
  </div>

  <!-- BOOKING HISTORY -->
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3">Booking History</h5>

      <div class="table-wrapper">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>S No.</th>
              <th>Car</th>
              <th>Date</th>
              <th>Trip-Type</th>
              <th>Route</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

          <?php if (!empty($user_lists)) { ?>
            <?php $i = 1; 
            foreach ($user_lists as $user) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $user['car_name']; ?></td>
                <td><?= $user['start_date']; ?></td>
                <td><?= $user['trip_type']; ?></td>
                <td><?= $user['from_city']; ?> → <?= $user['to_city']; ?></td>
                <td>₹ <?= $user['total_price']; ?></td>
                <td>
                  <span class="badge bg-success"><?= $user['booking_status']; ?></span>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="6" class="text-center text-danger">
                No booking history found
              </td>
            </tr>
          <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
