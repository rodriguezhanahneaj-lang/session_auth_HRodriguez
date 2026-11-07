<?php
session_start();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
  html { scroll-behavior: smooth; }
  body { background: #f1f5f9; }
  .welcome-card h1 { color: #0d6efd; font-weight: 800; }
  .session-id { word-break: break-all; }
</style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">SessionAuthSystem</a>
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
    </ul>
    <div class="d-flex align-items-center gap-3">
      <span class="text-white"><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['username']) ?></span>
      <a href="logout.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
    </div>
  </div>
</nav>

<div class="container py-5">

  <div class="card border-0 shadow-sm welcome-card mb-5">
    <div class="card-body p-5">
      <h1 class="display-6">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
      <p class="text-muted mb-4">This page is protected and only visible to logged-in users.</p>
      <a href="#details" class="btn btn-primary">Explore Dashboard</a>
    </div>
  </div>

  <div class="row g-4" id="details">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h6 class="text-success fw-semibold"><i class="bi bi-shield-check me-2"></i>Account Status</h6>
          <p class="small text-muted mb-0">
            Your session is active and protected against Session Fixation using
            <code>session_regenerate_id(true)</code>.
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h6 class="text-primary fw-semibold"><i class="bi bi-person-badge me-2"></i>User Details</h6>
          <p class="small mb-1"><strong>User ID:</strong> <?= (int)$_SESSION['user_id'] ?></p>
          <p class="small mb-0"><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h6 class="text-warning fw-semibold">Active Session ID</h6>
          <p class="small mb-1"><strong>Current Session ID:</strong></p>
          <code class="small session-id d-block mb-2"><?= htmlspecialchars(session_id()) ?></code>
          <p class="small text-muted mb-0">Generated after login call to <code>session_regenerate_id(true)</code>.</p>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.addEventListener('pageshow', function (e) { if (e.persisted) location.reload(); });
</script>
</body>
</html>