<?php

//log traffic connection

// Get visitor details
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = $_SERVER['REQUEST_URI'];
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct';

// Optional: Get listing ID from query parameter if visiting a listing page
$listing_id = isset($_GET['listing_id']) ? $_GET['listing_id'] : null;

// Get country from IP (using a GeoIP service or API)
$country = get_country_from_ip($ip);

// Insert the traffic data into the database
$stmt = $conn->prepare("INSERT INTO traffic_logs (ip_address, user_agent, page_url, referrer, country, listing_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('sssssi', $ip, $user_agent, $page_url, $referrer, $country, $listing_id);

if ($stmt->execute()) {
    //echo "Traffic log saved successfully.";
} else {
    //echo "Error: " . $stmt->error;
}

// $stmt->close();
// $conn->close();

// Function to get country from IP using a geoIP service like ipinfo.io
function get_country_from_ip($ip) {
    $response = file_get_contents("https://ipinfo.io/{$ip}/json");
    $details = json_decode($response, true);
    return isset($details['country']) ? $details['country'] : 'Unknown';
}

?>