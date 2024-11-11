<?php
$page_title = "Office | Access Office";

include 'head.php';



$success_message = "";
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM admin_table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Store user information in session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['first_name'] = $admin['first_name'];
            $_SESSION['last_name'] = $admin['last_name'];
            $_SESSION['admin_role'] = $admin['role'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['username'] = $admin['username'];

            $success_message = "Login successful! Welcome, " . $admin['name'] . " (" . $admin['role'] . ")";
            // Redirect to a protected page
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No account found with that email!";
    }
}

?>

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
                      <h3>Login</h3>
                      <p>Login to your account</p>
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
                    <form action="login.php" method="POST">
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
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <button type="submit" class="btn btn-secondary">
                          Sign In
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