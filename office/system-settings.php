<?php
$page_title = "Office | System Settings";
// Include necessary files
include 'head.php'; // Contains DB connection
$activePage = 'system-settings.php';


// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve data from the form
    $directory_name = !empty($_POST['directory_name']) ? $_POST['directory_name'] : null;
    $directory_tagline = !empty($_POST['directory_tagline']) ? $_POST['directory_tagline'] : null;
    $directory_description = !empty($_POST['directory_description']) ? $_POST['directory_description'] : null;
    $directory_about = !empty($_POST['directory_about']) ? $_POST['directory_about'] : null;
    $directory_phone_one = !empty($_POST['directory_phone_one']) ? $_POST['directory_phone_one'] : null;
    $directory_phone_two = !empty($_POST['directory_contact_two']) ? $_POST['directory_contact_two'] : null;
    $address = !empty($_POST['address']) ? $_POST['address'] : null;
    $directory_iframe_link = !empty($_POST['directory_iframe_link']) ? $_POST['directory_iframe_link'] : null;

    // Check if there is already a row in the settings table
    $query = "SELECT * FROM directory_settings WHERE id = 1"; // Assuming the site settings table has a fixed ID
    $result = $conn->query($query);

    // Prepare SQL based on whether row exists
    if ($result->num_rows > 0) {
        // Row exists, update only the provided fields
        $updateQuery = "UPDATE directory_settings SET ";
        $fieldsToUpdate = [];

        if ($directory_name) $fieldsToUpdate[] = "directory_name = '$directory_name'";
        if ($directory_tagline) $fieldsToUpdate[] = "directory_tagline = '$directory_tagline'";
        if ($directory_description) $fieldsToUpdate[] = "directory_description = '$directory_description'";
        if ($directory_about) $fieldsToUpdate[] = "directory_about = '$directory_about'";
        if ($directory_phone_one) $fieldsToUpdate[] = "phone_one = '$directory_phone_one'";
        if ($directory_phone_two) $fieldsToUpdate[] = "phone_two = '$directory_phone_two'";
        if ($address) $fieldsToUpdate[] = "address = '$address'";
        if ($directory_iframe_link) $fieldsToUpdate[] = "iframe_link = '$directory_iframe_link'";

        // If there are fields to update
        if (!empty($fieldsToUpdate)) {
            $updateQuery .= implode(", ", $fieldsToUpdate) . " WHERE id = 1";
            $conn->query($updateQuery);
        }

    } else {
        // Row does not exist, insert new data
        $insertQuery = "INSERT INTO directory_settings (directory_name, directory_tagline, 
        directory_description, directory_about, directory_contact_phone_one, 
        directory_contact_phone_two, directory_address, directory_google_map_iframe_link) 
                        VALUES ('$directory_name', '$directory_tagline', '$directory_description', '$directory_about', '$directory_phone_one', '$directory_phone_two', '$address', '$directory_iframe_link')";
        $conn->query($insertQuery);
    }
}

