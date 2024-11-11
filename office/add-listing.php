<?php
$page_title = "Office | Add Business";

include 'head.php';
$activePage = 'add-listing.php';
// Check for success or error messages
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear the message after displaying
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $business_name = $_POST['business_name'];
    $business_address = $_POST['business_address'];
    $business_postal_code = $_POST['business_postal_code'] ?? null;
    $business_contact_line_one = $_POST['business_contact_line_one'];
    $business_pricing = $_POST['business_pricing'];
    $business_description = $_POST['business_description']; // This contains the rich text
    $contact_email = $_POST['email'];
    $company_website = $_POST['business_contact_line_one'];
    $approve_status = 1;
    
    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Allow only certain formats
            if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                // Try to move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                } else {
                    $_SESSION['message'] = "Error uploading image.";
                    header("Location: add-listing.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                header("Location: add-listing.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "File is not an image.";
            header("Location: add-listing.php");
            exit;
        }
    }

    // Insert into the database
    $query = "INSERT INTO listed_business (business_name, business_address, business_postal_code, 
    business_contact_line_one, business_pricing, business_description, business_website, 
    business_contact_email, status, image) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssssi', $business_name, $business_address, $business_postal_code, 
        $business_contact_line_one, $business_pricing, $business_description, 
        $company_website, $contact_email, $approve_status, $image);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Listing successfully saved!";
        header("Location: add-listing.php");
        exit; // Make sure to exit after redirecting
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
        header("Location: add-listing.php");
        exit; // Make sure to exit after redirecting
    }
   
}
?>

<body class="bg-light">
    <div class="db-wrapper">
        <div class="db-header">
            <!-- navigation start -->
            <?php include 'nav.php'; ?>
            <!-- navigation close -->
        </div>
        <div class="db-content py-lg-15 py-11">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <!-- sidebar start -->
                        <?php include 'sidenav.php'; ?>
                        <!-- sidebar close -->
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="h3 mb-0">Add New Listing</h2>
                                <h4><?php
// Check if message is set
if (isset($_SESSION['message'])) {
   echo $_SESSION['message'];
}
?></h4>
                                <form method="POST" action="add-listing.php" enctype="multipart/form-data">
                                    <!-- Business Name -->
                                    <div class="form-group">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Your Business Name" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Contact Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>

                                    <!-- Website -->
                                    <div class="form-group">
                                        <label for="website">Company Website</label>
                                        <input type="text" class="form-control" id="website" name="business_contact_line_one" placeholder="Website">
                                    </div>

                                    <!-- Business Address -->
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="business_address" placeholder="Business Address" required>
                                    </div>

                                    <!-- Postal Code -->
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control" id="postal_code" name="business_postal_code" placeholder="Postal Code">
                                    </div>

                                    <!-- Business Contact -->
                                    <div class="form-group">
                                        <label for="contact">Contact Line One</label>
                                        <input type="text" class="form-control" id="contact" name="business_contact_line_one" placeholder="Contact Line One">
                                    </div>

                                    <!-- Description (with TinyMCE) -->
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="business_description" name="business_description" class="form-control" rows="10"></textarea>
                                    </div>

                                    <!-- Price -->  
                                    <div class="form-group">
                                        <label for="business_pricing">Price</label>
                                        <input type="text" class="form-control" id="business_pricing" name="business_pricing" placeholder="Pricing" required>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="form-group">
                                        <label for="image">Upload Image</label>
                                        <input type="file" class="form-control" id="image" name="image" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Save Listing</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#business_description'
    });
</script>
