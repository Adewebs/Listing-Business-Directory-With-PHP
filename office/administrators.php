<?php 
$page_title = "Office | System Administrator";

include 'head.php';
$activePage = 'administrators.php';


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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="db-pageheader mb-4">
                                    <h2 class="h3 mb-0">List Of Administrators</h2>
                                    <p class="db-pageheader-text">Here is the list of all system Staff</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="table-responsive invoice-table">
                                        <table class="table second">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="chk_all" id="customCheck1"/></th>
                                                    <th>No.</th>
                                                    <th>Username</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $sql = "SELECT id, username, first_name, last_name, email, role FROM admin_table";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    $counter = 1;
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo '<td><input type="checkbox" class="custom-control-input checkboxes" id="customCheck' . $row['id'] . '"/></td>';
                                                        echo "<td>" . $counter++ . "</td>";
                                                        echo "<td>" . $row['username'] . "</td>";
                                                        echo "<td>" . $row['first_name'] . "</td>";
                                                        echo "<td>" . $row['last_name'] . "</td>";
                                                        echo "<td>" . $row['email'] . "</td>";
                                                        echo "<td>" . ucfirst($row['role']) . "</td>";
                                                        echo '<td>
                                                                <div class="dropdown dropright">
                                                                  <a href="#" class="btn" id="dropdownMenuButton' . $row['id'] . '" data-toggle="dropdown">
                                                                    <i class="fas fa-ellipsis-v text-muted font-12"></i>
                                                                  </a>
                                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row['id'] . '">
                                                                    <a class="dropdown-item" href="#">Edit Details</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                  </div>
                                                                </div>
                                                              </td>';
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='8'>No administrators found</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
  <!-- Edit Modal -->
  <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="editAdminForm" action="edit_admin.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="editAdminModalLabel">Edit Administrator</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Hidden input to store admin ID -->
              <input type="hidden" name="admin_id" id="editAdminId" />
              
              <!-- Username -->
              <div class="form-group">
                <label for="editUsername">Username</label>
                <input type="text" class="form-control" name="username" id="editUsername">
              </div>
              
              <!-- First Name -->
              <div class="form-group">
                <label for="editFirstName">First Name</label>
                <input type="text" class="form-control" name="first_name" id="editFirstName">
              </div>
              
              <!-- Last Name -->
              <div class="form-group">
                <label for="editLastName">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="editLastName">
              </div>

              <!-- Email -->
              <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" class="form-control" name="email" id="editEmail">
              </div>

              <!-- Role -->
              <div class="form-group">
                <label for="editRole">Role</label>
                <select class="form-control" name="role" id="editRole">
                  <option value="admin">Admin</option>
                  <option value="staff">Staff</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- JavaScript for triggering modals and sending delete requests -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
      // Handle Edit button click
      $(document).on('click', '.editAdminBtn', function() {
          var adminId = $(this).data('id');
          var username = $(this).data('username');
          var firstName = $(this).data('first_name');
          var lastName = $(this).data('last_name');
          var email = $(this).data('email');
          var role = $(this).data('role');
          
          // Fill modal with data
          $('#editAdminId').val(adminId);
          $('#editUsername').val(username);
          $('#editFirstName').val(firstName);
          $('#editLastName').val(lastName);
          $('#editEmail').val(email);
          $('#editRole').val(role);
          
          // Show modal
          $('#editAdminModal').modal('show');
      });


</body>
