<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error   = "";
$success = "";

if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    $success = "Account created! You can now sign in.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter your email and password.";
    } else {
        $stmt = $conn->prepare("SELECT user_id, fullname, email, password, role FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Supports both plain-text (old users) and hashed (new users)
            $algo = password_get_info($user['password'])['algo'];
            if ($algo !== null && $algo !== 0) {
                $passwordMatch = password_verify($password, $user['password']);
            } else {
                $passwordMatch = ($password === $user['password']);
            }

            if ($passwordMatch) {
                $_SESSION['user_id']  = $user['user_id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email']    = $user['email'];
                $_SESSION['role']     = $user['role'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password. Please try again.";
            }
        } else {
            $error = "No account found with that email.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RKstore — Login</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .alert { padding:12px 16px; border-radius:10px; font-size:0.88rem; margin-bottom:20px; font-weight:600; }
    .alert-error   { background:rgba(255,51,100,0.1); border:1px solid rgba(255,51,100,0.3); color:#ff3364; }
    .alert-success { background:rgba(0,255,136,0.08); border:1px solid rgba(0,255,136,0.25); color:#00ff88; }
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
    <a href="register.php" class="nav-btn">Register</a>
  </div>
</nav>

<div class="auth-wrap">
  <div class="auth-form-side">
    <div class="form-card anim-fadeup">
      <div class="form-head-label">// Access Portal</div>
      <div class="form-head-title">Welcome Back</div>
      <div class="form-head-sub">Sign in to your RKstore account to continue.</div>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success">✓ <?= htmlspecialchars($success) ?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <div class="alert alert-error">✗ <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="login.php" method="POST">
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input class="form-input" type="email" id="email" name="email"
            placeholder="juan@email.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input class="form-input" type="password" id="password" name="password"
            placeholder="••••••••" required>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px;">
          <label class="form-check-wrap" style="margin-bottom:0;">
            <input type="checkbox" name="remember"> Remember me
          </label>
          <a href="#" class="form-forgot">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary btn-full btn-lg">Sign In →</button>
      </form>

      <div class="form-divider">or</div>
      <div class="form-footer-text">
        New to RKstore? <a href="register.php" class="form-link">Create an account</a>
      </div>
    </div>
  </div>

  <div class="auth-visual-side">
    <div class="auth-visual-content">
      <span class="auth-big-icon">⚡</span>
      <h2>Power Up Your Setup</h2>
      <p>Join thousands of builders who trust RKstore for their next-gen tech needs.</p>
      <div class="perk-card"><span class="perk-icon">📦</span><div><div class="perk-title">Track Your Orders</div><div class="perk-desc">Real-time order status updates</div></div></div>
      <div class="perk-card"><span class="perk-icon">⚡</span><div><div class="perk-title">Exclusive Member Deals</div><div class="perk-desc">Early access to flash sales</div></div></div>
      <div class="perk-card"><span class="perk-icon">🛡️</span><div><div class="perk-title">Secure & Protected</div><div class="perk-desc">Your data is always safe</div></div></div>
    </div>
  </div>
</div>

</body>
</html>