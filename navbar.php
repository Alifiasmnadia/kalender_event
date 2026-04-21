
<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background: linear-gradient(to left, #0f172a, #1e3a8a);">
  <div class="container">

    <a class="navbar-brand fw-bold" href="dashboard.php">🎓 Admin UBSI</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='dashboard.php')?'active fw-bold':'' ?>" href="dashboard.php">
            Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='event.php')?'active fw-bold':'' ?>" href="event.php">
            Event
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='statistik.php')?'active fw-bold':'' ?>" href="statistik.php">
            Statistik
          </a>
        </li>

        <!-- USER DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User'; ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item text-danger" href="logout.php">
                Logout
              </a>
            </li>
          </ul>
        </li>

      </ul>

    </div>

  </div>
</nav>

<!-- WAJIB: Bootstrap JS (biar dropdown jalan) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

