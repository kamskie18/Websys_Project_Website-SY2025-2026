<?php
session_start();

// Handle logout — triggered by ?action=logout in the URL
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: home.html");
    exit();
}

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$fullname  = $_SESSION['fullname'];
$firstname = explode(" ", $fullname)[0];
$role      = $_SESSION['role'] ?: 'Customer';
$initial   = strtoupper(substr($firstname, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RKstore — Dashboard</title>
  <link rel="stylesheet" href="style.css">
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
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="cart.html" class="nav-cart">🛒<span class="cart-badge">3</span></a>
    <a href="dashboard.php?action=logout" class="nav-btn">Logout</a>
  </div>
</nav>

<div class="dash-layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sb-section-label">Navigation</div>
    <a href="dashboard.php" class="sb-link active"><span class="sb-icon">📊</span> Overview</a>
    <a href="#" class="sb-link"><span class="sb-icon">📦</span> My Orders <span class="sb-badge">5</span></a>
    <a href="cart.html" class="sb-link"><span class="sb-icon">🛒</span> Cart <span class="sb-badge">3</span></a>
    <a href="products.php" class="sb-link"><span class="sb-icon">🛍️</span> Browse</a>

    <div class="sb-section-label">Account</div>
    <a href="#" class="sb-link"><span class="sb-icon">👤</span> Profile</a>
    <a href="#" class="sb-link"><span class="sb-icon">🔔</span> Notifications</a>
    <a href="#" class="sb-link"><span class="sb-icon">⚙️</span> Settings</a>
    <a href="#" class="sb-link"><span class="sb-icon">🎫</span> Vouchers</a>

    <div style="margin-top:auto; padding-top:24px; border-top:1px solid rgba(255,255,255,0.06);">
      <div class="sb-user-card">
        <div class="sb-avatar"><?= $initial ?></div>
        <div>
          <div class="sb-uname"><?= htmlspecialchars($fullname) ?></div>
          <div class="sb-urole"><?= htmlspecialchars(ucfirst($role)) ?></div>
        </div>
      </div>
      <a href="dashboard.php?action=logout" class="sb-link sb-logout"><span class="sb-icon">🚪</span> Logout</a>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="dash-main">

    <div class="dash-greeting anim-fadeup">
      <h1>Good day, <?= htmlspecialchars($firstname) ?> 👋</h1>
      <p>Here's an overview of your RKstore activity.</p>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
      <div class="stat-card anim-fadeup d1">
        <div class="stat-icon">📦</div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">5</div>
        <div class="stat-sub"><span class="stat-up">↑ 2</span> this month</div>
      </div>
      <div class="stat-card anim-fadeup d2">
        <div class="stat-icon">💰</div>
        <div class="stat-label">Total Spent</div>
        <div class="stat-value accent">₱38K</div>
        <div class="stat-sub">Lifetime value</div>
      </div>
      <div class="stat-card anim-fadeup d3">
        <div class="stat-icon">🛒</div>
        <div class="stat-label">Cart Items</div>
        <div class="stat-value">3</div>
        <div class="stat-sub"><a href="cart.html" style="color:#00c8ff;text-decoration:none;font-size:0.78rem;">View cart →</a></div>
      </div>
      <div class="stat-card anim-fadeup d4">
        <div class="stat-icon">🚚</div>
        <div class="stat-label">In Transit</div>
        <div class="stat-value">2</div>
        <div class="stat-sub">Pending delivery</div>
      </div>
    </div>

    <!-- ORDER TABLE -->
    <div class="table-card anim-fadeup">
      <div class="table-card-header">
        <div class="table-card-title">Recent Order History</div>
        <a href="#" class="btn btn-ghost btn-sm">View All →</a>
      </div>
      <table>
        <thead>
          <tr>
            <th>Order ID</th><th>Product</th><th>Category</th><th>Date</th><th>Price</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="order-id">#RK-001</span></td>
            <td>Mechanical Keyboard</td>
            <td style="color:#4a5c6e;font-size:0.82rem;">Peripheral</td>
            <td class="order-date">Apr 01, 2026</td>
            <td class="order-price">₱2,200</td>
            <td><span class="status-pill sp-delivered">Delivered</span></td>
          </tr>
          <tr>
            <td><span class="order-id">#RK-002</span></td>
            <td>RTX 4060 GPU</td>
            <td style="color:#4a5c6e;font-size:0.82rem;">GPU</td>
            <td class="order-date">Apr 05, 2026</td>
            <td class="order-price">₱18,500</td>
            <td><span class="status-pill sp-processing">Processing</span></td>
          </tr>
          <tr>
            <td><span class="order-id">#RK-003</span></td>
            <td>Gaming Monitor 27"</td>
            <td style="color:#4a5c6e;font-size:0.82rem;">Display</td>
            <td class="order-date">Apr 10, 2026</td>
            <td class="order-price">₱12,000</td>
            <td><span class="status-pill sp-pending">Pending</span></td>
          </tr>
          <tr>
            <td><span class="order-id">#RK-004</span></td>
            <td>Gaming Mouse Pro</td>
            <td style="color:#4a5c6e;font-size:0.82rem;">Peripheral</td>
            <td class="order-date">Apr 12, 2026</td>
            <td class="order-price">₱1,800</td>
            <td><span class="status-pill sp-delivered">Delivered</span></td>
          </tr>
          <tr>
            <td><span class="order-id">#RK-005</span></td>
            <td>Headset Pro 7.1</td>
            <td style="color:#4a5c6e;font-size:0.82rem;">Audio</td>
            <td class="order-date">Apr 15, 2026</td>
            <td class="order-price">₱3,500</td>
            <td><span class="status-pill sp-processing">Processing</span></td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>
</div>

</body>
</html>