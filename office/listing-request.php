<?php 
$page_title = "Office | Listing Request";
include 'head.php'; 
$activePage = 'listing-request.php';

// Connect to the database
// include 'db_connect.php'; // assuming you have this for your DB connection

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_listing'])) {
    $id = $_POST['id'];
    
    // Initialize an empty array for fields to update
    $updateFields = [];

    // Check if each field has been updated and add it to the updateFields array
    if (!empty($_POST['business_name'])) {
        $business_name = $conn->real_escape_string($_POST['business_name']);
        $updateFields[] = "business_name = '$business_name'";
    }
    if (!empty($_POST['business_address'])) {
        $business_address = $conn->real_escape_string($_POST['business_address']);
        $updateFields[] = "business_address = '$business_address'";
    }
    if (!empty($_POST['business_pricing'])) {
        $business_pricing = $conn->real_escape_string($_POST['business_pricing']);
        $updateFields[] = "business_pricing = '$business_pricing'";
    }
    if (!empty($_POST['business_rating'])) {
        $business_rating = $conn->real_escape_string($_POST['business_rating']);
        $updateFields[] = "business_rating = '$business_rating'";
    }
    if (!empty($_POST['business_description'])) {
        $business_description = $conn->real_escape_string($_POST['business_description']);
        $updateFields[] = "business_description = '$business_description'";
    }

    // Only update fields that have changed
    if (!empty($updateFields)) {
        $updateQuery = "UPDATE  listed_business_request SET " . implode(', ', $updateFields) . " WHERE id = '$id'";
        $conn->query($updateQuery);
    }
}

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_listing'])) {
    $id = $_POST['id'];
    $deleteQuery = "DELETE FROM  listed_business_request WHERE id = '$id'";
    $conn->query($deleteQuery);
}

// Pagination settings
$items_per_page = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 10;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get total number of records
$totalQuery = "SELECT COUNT(*) AS total FROM  listed_business_request";
$totalResult = $conn->query($totalQuery);
$total = $totalResult->fetch_assoc()['total'];
$total_pages = ceil($total / $items_per_page);

// Fetch business listings with pagination
$query = "SELECT * FROM  listed_business_request LIMIT $items_per_page OFFSET $offset";
$listings = $conn->query($query);



