<?php
include 'connect.php';

$ptid = $_GET['patientId'];
try {
    // sql to delete a record
    $sql = "DELETE FROM patients WHERE patientId = $ptid";
    $stmt = $conn->prepare($sql);

    // Execute the prepared statement
    $stmt->execute();
} catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}


header("Location: index.php");
exit();
