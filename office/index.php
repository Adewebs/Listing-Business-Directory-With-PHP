<?php
$page_title = "Office | Home";
include 'head.php';
$activePage = 'index.php';


//count total items in listed request business table
$request_business_sql = "SELECT COUNT(*) AS total FROM listed_business_request";

if ($request_business_result = $conn->query($request_business_sql)) {
    // Check if the query returned a result
    if ($request_business_result->num_rows > 0) {
        // Fetch the total count
        $request_business_row = $request_business_result->fetch_assoc();
        $total_request_business = $request_business_row['total']; // Save the count in a variable

    } else {
        echo "No data found.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}


//count total items in admin table
$admin_sql = "SELECT COUNT(*) AS total FROM admin_table";

if ($admin_result = $conn->query($admin_sql)) {
    // Check if the query returned a result
    if ($admin_result->num_rows > 0) {
        // Fetch the total count
        $admin_row = $admin_result->fetch_assoc();
        $total_admin = $admin_row['total']; // Save the count in a variable

    } else {
        echo "No data found.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

//count total items in listed business table
$listed_sql = "SELECT COUNT(*) AS total FROM listed_business";
if ($listed_result = $conn->query($listed_sql)) {
    if ($listed_result->num_rows > 0) {
        $listed_row = $listed_result->fetch_assoc();
        $totallisting = $listed_row['total'];
    } else {
        echo "No data found.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

//count total items in listed reviews table
$review_sql = "SELECT COUNT(*) AS total FROM business_review";
if ($review_result = $conn->query($review_sql)) {
    if ($review_result->num_rows > 0) {
        $review_row = $review_result->fetch_assoc();
        $total_reviews = $review_row['total'];
    } else {
        echo "No data found.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

// Fetch the first 5 recent reviews
$recent_reviews_sql = "SELECT * FROM business_review ORDER BY review_time DESC LIMIT 5";
$recent_reviews = $conn->query($recent_reviews_sql);

// Fetch the first 5 recent listed businesses
$recent_listed_business_sql = "SELECT * FROM listed_business ORDER BY create_at DESC LIMIT 5";
$recent_listed_business = $conn->query($recent_listed_business_sql);



?>

<body class="bg-light">
    <div class="db-wrapper">
        <div class="db-header">
            <?php include 'nav.php'; ?>
        </div>
        <div class="db-content py-lg-15 py-11">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <?php include 'sidenav.php'; ?>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-4">
                                    <h2 class="h3 mb-0">Dashboard</h2>
                                    <p>Quick Overview of the system</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <h3 class="h6 mb-4">Listings</h3>
                      <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                          <?php echo $totallisting ?>
                        </h3>
                        <span class="db-overview-widget-body-icon">
                          <i
                            class="fas fa-list icon-shape icon-shape icon-lg text-primary bg-light rounded-circle"
                          ></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <h3 class="h6 mb-4">Reviews</h3>
                      <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                        <?php echo  $total_reviews ?>
                        </h3>
                        <span class="db-overview-widget-body-icon">
                          <i
                            class="fas fa-star icon-shape icon-lg text-primary bg-light rounded-circle"
                          ></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <h3 class="h6 mb-4">Listing Request</h3>
                      <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                        <?php echo  $total_request_business ?>
                        </h3>
                        <span class="db-overview-widget-body-icon">
                          <i
                            class="fas fa-file-invoice icon-shape icon-lg text-primary bg-light rounded-circle"
                          ></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <h3 class="h6 mb-4">
                       Administrators
                      </h3>
                      <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                        <?php echo  $total_admin ?>
                        </h3>
                        <span class="db-overview-widget-body-icon">
                          <i
                            class="fas fa-paper-plane icon-shape icon-lg text-primary bg-light rounded-circle"
                          ></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                        <!-- Display Recent Reviews -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                <div class="card">
                                    <h3 class="card-header bg-white h6 mb-0 border-bottom-0">Recent Reviews</h3>
                                    <div class="db-card-body table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <?php while ($review = $recent_reviews->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <div class="">
                                                                <img src="../assets/images/avatar-placeholder.jpg" alt="" class="rounded-circle icon-shape icon-sm" />
                                                            </div>
                                                        </td>
                                                        <td class="align-middle"><?php echo $review['reviewer_name']; ?></td>
                                                        <td class="align-middle"><?php echo $review['reviewer_comment']; ?></td>
                                                        <td class="align-middle"><?php echo $review['review_time']; ?></td>
                                                        <td class="align-middle">
                                                            <div class="font-12">
                                                                <?php for ($i = 0; $i < 5; $i++) {
                                                                    echo ($i < $review['rating']) ? '<span class="fas fa-star text-warning"></span>' : '<span class="fas fa-star text-muted"></span>';
                                                                } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="card-body border-top">
                                            <a href="reviews.php" class="btn btn-primary btn-sm">See All Reviews</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Display Recent Listed Businesses -->
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 mb-4">
                                <div class="card">
                                    <h3 class="card-header bg-white h6 mb-0 border-bottom-0">Recent Listed Businesses</h3>
                                    <div class="db-card-body table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <?php while ($business = $recent_listed_business->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td class="align-middle"><?php echo $business['business_name']; ?></td>
                                                        <td class="align-middle"><?php echo $business['business_address']; ?></td>
                                                        <td class="align-middle"><?php echo $business['business_website']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="card-body border-top">
                                            <a href="listing.php" class="btn btn-primary btn-sm">See All Businesses</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'foot.php'; ?>
    </div>
</body>
