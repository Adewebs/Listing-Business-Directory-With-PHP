<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Libs CSS -->
    <link rel="stylesheet" href="../assets/libs/dropzone/dist/min/dropzone.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <style>
        .directory-logo-img {
            width: 100%; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
            max-width: 150px; /* Set max width if needed, adjust based on SVG dimensions */
        }
    </style>
 
 <title><?php echo $page_title?></title>

    <?php
    include '../incs/db.php';
session_start(); // Start the session at the beginning of the file
// Handle form submission
    ?>
  </head>