<?php
// delete_admin.php: Handles deletion of admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php'; // Include your DB connection file

    $adminId = $_POST['admin_id'];
    $sql = "DELETE FROM admin_table WHERE id = $adminId";

    if ($conn->query($sql) === TRUE) {
        echo "Admin deleted successfully.";
    } else {
        echo "Error deleting admin: " . $conn->error;
    }

}


?>