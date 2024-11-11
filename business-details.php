<?php
$page_title = "Business Listing";
include 'head.php';
include 'office/traffic.php';

if (isset($_GET['id'])) {
    $business_id = intval($_GET['id']); // Ensure business_id is an integer

    // Fetch business details
    $sql = "SELECT * FROM listed_business WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $business_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $business = $result->fetch_assoc();
        } else {
            echo '<div class="alert alert-danger">No business found!</div>';
            exit;
        }
        $stmt->close();
    }
} else {
    echo '<div class="alert alert-danger">No business ID provided!</div>';
    exit;
}

// Handle voting
if (isset($_POST['vote'])) {
    $review_id = intval($_POST['review_id']); // Ensure review_id is an integer
    $vote_type = $_POST['vote'] == 'upvote' ? 'upvotes' : 'downvotes';

    $vote_sql = "UPDATE business_review SET $vote_type = $vote_type + 1 WHERE id = ?";
    if ($stmt = $conn->prepare($vote_sql)) {
        $stmt->bind_param("i", $review_id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }
}

// Insert new review or replies
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['vote'])) {
    $reviewer_name = htmlspecialchars(trim($_POST['name'])); // Sanitize input
    $reviewer_comment = htmlspecialchars(trim($_POST['comment'])); // Sanitize input
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null; // Ensure parent_id is an integer
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0; // Ensure rating is an integer

    $sql = "INSERT INTO business_review (business_id, reviewer_name, reviewer_comment, business_rating, parent_id, upvotes, downvotes) VALUES (?, ?, ?, ?, ?, 0, 0)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issii", $business_id, $reviewer_name, $reviewer_comment, $rating, $parent_id);
        if ($stmt->execute()) {
            header("Location: business-details.php?id=$business_id");
            exit;
        } else {
            echo '<div class="alert alert-danger">Error: Unable to submit review. Please try again later.</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Error: Could not prepare SQL statement.</div>';
    }
}

// Pagination setup
$reviews_per_page = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; // Ensure page number is at least 1
$offset = ($page - 1) * $reviews_per_page;

// Fetch reviews and replies with pagination
$reviews_sql = "SELECT * FROM business_review WHERE business_id = ? AND parent_id IS NULL ORDER BY review_time DESC LIMIT ?, ?";
if ($stmt = $conn->prepare($reviews_sql)) {
    $stmt->bind_param("iii", $business_id, $offset, $reviews_per_page);
    $stmt->execute();
    $result = $stmt->get_result();
    $reviews = [];
    while ($review = $result->fetch_assoc()) {
        $reviews[] = $review;
    }
    $stmt->close();
} else {
    echo '<div class="alert alert-danger">Error: Could not fetch reviews.</div>';
}

// Fetch total review count and average rating
$total_reviews_sql = "SELECT COUNT(*) AS total_reviews FROM business_review WHERE business_id = ?";
$average_rating_sql = "SELECT AVG(business_rating) AS average_rating FROM business_review WHERE business_id = ?";
if ($stmt = $conn->prepare($total_reviews_sql)) {
    $stmt->bind_param("i", $business_id);
    $stmt->execute();
    $stmt->bind_result($total_reviews);
    $stmt->fetch();
    $stmt->close();
}
if ($stmt = $conn->prepare($average_rating_sql)) {
    $stmt->bind_param("i", $business_id);
    $stmt->execute();
    $stmt->bind_result($average_rating);
    $stmt->fetch();
    $stmt->close();
}
$average_rating_display = number_format($average_rating, 1);
$total_pages = ceil($total_reviews / $reviews_per_page);
?>

<body>
<div>
    <?php include 'nav.php'; ?>