// Handle image upload separately
if (isset($_FILES['directory_image']) && $_FILES['directory_image']['error'] === UPLOAD_ERR_OK) {
    // Handle image upload
    $uploadDir = 'uploads/';
    $imageName = basename($_FILES['directory_image']['name']);
    $targetFile = $uploadDir . $imageName;

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['directory_image']['tmp_name'], $targetFile)) {
        // Update image path in database
        $conn->query("UPDATE directory_settings SET directory_logo = '$targetFile' WHERE id = 1");
    }
}
?>


  <body class="bg-light">
    <div class="db-wrapper">
      <div class="db-header">
        <!-- header start -->
        <!-- navigation start -->
        <?php include 'nav.php'; ?>
        <!-- navigation close -->
        <!-- header close -->
      </div>
      <div class="db-content py-lg-15 py-11">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
              <!-- navigation start -->
              <?php include 'sidenav.php'; ?>
              <!-- navigation close -->
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <!-- pageheader start -->
                  <div class="db-pageheader mb-4">
                    <h2 class="h3 mb-0">System Settings</h2>
                    <p class="db-pageheader-text">
                      Configure System To Suit your use case
                    </p>
                  </div>
                  <!-- pageheader close -->
                </div>
              </div>
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <!-- card line tab start -->
                  <div class="card-lines-tab">
                    <ul
                      class="nav nav-pills card-header"
                      id="pills-tab"
                      role="tablist"
                    >
                      <li class="nav-item">
                        <a
                          class="nav-link active"
                          id="pills-editprofile-tab"
                          data-toggle="pill"
                          href="#pills-editprofile"
                          role="tab"
                          aria-controls="pills-editprofile"
                          aria-selected="true"
                          >Basic Config</a
                        >
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          id="pills-password-tab"
                          data-toggle="pill"
                          href="#pills-password"
                          role="tab"
                          aria-controls="pills-password"
                          aria-selected="false"
                          >Contact</a
                        >
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          id="pills-updatephoto-tab"
                          data-toggle="pill"
                          href="#pills-updatephoto"
                          role="tab"
                          aria-controls="pills-updatephoto"
                          aria-selected="false"
                          >Update photo</a
                        >
                      </li>
                      
                    </ul>
                    <div class="tab-content card-body" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="pills-editprofile"
                        role="tabpanel"
                        aria-labelledby="pills-editprofile-tab"
                      >
                        <form class="form-row"  method="POST" enctype="multipart/form-data">
                          <div class="form-group col-md-6">
                            <label for="directory_name">Directory Name</label>
                            <input type="text" class="form-control" name="directory_name" 
                            id="directory_name" placeholder="Directory Name" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="directory_tagline">Hero Tagline</label>
                            <input type="text" class="form-control" name="directory_tagline" id="directory_tagline" placeholder="Tagline" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="directory_description">Description</label>
                                
                            <textarea class="form-control" name="directory_description" 
                            id="directory_description" placeholder="Description"></textarea>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="profilenumber">About</label>
                            
                            <textarea class="form-control" name="directory_about" id="directory_about" 
                            placeholder="About"></textarea>
</textarea>
                            
                          </div>
                          <br/>
                          <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">
                              Save
                            </button>
                          </div>
                        
                      </div>
                      <div
                        class="tab-pane fade"
                        id="pills-updatephoto"
                        role="tabpanel"
                        aria-labelledby="pills-updatephoto-tab"
                      >
                        
                        <input type="file" class="dropzone" name="directory_image" id="directory_image" />
                        <div class="form-group col-md-6">
                            
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
                      </div>
                      
                      <div
                        class="tab-pane fade"
                        id="pills-password"
                        role="tabpanel"
                        aria-labelledby="pills-password-tab"
                      >
                     
                        <div class="form-group col-md-6">
                            <label for="profilenumber">First Phone</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <button
                                  class="form-control dropdown-toggle"
                                  type="button"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  +234
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#">+44</a>
                                  <a class="dropdown-item" href="#">+22</a>
                                </div>
                              </div>
                              <input type="text" class="form-control" name="directory_phone_one" 
                              id="directory_phone_one" placeholder="Line One" />
                            </div>
                          </div>

                          <!-- second phone -->
                          <div class="form-group col-md-6">
                            <label for="profilenumber">Second Phone</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <button
                                  class="form-control dropdown-toggle"
                                  type="button"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  +234
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#">+44</a>
                                  <a class="dropdown-item" href="#">+22</a>
                                </div>
                              </div>
                              <input type="text" class="form-control" name="directory_contact_two" 
                              id="directory_contact_two" placeholder="Line Two" />
                            </div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="rewritenewpassword"
                              >Address One</label
                            >
                            <input type="text" class="form-control" name="address" id="address" placeholder="Company Address" />
                          </div>
                          <!-- address two -->
                          <div class="form-group col-md-6">
                            <label for="address_two"
                              >Googel Iframe Link</label>
                              <input type="text" class="form-control" name="directory_iframe_link" 
                              id="directory_iframe_link" placeholder="Google Iframe Link" />
                          </div>
                          <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-primary">
                            Save
                          </button>
</div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- card line tab close -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- footer start -->

      <!-- footer close -->
    </div>
    <?php include 'foot.php'; ?>