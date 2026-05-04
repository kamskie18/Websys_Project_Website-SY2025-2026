<?php
// PHP always goes at the very top, before any HTML
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RKstore — Products</title>
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
    <a href="products.php" class="active">Products</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="cart.html" class="nav-cart">🛒<span class="cart-badge">3</span></a>
    <a href="login.php" class="nav-btn">Login</a>
  </div>
</nav>

<section class="section">
  <div class="sec-head">
    <div>
      <div class="sec-label">// Product Catalog</div>
      <div class="sec-title">All Products</div>
    </div>
    <span id="count-lbl" style="font-family:monospace; font-size:0.78rem; color:#4a5c6e;">10 items</span>
  </div>

  <div class="filter-bar">
    <button class="filter-btn active" onclick="filterCat('all',this)">All</button>
    <button class="filter-btn" onclick="filterCat('gpu',this)">🎮 GPUs</button>
    <button class="filter-btn" onclick="filterCat('peripheral',this)">⌨️ Peripherals</button>
    <button class="filter-btn" onclick="filterCat('display',this)">🖥️ Displays</button>
    <button class="filter-btn" onclick="filterCat('audio',this)">🎧 Audio</button>
    <button class="filter-btn" onclick="filterCat('storage',this)">💾 Storage</button>
  </div>

  <div class="product-grid" id="pgrid">

    <div class="product-card" data-cat="gpu">
      <div class="product-img-area">
        <div class="p-badges"><span class="badge b-hot">Hot</span></div>
        <img src="GPU.jpg" alt="RTX 4060" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">GPU</div>
        <div class="p-name">RTX 4060 GPU</div>
        <div class="p-specs"><span class="spec">12GB GDDR6</span><span class="spec">DLSS 3.0</span><span class="spec">Ray Tracing</span></div>
        <div class="p-footer">
          <div><span class="p-old-price">₱19,999</span><div class="p-price">₱18,500</div></div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="gpu">
      <div class="product-img-area">
        <div class="p-badges"><span class="badge b-new">New</span></div>
        <img src="GPU4070.jpg" alt="RTX 4070 Super" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">GPU</div>
        <div class="p-name">RTX 4070 Super</div>
        <div class="p-specs"><span class="spec">12GB GDDR6X</span><span class="spec">PCIe 4.0</span></div>
        <div class="p-footer">
          <div class="p-price">₱32,000</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="peripheral">
      <div class="product-img-area">
        <div class="p-badges"><span class="badge b-new">New</span></div>
        <img src="ASkeyboard.png" alt="Attack Shark Keyboard" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">Peripheral</div>
        <div class="p-name">Attack Shark X85 Pro Mechanical Keyboard</div>
        <div class="p-specs"><span class="spec">TKL</span><span class="spec">Creamy Sound</span><span class="spec">RGB</span></div>
        <div class="p-footer">
          <div class="p-price">₱2,200</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="peripheral">
      <div class="product-img-area">
        <img src="Attacksharkmouse.jpg" alt="Attack Shark X6 Mouse" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">Peripheral</div>
        <div class="p-name">Attack Shark X6 Gaming Mouse</div>
        <div class="p-specs"><span class="spec">PAW3395</span><span class="spec">Wireless</span><span class="spec">RGB Dock</span></div>
        <div class="p-footer">
          <div class="p-price">₱1,800</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="display">
      <div class="product-img-area">
        <div class="p-badges"><span class="badge b-sale">Sale</span></div>
        <img src="Asusgamingmonitor.jpg" alt="ASUS TUF Monitor" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">Display</div>
        <div class="p-name">ASUS TUF Gaming VG279QE 27" 180Hz</div>
        <div class="p-specs"><span class="spec">180Hz</span><span class="spec">IPS</span><span class="spec">1ms</span></div>
        <div class="p-footer">
          <div><span class="p-old-price">₱14,500</span><div class="p-price">₱12,000</div></div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="display">
      <div class="product-img-area">
        <img src="Nvisionultrawidemonitor.jpg" alt="Nvision Ultrawide" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">Display</div>
        <div class="p-name">Nvision MG34UF20 34" Ultrawide Curved 200Hz</div>
        <div class="p-specs"><span class="spec">3440×1440</span><span class="spec">200Hz</span><span class="spec">VA</span></div>
        <div class="p-footer">
          <div class="p-price">₱28,500</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="audio">
      <div class="product-img-area">
        <img src="Fantechheadset_jpg.jpg" alt="Fantech Headset" style="width:200px;height:160px;object-fit:contain;position:relative;z-index:1;">
      </div>
      <div class="product-body">
        <div class="p-cat">Audio</div>
        <div class="p-name">Fantech HQ54 Mars II Gaming Headset</div>
        <div class="p-specs"><span class="spec">7.1 Surround</span><span class="spec">Noise Cancel</span></div>
        <div class="p-footer">
          <div class="p-price">₱3,500</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="audio">
      <div class="product-img-area">
        <span class="p-emoji">🎙️</span>
      </div>
      <div class="product-body">
        <div class="p-cat">Audio</div>
        <div class="p-name">USB Condenser Mic</div>
        <div class="p-specs"><span class="spec">Cardioid</span><span class="spec">48kHz</span><span class="spec">RGB</span></div>
        <div class="p-footer">
          <div class="p-price">₱2,999</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="peripheral">
      <div class="product-img-area">
        <span class="p-emoji">🕹️</span>
      </div>
      <div class="product-body">
        <div class="p-cat">Peripheral</div>
        <div class="p-name">Gaming Controller</div>
        <div class="p-specs"><span class="spec">Wireless</span><span class="spec">PC & Console</span></div>
        <div class="p-footer">
          <div class="p-price">₱2,800</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

    <div class="product-card" data-cat="storage">
      <div class="product-img-area">
        <div class="p-badges"><span class="badge b-new">New</span></div>
        <span class="p-emoji">💾</span>
      </div>
      <div class="product-body">
        <div class="p-cat">Storage</div>
        <div class="p-name">NVMe SSD 2TB</div>
        <div class="p-specs"><span class="spec">PCIe 4.0</span><span class="spec">7000MB/s</span></div>
        <div class="p-footer">
          <div class="p-price">₱5,800</div>
          <a href="cart.html" class="btn btn-primary btn-sm">Add to Cart</a>
        </div>
      </div>
    </div>

  </div>

  <div id="empty-state" style="display:none; text-align:center; padding:80px 0;">
    <div style="font-size:3rem; margin-bottom:16px;">🔍</div>
    <div style="font-size:1rem; color:#7a8fa8;">No products in this category.</div>
  </div>
