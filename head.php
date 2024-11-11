<!doctype html>
<html lang="en">

<?php
include 'incs/db.php';

// Fetching directory settings data
$sql = "SELECT * FROM directory_settings LIMIT 1"; // Assuming you're fetching only one setting
$result = $conn->query($sql);

// Check if a row is returned
if ($result->num_rows > 0) {
    // Fetch the row as an associative array
    $row = $result->fetch_assoc();
} else {
    echo "No directory settings found!";
}
?>

<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Libs CSS -->
    <link rel="stylesheet" href="assets/libs/dropzone/dist/min/dropzone.min.css">



    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.min.css">

    <title><?php echo $page_title?></title>
    
    <style>
        .directory-logo-img {
            width: 100%; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
            max-width: 150px; /* Set max width if needed, adjust based on SVG dimensions */
        }
    </style>
</head>

