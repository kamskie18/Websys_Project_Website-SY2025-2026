<?php
session_start();
include 'db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname    = trim($_POST['first_name']);
    $lname    = trim($_POST['last_name']);
    $fullname = $fname . " " . $lname;
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "An account with that email already exists.";
        } else {
            $sql = $conn->prepare("INSERT INTO user (fullname, email, password, role) VALUES (?, ?, ?, 'customer')");
            $sql->bind_param("sss", $fullname, $email, $password);

            if ($sql->execute()) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
            $sql->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RKstore — Register</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .alert { padding:12px 16px; border-radius:10px; font-size:0.88rem; margin-bottom:20px; font-weight:600; }
    .alert-error { background:rgba(255,51,100,0.1); border:1px solid rgba(255,51,100,0.3); color:#ff3364; }
  </style>
</head>
<body>

<nav>
  <a href="home.html" class="logo">
    <div class="logo-icon">⚡</div>
    <span class="logo-text">RK<span>store</span></span>
  </a>
  <div class="nav-links">
    <a href="home.html">Home</a>
    <a href="products.php">Products</a>
    <a href="login.php" class="nav-btn">Login</a>
  </div>
</nav>

<div class="auth-wrap">
  <div class="auth-form-side">
    <div class="form-card anim-fadeup" style="max-width:460px;">
      <div class="form-head-label">// New Account</div>
      <div class="form-head-title">Create Account</div>
      <div class="form-head-sub">Join RKstore and start building your dream setup.</div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-error">✗ <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="register.php" method="POST">
        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input class="form-input" type="text" name="first_name"
              placeholder="Juan" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input class="form-input" type="text" name="last_name"
              placeholder="Dela Cruz" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input class="form-input" type="email" name="email"
            placeholder="juan@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Password</label>
            <input class="form-input" type="password" name="password" placeholder="Min. 6 chars" required>
          </div>
          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input class="form-input" type="password" name="confirm_password" placeholder="Repeat" required>
          </div>
        </div>

        <label class="form-check-wrap">
          <input type="checkbox" required>
          I agree to the <a href="#" class="form-link" style="margin:0 3px;">Terms</a> and
          <a href="#" class="form-link" style="margin-left:3px;">Privacy Policy</a>
        </label>

        <button type="submit" class="btn btn-primary btn-full btn-lg">Create Account →</button>
      </form>

      <div class="form-footer-text">
        Already have an account? <a href="login.php" class="form-link">Sign in</a>
      </div>
    </div>
  </div>

  <div class="auth-visual-side">
    <div class="auth-visual-content">
      <span class="auth-big-icon">🚀</span>
      <h2>Join the Community</h2>
      <p>Thousands of gamers and creators trust RKstore for their setup needs.</p>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:8px;">
        <div style="background:rgba(0,200,255,0.06);border:1px solid rgba(0,200,255,0.15);border-radius:12px;padding:20px;text-align:center;">
          <div style="font-family:monospace;font-size:1.6rem;font-weight:800;color:#00c8ff;">12K+</div>
          <div style="font-size:0.75rem;color:#4a5c6e;margin-top:4px;">Happy Members</div>
        </div>
        <div style="background:rgba(0,200,255,0.06);border:1px solid rgba(0,200,255,0.15);border-radius:12px;padding:20px;text-align:center;">
          <div style="font-family:monospace;font-size:1.6rem;font-weight:800;color:#00c8ff;">500+</div>
          <div style="font-size:0.75rem;color:#4a5c6e;margin-top:4px;">Products</div>
        </div>
        <div style="background:rgba(0,200,255,0.06);border:1px solid rgba(0,200,255,0.15);border-radius:12px;padding:20px;text-align:center;">
          <div style="font-family:monospace;font-size:1.6rem;font-weight:800;color:#00c8ff;">4.9★</div>
          <div style="font-size:0.75rem;color:#4a5c6e;margin-top:4px;">Avg Rating</div>
        </div>
        <div style="background:rgba(0,200,255,0.06);border:1px solid rgba(0,200,255,0.15);border-radius:12px;padding:20px;text-align:center;">
          <div style="font-family:monospace;font-size:1.6rem;font-weight:800;color:#00c8ff;">Free</div>
          <div style="font-size:0.75rem;color:#4a5c6e;margin-top:4px;">Shipping ₱5k+</div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>