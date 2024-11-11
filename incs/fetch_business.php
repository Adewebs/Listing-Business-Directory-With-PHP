<?php


// Define how many results you want per page
$results_per_page = 12;

// Find out the number of results stored in the database
$sql = "SELECT COUNT(id) AS total FROM listed_business";
$fetc_result = $conn->query($sql);
$row = $fetc_result->fetch_assoc();
$total_results = $row['total'];

// Determine the number of total pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Determine the SQL LIMIT starting number for the results on the displaying page
$starting_limit = ($page - 1) * $results_per_page;

// Fetch the selected results from the database
$sql = "SELECT * FROM listed_business LIMIT $starting_limit, $results_per_page";
$fetc_result = $conn->query($sql);

?>