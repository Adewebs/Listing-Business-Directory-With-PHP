<?php

// edit_admin.php: Handles editing of admin details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php'; // Include your DB connection file

    $adminId = $_POST['admin_id'];
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Prepare SQL to update only the fields that are not empty
    $sql = "UPDATE admin_table SET ";
    $updates = [];

    if (!empty($username)) {
        $updates[] = "username = '$username'";
    }
    if (!empty($firstName)) {
        $updates[] = "first_name = '$firstName'";
    }
    if (!empty($lastName)) {
        $updates[] = "last_name = '$lastName'";
    }
    if (!empty($email)) {
        $updates[] = "email = '$email'";
    }
    if (!empty($role)) {
        $updates[] = "role = '$role'";
    }

    if (count($updates) > 0) {
        $sql .= implode(', ', $updates) . " WHERE id = $adminId";
        
        if ($conn->query($sql) === TRUE) {
            echo "Admin details updated successfully.";
        } else {
            echo "Error updating admin details: " . $conn->error;
        }
    } else {
        echo "No fields to update.";
    }

  
}
?>

