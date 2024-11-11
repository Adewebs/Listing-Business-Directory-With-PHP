<?php
$page_title = "Office | Enroll Administrator";
include 'head.php';



$success_message = "";
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = $_POST['role'];

    // Check if email already exists
    $sql_check = "SELECT * FROM admin_table WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error_message = "Email already registered!";
    } else {
        // Insert new admin
        $sql = "INSERT INTO admin_table (first_name,last_name,username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_name, $last_name,$username,$email, $password, $role);

        if ($stmt->execute()) {
            $success_message = "Admin registered successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}
?>

?>
<br/>
<br/>
  <body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
            <div class="card mb-3 shadow rounded-lg border-0">
              <div class="row no-gutters">
                <div class="col-md-7">
                  <div class="card-body p-7">
                    <div class="mb-4">
                      <h3>Register</h3>
                      <p>Register An Admin</p>
                    </div>
                    <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php elseif ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
                    <form action="enroll.php" method="POST">
                      <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          aria-describedby="email"
                          placeholder="Email"
                          required=""
                          name="email"
                        />
                      </div>
                      <div class="form-group">
                        <label for="first_name" class="sr-only">First Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="first_name"
                          aria-describedby="First Name"
                          placeholder="First Name"
                          required=""
                          name="first_name"
                        />
                      </div>
                      <div class="form-group">
                        <label for="last_name" class="sr-only">Last Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="last_name"
                          aria-describedby="Last Name"
                          placeholder="Last Name"
                          required=""
                          name="last_name"
                        />
                      </div>
                      <div class="form-group">
                        <label for="username" class="sr-only">Username</label>
                        <input
                          type="text"
                          class="form-control"
                          id="username"
                          aria-describedby="Username"
                          placeholder="username"
                          required=""
                          name="username"
                        />
                      </div>

                      <div class="form-group">
                        <label for="password-field" class="sr-only"
                          >Password</label
                        >
                        <div class="input-group mb-3">
                          <input
                            id="password-field"
                            type="password"
                            class="form-control border-right-0"
                            name="password"
                            value=""
                            placeholder="*************"
                            aria-describedby="password-field"
                          />
                          <div class="input-group-append">
                            <span
                              class="input-group-text bg-white border-left-0 rounded-right fas fa-eye showhidepassword"
                              id="password-field"
                              toggle="#password-field"
                            >
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                      <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2"> -->
                      <label for="role" class="sr-only">Admin Role</label>
                      <select class="select2 form-control custom-select " id="role" name="role" required>
                     
                <option value="">Select Admin Role</option>
                <option value="Admin">Admin</option>
                <option value="Author">Author</option>
                <option value="Editor">Editor</option>
            </select>
                      </div>
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <button type="submit" class="btn btn-secondary">
                          Register
                        </button>
                        <a href="forget-password-page.html" class="font-14"> Forgot Password?</a>
                      </div>
                    </form>
                    <div class="mt-3 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="rememberme"
                        />
                        <label class="custom-control-label" for="rememberme">
                          Remember Me</label
                        >
                      </div>
                    </div>
                    <p class="mb-0">
                      Don’t have an account?<a href="#"> Contact Admin
                        
                      </a>
                    </p>
                  </div>
                </div>

                <div
                  class="col-md-5 d-none d-md-block"
                  style="
                    background: linear-gradient(
                      144.95deg,
                      #fa2aa4 -26.22%,
                      #2841f8 119.37%
                    );
                    border-radius: 0px 0.4rem 0.4rem 0px;
                  "
                >
                  <div
                    class="d-flex align-items-center justify-content-center flex-column h-100 text-center px-4"
                  >
                    <h3 class="text-white">Welcom Back!</h3>
                    <p class="text-white mb-0">
                      Provide Your Logs To Access The Adminitrative Office. 
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php

include 'foot.php';

?>