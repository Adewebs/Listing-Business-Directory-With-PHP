<?php
$page_title = "Request Listing";
include 'head.php';
include 'office/traffic.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and sanitize
    $business_name = $conn->real_escape_string($_POST['business_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $business_address = $conn->real_escape_string($_POST['business_address']);
    $business_postal_code = $conn->real_escape_string($_POST['business_postal_code']);
    $business_website = $conn->real_escape_string($_POST['business_website']);
    $business_description = $conn->real_escape_string($_POST['business_description']);
    $business_pricing = $conn->real_escape_string($_POST['business_pricing']);
    $country = $conn->real_escape_string($_POST['country']);
    $city = $conn->real_escape_string($_POST['city']);

    // Handle file upload
    $target_dir = "office/uploads/";
    $target_file = basename($_FILES["business_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["business_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        echo "<div class='alert alert-danger'>File is not an image.</div>";
    }

    // Allow only certain formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
        $uploadOk = 0;
    }

    // Check if upload is allowed and move the uploaded file
    if ($uploadOk == 1 && move_uploaded_file($_FILES["business_image"]["tmp_name"], $target_file)) {
        // Insert into the listed_business_request table
        $insertQuery = "INSERT INTO listed_business_request (
            business_name, business_address, business_postal_code, 
            business_website, business_contact_line_one, 
            business_contact_email, business_pricing, 
            business_description, image, status
        ) VALUES (
            '$business_name', '$business_address', '$business_postal_code', 
            '$business_website', '$phone', '$email', 
            '$business_pricing', '$business_description', '$target_file', 0
        )";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<div class='alert alert-success'>Business listing request submitted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Sorry, your file could not be uploaded.</div>";
    }
}
?>

<body>
    <div class="">
        <?php include 'nav.php'; ?>
    </div>

    <!-- Page header -->
    <div class="pageheader" style="background: url(assets/images/pageheader-img.jpg); background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="pageheader-caption">
                        <h1 class="pageheader-caption-title">List A Business</h1>
                        <p class="pageheader-caption-text">You Can Send In Your Request To Get A Business Listed Subjected To Administrators Approval</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="inquiry-form">
                        <h3 class="h2 mb-3">We can help you list your business, just fill the form below.</h3>
                        <form class="form-row" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-6">
                                <label for="business_name">Business Name<span class="form-remark">*</span></label>
                                <input type="text" name="business_name" class="form-control" id="business_name" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email<span class="form-remark">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Phone<span class="form-remark">*</span></label>
                                <input type="tel" name="phone" class="form-control" id="phone" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="business_address">Business Address<span class="form-remark">*</span></label>
                                <input type="text" name="business_address" class="form-control" id="business_address" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="business_postal_code">Postal Code<span class="form-remark">*</span></label>
                                <input type="text" name="business_postal_code" class="form-control" id="business_postal_code" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="business_website">Website</label>
                                <input type="url" name="business_website" class="form-control" id="business_website" />
                            </div>
                            <div class="form-group col-12">
                                <label for="business_description">Business Description</label>
                                <textarea name="business_description" class="form-control" id="business_description" rows="4" required></textarea>
                            </div>
                            <div class="form-group col-6">
                                <label for="business_pricing">Pricing</label>
                                <input type="text" name="business_pricing" class="form-control" id="business_pricing" />
                            </div>
                            <div class="form-group col-6">
                                <label for="country">Country</label>
                                <select name="country" class="select2 custom-select" id="country">
                                    <option value="US">United States</option>
                                    <option value="IN">India</option>
                                    <option value="UK">United Kingdom</option>
                                    <!-- Add more countries as needed -->
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="city">City</label>
                                <select name="city" class="select2 custom-select" id="city">
                                    <option value="New York">New York</option>
                                    <option value="Ahmedabad">Ahmedabad</option>
                                    <option value="London">London</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="business_image">Business Image</label>
                                <input type="file" name="business_image" class="form-control-file" id="business_image" required />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-3">Request Listing</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

    

tinymce.init({
	    selector: '#business_description'
	});
</script>
<?php include 'foot.php'; ?>