</div>
 <!-- listing slider start -->
 <div class="listing-slider-section">
        <div class="listing-slider">
            <div class="item">
                <img src="assets/images/listing-slider-img-1.jpg" alt="" height="300px" class="w-100">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-n8">
                    <ul class="list-inline text-right">
                        <li class="list-inline-item mr-3">
                            <span class="badge badge-success badge-pill"><i class="fas fa-award mr-2"></i>Verified Space</span>
                        </li>
                        <li class="list-inline-item">
                            <div class=""><div class="btn-wishlist"></div></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="listing-nav sticky">
                    <ul>
                        <li><a class="page-scroll" href="#overview">Overview</a></li>
                        <li><a class="page-scroll" href="#about">About</a></li>
                        <li><a class="page-scroll" href="#review">Reviews</a></li>
                        <li><a class="page-scroll" href="#location">Location</a></li>
                        <li><a class="page-scroll" href="#similarspace">Similar Space</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                    <div class="card mb-4" id="overview">
                        <div class="card-header bg-white p-5">
                            <h1 class="h2"><?php echo htmlspecialchars($business['business_name']); ?></h1>
                            <p class="">
                                <span class="map-icon mr-2"><i class="fas fa-map-marker-alt"></i></span>
                                <?php echo htmlspecialchars($business['business_address']); ?> - <?php echo htmlspecialchars($business['business_postal_code']); ?>
                                <a href="#location" class="btn-link ml-2 page-scroll font-weight-bold">See Location</a>
                            </p>
                        </div>
                        <div class="">
                            <div class="row no-gutters">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 border-right">
                                    <div class="card-body">
                                        <div class="meta-icon h3 text-primary mb-3"><i class="fas fa-calendar-alt"></i></div>
                                        <h5 class="meta-lable mb-1">Opening Hour</h5>
                                        <span class="meta-value"><?php echo htmlspecialchars($business['business_opening_hour']); ?></span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                                    <div class="card-body ml-1">
                                        <div class="meta-icon h3 text-primary mb-3"><i class="fas fa-star"></i></div>
                                        <h5 class="meta-lable mb-1">Rating</h5>
                                        <span class="meta-value"><?php echo htmlspecialchars($business['business_rating']); ?></span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 border-right">
                                    <div class="card-body ml-1">
                                        <div class="meta-icon h3 text-primary mb-3"><i class="fas fa-users"></i></div>
                                        <h5 class="meta-lable mb-1">Reviews</h5>
                                        <span class="meta-value"><?php echo $total_reviews; ?> - <?php echo htmlspecialchars($average_rating_display); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="card-body ml-1">
                                        <div class="meta-icon h3 text-primary mb-3"><i class="fas fa-wallet"></i></div>
                                        <h5 class="meta-lable mb-1">Fee</h5>
                                        <span class="meta-value"><?php echo htmlspecialchars($business['business_pricing']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body mb-4 p-4" id="about">
                        <h4 class="card-title">Description</h4>
                        <p><?php echo htmlspecialchars_decode($business['business_description']); ?></p>
                    </div>

<div class="container">
    <div class="pb-5 pt-5">
        <div class="card card-body mb-4 reviews p-4" id="review">
            <h3><?php echo $total_reviews; ?> Review(s) on <?php echo htmlspecialchars($business['business_name']); ?></h3>
            <a href="#reviewform" class="btn btn-primary">Write a Review</a>

            <?php foreach ($reviews as $review): ?>
                <div class="media mb-4">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlspecialchars($review['reviewer_name']); ?> (Rating: <?php echo htmlspecialchars($review['business_rating']); ?>)</h5>
                        <p><?php echo nl2br(htmlspecialchars($review['reviewer_comment'])); ?></p>

                        <button class="btn btn-outline-secondary btn-sm" onclick="toggleReplyForm(<?php echo $review['id']; ?>)">Reply</button>
                        <button class="btn btn-success btn-sm" onclick="vote(<?php echo $review['id']; ?>, 'upvote')">Upvote (<?php echo $review['upvotes']; ?>)</button>
                        <button class="btn btn-danger btn-sm" onclick="vote(<?php echo $review['id']; ?>, 'downvote')">Downvote (<?php echo $review['downvotes']; ?>)</button>

                        <!-- Reply Form -->
                        <div id="reply-form-<?php echo $review['id']; ?>" style="display:none;" class="mt-3">
                            <form method="post" action="">
                                <input type="hidden" name="parent_id" value="<?php echo $review['id']; ?>">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea name="comment" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating:</label>
                                    <select name="rating" class="form-control" required>
                                        <option value="0">Select Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                            </form>
                        </div>

                        <!-- Render replies -->
                        <?php
                        $parent_id = $review['id'];
                        $replies_sql = "SELECT * FROM business_review WHERE parent_id = ? ORDER BY review_time ASC";
                        if ($reply_stmt = $conn->prepare($replies_sql)) {
                            $reply_stmt->bind_param("i", $parent_id);
                            $reply_stmt->execute();
                            $reply_result = $reply_stmt->get_result();
                            while ($reply = $reply_result->fetch_assoc()) {
                                echo '<div class="mt-3 ml-4 reply"><strong>' . htmlspecialchars($reply['reviewer_name']) . '</strong>: ' . nl2br(htmlspecialchars($reply['reviewer_comment'])) . '</div>';
                            }
                            $reply_stmt->close();
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?id=<?php echo $business_id; ?>&page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?id=<?php echo $business_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="?id=<?php echo $business_id; ?>&page=<?php echo $page + 1; ?>">
                        Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- New Review Form -->
            <div id="reviewform" class="mt-4">
                <h4>Write a Review</h4>
                <form method="post" action="">
                    <input type="hidden" name="business_id" value="<?php echo $business_id; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea name="comment" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select name="rating" class="form-control" required>
                            <option value="0">Select Rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Function to toggle reply form visibility
function toggleReplyForm(reviewId) {
    const replyForm = document.getElementById('reply-form-' + reviewId);
    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
}

// Function to handle voting
function vote(reviewId, voteType) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "business-details.php?id=<?php echo $business_id; ?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        const response = JSON.parse(xhr.responseText);
        if (response.status === 'success') {
            location.reload(); // Refresh the page to see updated votes
        } else {
            alert('Error occurred while voting. Please try again later.');
        }
    };
    xhr.send("vote=" + voteType + "&review_id=" + reviewId);
}
</script>

</body>
</html>