// Handle Approve Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_listing'])) {
    $id = $_POST['id'];

    // Fetch the record from listed_business_request
    $fetchQuery = "SELECT * FROM listed_business_request WHERE id = '$id'";
    $result = $conn->query($fetchQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Insert the record into listed_business with status = 1
        $insertQuery = "
            INSERT INTO listed_business 
            (business_name, business_address, business_postal_code, business_website, business_contact_line_one, business_contact_line_two, business_contact_email, business_pricing, business_opening_hour, business_description, business_rating, image, status)
            VALUES (
                '{$conn->real_escape_string($row['business_name'])}',
                '{$conn->real_escape_string($row['business_address'])}',
                '{$conn->real_escape_string($row['business_postal_code'])}',
                '{$conn->real_escape_string($row['business_website'])}',
                '{$conn->real_escape_string($row['business_contact_line_one'])}',
                '{$conn->real_escape_string($row['business_contact_line_two'])}',
                '{$conn->real_escape_string($row['business_contact_email'])}',
                '{$conn->real_escape_string($row['business_pricing'])}',
                '{$conn->real_escape_string($row['business_opening_hour'])}',
                '{$conn->real_escape_string($row['business_description'])}',
                '{$conn->real_escape_string($row['business_rating'])}',
                '{$conn->real_escape_string($row['image'])}',
                1 -- Set status to 1 for approved
            )
        ";

        if ($conn->query($insertQuery)) {
            // After inserting, delete the record from listed_business_request
            $deleteQuery = "DELETE FROM listed_business_request WHERE id = '$id'";
            $conn->query($deleteQuery);
            //echo "<div class='alert alert-success'>Business approved and moved to listed businesses.</div>";
        }

    }
}
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
                            <div class="col-xl-12 mb-4">
                                <div class="row d-lg-flex justify-content-between align-items-center">
                                    <div class="col-md-9">
                                        <h2 class="h3">Listing Request Management</h2>
                                        <p>Manage All Requested Listed Business here.</p>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <a href="add-listing.php" class="btn btn-secondary"> Add new listing</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Items per page selector -->
                        <form method="GET" class="mb-4">
                            <label for="items_per_page">Show</label>
                            <select name="items_per_page" onchange="this.form.submit()">
                                <option value="10" <?= $items_per_page == 10 ? 'selected' : '' ?>>10</option>
                                <option value="20" <?= $items_per_page == 20 ? 'selected' : '' ?>>20</option>
                                <option value="50" <?= $items_per_page == 50 ? 'selected' : '' ?>>50</option>
                            </select>
                            items per page
                        </form>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-lines-tab">
                                    <ul class="nav nav-pills card-header">
                                        <li class="nav-item">
                                            <a class="nav-link active">All Requested Listings</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content card">
                                        <div class="tab-pane fade show active">
                                            <div class="table-responsive listing-table">
                                                <table class="table first">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Date</th>
                                                            <th>Reviews</th>
                                                            <th>Fee</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($row = $listings->fetch_assoc()): ?>
                                                        <tr>
                                                            <td>
                                                                <div class="listing-table-img">
                                                                    <img src="uploads/<?= $row['image'] ?>" class="rounded-circle icon-shape icon-sm">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="listing-table-head">
                                                                    <h4 class="h6 text-truncate mb-0">
                                                                        <a href="#" class="text-dark"><?= $row['business_name'] ?></a>
                                                                    </h4>
                                                                    <p class="listing-table-head-text"><?= $row['business_address'] ?></p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-14"><?= date('d M, Y', strtotime($row['create_at'])) ?></div>
                                                            </td>
                                                            <td><?= $row['business_rating'] ?></td>
                                                            <td><?= $row['business_pricing'] ?></td>
                                                            <td>
                                                                <span class="badge <?= $row['status'] == 1 ? 'badge-success' : 'badge-danger' ?>">
                                                                    <?= $row['status'] == 1 ? 'Approved' : 'Pending' ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#editModal<?= $row['id'] ?>">Edit</a> |
                                                                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                                    <input type="hidden" name="delete_listing" value="1">
                                                                    <button type="submit" style="border:none;background:none;color:red;">Delete</button> 

                                                                </form>
                                                                |
                                                                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to approve this listing?');">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="approve_listing" value="1">
        <button type="submit" style="border:none;background:none;color:green;">Approve</button>
    </form>
                                                            </td>
                                                        </tr>

                                                        <!-- Edit Modal -->
                                                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Listing</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="POST" action="">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                                            <input type="hidden" name="edit_listing" value="1">
                                                                            <div class="form-group">
                                                                                <label for="business_name">Business Name</label>
                                                                                <input type="text" name="business_name" class="form-control" value="<?= $row['business_name'] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="business_address">Business Address</label>
                                                                                <input type="text" name="business_address" class="form-control" value="<?= $row['business_address'] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="business_pricing">Business Pricing</label>
                                                                                <input type="text" name="business_pricing" class="form-control" value="<?= $row['business_pricing'] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="business_rating">Business Rating</label>
                                                                                <input type="text" name="business_rating" class="form-control" value="<?= $row['business_rating'] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="business_description">Business Description</label>
                                                                                <textarea name="business_description" class="form-control"><?= $row['business_description'] ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>

                                                <!-- Pagination Links -->
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination justify-content-center">
                                                        <?php if ($current_page > 1): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?= $current_page - 1 ?>&items_per_page=<?= $items_per_page ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                            <a class="page-link" href="?page=<?= $i ?>&items_per_page=<?= $items_per_page ?>"><?= $i ?></a>
                                                        </li>
                                                        <?php endfor; ?>
                                                        <?php if ($current_page < $total_pages): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?= $current_page + 1 ?>&items_per_page=<?= $items_per_page ?>" aria-label="Next">
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
                            </div>
                        </div>

                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>

<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

    

tinymce.init({
	    selector: '#business_description'
	});
</script>