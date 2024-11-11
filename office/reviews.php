
<?php 
// Include database connection
include 'head.php';
$page_title = "Office | Business Reviews";
$activePage = 'reviews.php';

// Define the number of reviews per page
$reviews_per_page = 10;

// Fetch total reviews and average rating
$total_reviews_query = "SELECT COUNT(*) as total_reviews, AVG(business_rating) as average_rating FROM business_review";
$total_reviews_result = $conn->query($total_reviews_query);
$total_reviews_data = $total_reviews_result->fetch_assoc();
$total_reviews = $total_reviews_data['total_reviews'];
$average_rating = number_format($total_reviews_data['average_rating'], 1);

// Fetch reviews with pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $reviews_per_page;

$search_query = isset($_POST['search']) ? $_POST['search'] : '';
$sort_option = isset($_POST['sort']) ? $_POST['sort'] : 'date';

$order_by = 'review_time DESC'; // Default sorting by date
if ($sort_option == 'high_review') {
    $order_by = 'business_rating DESC';
} elseif ($sort_option == 'low_review') {
    $order_by = 'business_rating ASC';
}

// Fetch reviews from database with optional search and sorting
$reviews_query = "SELECT * FROM business_review WHERE business_id LIKE '%$search_query%' ORDER BY $order_by LIMIT $reviews_per_page OFFSET $offset";
$reviews_result = $conn->query($reviews_query);
?>

<body class="bg-light">
    <div class="db-wrapper">
        <div class="db-header">
            <?php include 'nav.php';?>
        </div>
        <div class="db-content py-lg-15 py-11">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <?php include 'sidenav.php';?>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="db-pageheader d-xl-flex justify-content-between mb-4">
                                    <div class="">
                                        <h2 class="h3 mb-0">Reviews</h2>
                                        <p class="db-pageheader-text">All Businesses Reviews.</p>
                                    </div>
                                    <div class="d-xl-flex align-items-center">
                                        <a href="#" class="btn btn-primary"> Ask Reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mb-lg-0">
                                <div class="card db-overview-widget h-100">
                                    <div class="card-body">
                                        <h3 class="h6 mb-3">Reviews</h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="font-weight-bold h2 mb-0">
                                                <?php echo $total_reviews; ?>
                                            </h3>
                                            <span class="db-overview-widget-body-icon">
                                                <i class="fas fa-star icon-shape icon-lg bg-light rounded-circle text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mb-lg-0">
                                <div class="card db-overview-widget h-100">
                                    <div class="card-body">
                                        <h3 class="h6 mb-3">Average Rating</h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="font-weight-bold h2 mb-0">
                                                <?php echo $average_rating; ?>
                                            </h3>
                                            <div class="review-content-rating small pt-2">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <i class="fas fa-star <?php echo ($i < floor($average_rating)) ? 'text-warning' : 'text-light'; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="review-form mt-4">
                                    <h5 class="mb-3">All Reviews</h5>
                                    <form method="POST">
                                        <div class="form-row">
                                            <div class="col-md-5 mb-2 mb-lg-0 ">
                                                <input type="text" class="form-control" name="search" placeholder="Search by Business ID" value="<?php echo htmlspecialchars($search_query); ?>" />
                                            </div>
                                            <div class="col-md-5 mb-2 mb-lg-0 ">
                                                <select class="select2 custom-select mb-1" name="sort">
                                                    <option selected value="">Sort</option>
                                                    <option value="date" <?php if($sort_option == 'date') echo 'selected'; ?>>Sort by Date</option>
                                                    <option value="high_review" <?php if($sort_option == 'high_review') echo 'selected'; ?>>Sort by High Review</option>
                                                    <option value="low_review" <?php if($sort_option == 'low_review') echo 'selected'; ?>>Sort by Low Review</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary btn-block btn-lg" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                                <?php while ($review = $reviews_result->fetch_assoc()): ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-xl-flex justify-content-between">
                                                <div class="review-content-head">
                                                    <h3 class="h4"><?php echo htmlspecialchars($review['business_id']); ?></h3>
                                                    <div class="mb-3 font-12">
                                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                                            <span class="fas fa-star <?php echo ($i < floor($review['business_rating'])) ? 'text-warning' : 'text-light'; ?>"></span>
                                                        <?php endfor; ?>
                                                        <a href="listing-single.html" class="badge badge-success ml-2"><?php echo htmlspecialchars($review['business_rating']); ?></a>
                                                    </div>
                                                </div>
                                                <div class="d-xl-flex align-items-center">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck<?php echo $review['id']; ?>" />
                                                        <label class="custom-control-label" for="customCheck<?php echo $review['id']; ?>">Hidden</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" id="customCheckFeatured<?php echo $review['id']; ?>" />
                                                        <label class="custom-control-label" for="customCheckFeatured<?php echo $review['id']; ?>">Featured</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="mb-2"><?php echo htmlspecialchars($review['reviewer_name']); ?></h5>
                                            <p class="review-content-text"><?php echo htmlspecialchars($review['reviewer_comment']); ?></p>
                                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseResponse<?php echo $review['id']; ?>" role="button" aria-expanded="false" aria-controls="collapseResponse<?php echo $review['id']; ?>">Respond</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                        <div class="collapse" id="collapseResponse<?php echo $review['id']; ?>">
                                            <div class="card">
                                                <h5 class="card-header bg-white h6">Respond to review</h5>
                                                <div class="card-body">
                                                    <div class="review-content-head">
                                                        <h3 class="h4"><?php echo htmlspecialchars($review['business_id']); ?></h3>
                                                        <div class="mb-3 font-12">
                                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                                <span class="fas fa-star <?php echo ($i < floor($review['business_rating'])) ? 'text-warning' : 'text-light'; ?>"></span>
                                                            <?php endfor; ?>
                                                            <a href="listing-single.html" class="badge badge-success ml-2"><?php echo htmlspecialchars($review['business_rating']); ?></a>
                                                        </div>
                                                    </div>
                                                    <form method="POST" action="submit_response.php">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="response" placeholder="Write your response here..." required></textarea>
                                                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>" />
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit Response</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php 
                                        $total_pages = ceil($total_reviews / $reviews_per_page);
                                        for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_query); ?>&sort=<?php echo $sort_option; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'foot.php'; ?>
    </div>
</body>
</html>
