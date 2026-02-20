<?php
session_start();
include "includes/dbConnection.php"; // ⭐ PATH CHECK

// Show error

if (isset($_SESSION['userid'])) {

    $userid = (int) $_SESSION['userid'];

    $sql = "UPDATE signup SET status = 'inactive' WHERE userid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $userid);
        $stmt->execute();
    }
}

// session destroy LAST me
session_unset();
session_destroy();

// redirect
header("Location: login.php");
exit;
