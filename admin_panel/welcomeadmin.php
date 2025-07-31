<?php
require_once '../includes/sessionStore.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Welcome</title>
  <link rel="shortcut icon" href="../assets/logo/ms-icon-150x150.png" type="image/icon" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
    }

    .welcome-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      margin-left: 240px;
    }

    .welcome-card {
      background: white;
      border-radius: 16px;
      padding: 50px 40px;
      text-align: center;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .admin-icon {
      width: 60px;
      height: 60px;
      background: #4f46e5;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 25px;
      color: white;
      font-size: 24px;
    }

    .welcome-title {
      font-size: 2rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 12px;
    }

    .welcome-subtitle {
      font-size: 1rem;
      color: #6b7280;
      margin-bottom: 25px;
      line-height: 1.5;
    }

    .status-badge {
      background: #10b981;
      color: white;
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 500;
      display: inline-block;
    }

    @media (max-width: 1024px) {
      .welcome-page {
        margin-left: 0;
      }
    }

    @media (max-width: 768px) {
      .welcome-card {
        padding: 40px 30px;
        margin: 20px;
      }

      .welcome-title {
        font-size: 1.75rem;
      }

      .admin-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
      }
    }

    @media (max-width: 480px) {
      .welcome-card {
        padding: 30px 25px;
      }

      .welcome-title {
        font-size: 1.5rem;
      }

      .welcome-subtitle {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="welcome-page">
    <?php include('../components/sidebar.php'); ?>

    <div class="welcome-card">
      <div class="admin-icon">👤</div>
      <h1 class="welcome-title">Welcome, Admin</h1>
      <p class="welcome-subtitle">
        You have successfully logged in to the admin dashboard.
      </p>
      <div class="status-badge">
        Login Successful
      </div>
    </div>
  </div>
</body>
</html>