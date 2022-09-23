<?php
include 'connect.php';


try {
    $ptid = $_POST['ptid'];
    $ptname = $_POST['ptname'];
    $ptage = $_POST['ptage'];
    $ptaddress = $_POST['ptaddress'];
    $ptphysician = $_POST['ptphysician'];
    // Create prepared statement
    $sql2 = "UPDATE patients SET patientName = '$ptname', patientAge='$ptage', patientAddress='$ptaddress', physicianid='$ptphysician' WHERE patientId = $ptid";
    $stmt2 = $conn->prepare($sql2);

    // Execute the prepared statement
    $stmt2->execute();
    echo "Records inserted successfully.";
} catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql2. " . $e->getMessage());
}

header("Location: index.php");
exit();