</section>

<footer style="margin-top:20px;">
  <div class="footer-bottom" style="border-top:none; padding-top:0;">
    <div class="footer-copy">© 2026 RKSTORE</div>
    <div style="display:flex; gap:24px;">
      <a href="home.html" style="color:#4a5c6e;text-decoration:none;font-family:monospace;font-size:0.65rem;letter-spacing:1px;">HOME</a>
      <a href="cart.html" style="color:#4a5c6e;text-decoration:none;font-family:monospace;font-size:0.65rem;letter-spacing:1px;">CART</a>
      <a href="dashboard.php" style="color:#4a5c6e;text-decoration:none;font-family:monospace;font-size:0.65rem;letter-spacing:1px;">DASHBOARD</a>
    </div>
  </div>
</footer>

<script>
  function filterCat(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const cards = document.querySelectorAll('#pgrid .product-card');
    let count = 0;
    cards.forEach((c, i) => {
      const show = cat === 'all' || c.dataset.cat === cat;
      c.style.display = show ? '' : 'none';
      if (show) {
        c.style.animation = 'none';
        void c.offsetWidth;
        c.style.animation = `fadeUp 0.4s ${i * 0.04}s ease both`;
        count++;
      }
    });
    document.getElementById('count-lbl').textContent = count + ' item' + (count !== 1 ? 's' : '');
    document.getElementById('empty-state').style.display = count === 0 ? 'block' : 'none';
  }
</script>

</body>
</html>