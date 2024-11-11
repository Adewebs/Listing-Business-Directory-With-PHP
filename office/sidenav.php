<?php
// Set the active page by its number or name
 // For example, set this based on the current page
?>

<nav class="navbar navbar-expand-lg db-sidenav">
  <div class="collapse navbar-collapse" id="navbardbCollapse">
    <ul class="nav flex-column">
      <li class="nav-item">
        <!-- Dashboard link -->
        <a class="nav-link <?php echo ($activePage == 'index.php') ? 'active' : ''; ?>" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <!-- Listing link -->
        <a class="nav-link <?php echo ($activePage == 'listing.php') ? 'active' : ''; ?>" href="listing.php">
          <i class="fas fa-fw fa-list"></i> Listing
        </a>
      </li>
      <li class="nav-item">
        <!-- Listing Request link -->
        <a class="nav-link <?php echo ($activePage == 'listing-request.php') ? 'active' : ''; ?>" href="listing-request.php">
          <i class="fas fa-fw fa-receipt"></i> Listing Request
        </a>
      </li>
      <li class="nav-item">
        <!-- Reviews link -->
        <a class="nav-link <?php echo ($activePage == 'reviews.php') ? 'active' : ''; ?>" href="reviews.php">
          <i class="fas fa-fw fa-star"></i> Reviews
        </a>
      </li>

      <?php if ($_SESSION['admin_role'] == 'admin'): ?>
      <li class="nav-item">
        <!-- Analytics link -->
        <a class="nav-link <?php echo ($activePage == 'analytics.php') ? 'active' : ''; ?>" href="analytics.php">
          <i class="fas fa-fw fa-gem"></i> Analytics
        </a>
      </li>
      <li class="nav-item">
        <!-- Administrators link -->
        <a class="nav-link <?php echo ($activePage == 'administrators.php') ? 'active' : ''; ?>" href="administrators.php">
          <i class="fas fa-fw fa-user-circle"></i> Administrators
        </a>
      </li>
      <li class="nav-item">
        <!-- System Settings link -->
        <a class="nav-link <?php echo ($activePage == 'system-settings.php') ? 'active' : ''; ?>" href="system-settings.php">
          <i class="fas fa-fw fa-gem"></i> System Settings
        </a>
      </li>
      <?php endif; ?>
      
   
      <li class="nav-item">
        <!-- Logout link -->
        <a class="nav-link" href="logout.php">
          <i class="fas fa-fw fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </div>
</nav>

