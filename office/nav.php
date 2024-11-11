<?php
// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    // If the session does not exist, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg db-navbar fixed-top bg-white navbar-light shadow-sm">
          <div class="db-navbar-brand"><a class="" href="index.php">
          <img src="uploads/<?php 
          
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
          
          echo basename($row['directory_logo']); ?>" 
     class="card-img-top directory-logo-img" 
     alt="<?php echo $row['directory_logo']; ?>" >
</a></div>
          <div class="db-navbar-toggler order-3 ml-3 ml-lg-0">
            <button class="navbar-toggler" type="button"
             data-toggle="collapse" data-target="#navbardbCollapse" aria-controls="navbardbCollapse"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

          </div>

              <ul class="navbar-nav ml-auto flex-row d-lg-flex align-item-center">
                  <li class="nav-item dropdown dropleft notification mr-4">
                      <a class="dropdown-toggle" href="#" id="menu-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-bell bell-icon"></i>
                          <span class="badge badge-danger">01</span>
                      </a>

                      <ul class="dropdown-menu" aria-labelledby="menu-1">

                          <div class="notification-list">
                            
                          
                              <li class="dropdown-item">
                                  <a href="#">
                                      <p class="dropdown-item-text">Welcome to Spacely! Click here it understand better.</p>
                                      <p class="dropdown-item-time">23 days ago</p>
                                  </a>
                              </li>
                          </div>
                          <div class="notification-footer">
                              <a href="#" class="notification-footer-show">Show all</a>
                              <a href="#" class="notification-footer-mark"> Mark all as read</a>
                          </div>
                      </ul>
                  </li>
                  <li class="nav-item dropdown dropleft user">
                      <a class="dropdown-toggle" href="#" id="menu-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="../assets/images/avatar-1.jpg" alt="" class="rounded-circle user-profile">
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="menu-2">

                          <li class="dropdown-item">
                              <a class="dropdown-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link" href="listing.php"><i class="fas fa-fw fa-list"></i>Listing</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link" href="listing-request.php"><i class="fas fa-fw fa-receipt"></i>Listing Request</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link active" href="reviews.php"><i class="fas fa-fw fa-star"></i>Reviews</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link" href="analytics.php"><i class="fas fa-fw fa-file-invoice"></i>Analytics</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link" href="Administrators.php"><i class="fas fa-fw fa-gem"></i>Administrators</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link " href="system-settings.php"><i class="fas fa-fw fa-user-circle"></i>System Settings</a>
                          </li>
                          <li class="dropdown-item">
                              <a class="dropdown-link" href="logout.php"><i class="fas fa-fw fa-sign-out-alt"></i>Logout</a>
                          </li>
                      </ul>
                  </li>
              </ul>

      </nav>