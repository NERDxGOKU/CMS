<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "dev";
    $password = "Kumar123@3";
    $dbname = "vietnam_form";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO form_submission1 (Sideid, PTWNo, SiteName, NoofAC, Technician, AttendTime, SNo, ItemDiscription, OUM, QTY, Remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iisississis", $Sideid, $PTWNo, $SiteName, $NoofAC, $Technician, $AttendTime, $SNo, $ItemDiscription, $OUM, $QTY, $Remark);

    // Set common parameters
    $Sideid = isset($_POST["Sideid"]) ? (int)$_POST["Sideid"] : null;
    $PTWNo = isset($_POST["PTWNo"]) ? (int)$_POST["PTWNo"] : null;
    $SiteName = isset($_POST["SiteName"]) ? $_POST["SiteName"] : '';
    $NoofAC = isset($_POST["NoofAC"]) ? (int)$_POST["NoofAC"] : null;
    $Technician = isset($_POST["Technician"]) ? $_POST["Technician"] : '';
    $AttendTime = isset($_POST["AttendTime"]) ? $_POST["AttendTime"] : '';

    // Process the first record only
    $SNo = isset($_POST["SNo"][0]) ? (int)$_POST["SNo"][0] : null;
    $ItemDiscription = isset($_POST["ItemDiscription"][0]) ? $_POST["ItemDiscription"][0] : '';
    $OUM = isset($_POST["OUM"][0]) ? $_POST["OUM"][0] : '';
    $QTY = isset($_POST["QTY"][0]) ? (int)$_POST["QTY"][0] : null;
    $Remark = isset($_POST["Remark"][0]) ? $_POST["Remark"][0] : '';

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record created successfully for SNo: $SNo<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>



