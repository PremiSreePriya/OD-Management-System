<?php
include 'db.php';
$id = $_GET['id'];
$status = $_GET['status'];
$conn->query("UPDATE od_requests SET status='$status' WHERE id=$id");
header("Location: admin_dashboard.php");
?>