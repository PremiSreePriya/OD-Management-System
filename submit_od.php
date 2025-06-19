<?php
include 'db.php';

$name = $_POST['name'];
$reg_no = $_POST['reg_no'];
$dept = $_POST['department'];
$from = $_POST['from_date'];
$to = $_POST['to_date'];
$reason = $_POST['reason'];

$proof = $_FILES['proof']['name'];
$targetDir = "uploads/";
$targetFile = $targetDir . basename($proof);

// ✅ Create 'uploads/' folder if it doesn't exist
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// ✅ Move uploaded file
if (move_uploaded_file($_FILES['proof']['tmp_name'], $targetFile)) {
    $sql = "INSERT INTO od_requests (name, reg_no, department, from_date, to_date, reason, proof)
            VALUES ('$name', '$reg_no', '$dept', '$from', '$to', '$reason', '$proof')";

    if ($conn->query($sql)) {
        echo "✅ OD Submitted Successfully!";
    } else {
        echo "❌ Error saving to database: " . $conn->error;
    }
} else {
    echo "❌ File upload failed.";
}
?>