<?php
$page_title = "Home";

include 'head.php';
include 'office/traffic.php';

// Pagination logic
$items_per_page = 8; // 4 items per row and 2 rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Fetching listed businesses with search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = $conn->real_escape_string($search); // Escape to prevent SQL injection

$sql_business = "SELECT * FROM listed_business 
                 WHERE business_name LIKE '%$search%' 
                 OR business_postal_code LIKE '%$search%' 
                 OR business_address LIKE '%$search%' 
                 LIMIT $items_per_page OFFSET $offset";
$result_business = $conn->query($sql_business);

// Fetch total number of businesses for pagination based on search
$total_businesses_sql = "SELECT COUNT(*) AS total FROM listed_business 
                          WHERE business_name LIKE '%$search%' 
                          OR business_postal_code LIKE '%$search%' 
                          OR business_address LIKE '%$search%'";
$total_result = $conn->query($total_businesses_sql);
$total_row = $total_result->fetch_assoc();
$total_businesses = $total_row['total'];

$total_pages = ceil($total_businesses / $items_per_page);
?>
<body>
    <div class="">
        <?php include 'nav.php'; ?>
    </div>

    <div class="container-fluid">
        <!-- hero section start -->
        <div class="hero-slider-section" style="background: url(assets/images/hero-slide-img-1.jpg); background-size: cover;">
            <!-- hero search area start -->
            <div class="py-lg-18 py-10 px-6">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="mb-4">
                            <h2 class="text-white font-weight-bold mb-0"><?php echo isset($row['directory_tagline']) ? $row['directory_tagline'] : 'Default Tagline'; ?></h2>
                            <p class="lead text-white">Book from thousands of unique Cleaners.</p>
                        </div>
                        <div class="">
                            <form class="form-row" method="GET" action="">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mb-2 mb-lg-0">
                                    <div class="form-group col-12">    
                                        <input type="text" class="form-control" name="search" placeholder="Search Location or Business" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"/> 
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-8 col-8">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Search</button>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 ">
                                    <p class="hero-search-area-form-small-text text-white-50">Top cities:<a href="listing-location.html" class="text-white"> New York</a>, <a href="listing-location.html" class="text-white">San Francisco</a>, <a href="listing-location.html" class="text-white">Los Angeles</a>, <a href="listing-location.html" class="text-white">Chicago</a>, <a href="listing-location.html" class="text-white">Houston</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- hero search area close -->
        </div>
    </div>
  
    <div class="pb-lg-10 pb-2 pt-5">
        <div class="container">
            <div class="row">
                <!-- section heading start -->
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-lg-8 mb-5 text-center">
                        <h1>List Of Cleaning Companies In UK </h1>
                        <p class="lead">Explore the different types of cleaning services available to rent and discover <br> which is right for your business.</p>
                    </div>
                </div>
                <!-- section heading close -->
            </div>

            <div class="row">
               <?php
                if ($result_business->num_rows > 0) {
                    while ($business = $result_business->fetch_assoc()) {
                        ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <!-- listing block start -->
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-img position-relative">
                                    <a href="business-details.php?id=<?php echo $business['id']; ?>">
                                    <img src="office/uploads/<?= $business['image'] ?>" class="img-fluid rounded-top w-100 ">
                                        <div class="card-overlay-badge badge badge-primary">Featured</div>
                                    </a>
                                    <a href="business-details.php?id=<?php echo $business['id']; ?>" class="badge badge-success card-overlay-category">
                                        <?php echo $business['business_name']; ?>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <a href="business-details.php?id=<?php echo $business['id']; ?>">
                                            <h3 class="h5 mb-1 text-truncate"><?php echo $business['business_name']; ?></h3>
                                        </a>
                                        <p class="font-14"><?php echo $business['business_address']; ?></p>
                                        <p class="font-14"><?php echo $business['business_website']; ?></p>
                                    </div>
                                    <div class="mb-3 small">
                                        <!-- Display star rating dynamically based on rating value -->
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <span class="fas fa-star <?php echo ($i <= $business['business_rating']) ? 'text-warning' : 'text-muted'; ?>"></span>
                                        <?php endfor; ?>
                                        <a href="#" class="badge badge-success ml-1"><?php echo number_format($business['business_rating'], 1); ?></a>
                                    </div>
                                    <div class="">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="font-weight-medium">
                                                <span class="font-12">Fee</span> <br> <span class="font-14 text-dark"><?php echo $business['business_pricing']; ?></span>
                                            </div>
                                            <div class="font-weight-medium">
                                            <span class="font-12">Rating</span> <br> <span class="font-14 text-dark"><?php echo number_format($business['business_rating'], 1); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- listing block close -->
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><p>No businesses found matching your criteria.</p></div>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <?php include 'foot.php'; ?>
</body>
</html>
