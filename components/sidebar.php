<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beautiful Sidebar</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #f0f0f5;
      color: #333;
      overflow-x: hidden;
    }

    /* Menu Toggle Button */
    .menu-toggle {
      display: none;
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1200;
      background: #000;
      color: #f0f0f5;
      border: none;
      width: 50px;
      height: 50px;
      border-radius: 12px;
      cursor: pointer;
      font-size: 20px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .menu-toggle:hover {
      background: #333;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 280px;
      background: linear-gradient(180deg, #000 0%, #1a1a1a 100%);
      padding: 40px 0;
      z-index: 1000;
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 4px 0 30px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
    }

    .mobile-sidebar {
      display: none;
      transform: translateX(-100%);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 280px;
      background: linear-gradient(180deg, #000 0%, #1a1a1a 100%);
      padding: 40px 0;
      z-index: 1100;
      box-shadow: 4px 0 30px rgba(0, 0, 0, 0.3);
      overflow-y: auto;
    }

    /* Brand Section */
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 40px;
      padding: 0 30px;
    }

    .sidebar-brand img {
      height: 45px;
      width: 45px;
      border-radius: 10px;
      background: #f0f0f5;
      padding: 8px;
    }

    .sidebar h2,
    .mobile-sidebar h2 {
      font-size: 24px;
      margin: 0;
      font-weight: 700;
      line-height: 1.2;
      color: #f0f0f5;
      letter-spacing: -0.5px;
    }

    .sidebar h2 span,
    .mobile-sidebar h2 span {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Navigation Menu */
    .nav-menu {
      padding: 0;
      list-style: none;
    }

    .nav-item {
      margin: 0;
    }

    .sidebar a,
    .mobile-sidebar a {
      color: #b0b0b0;
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 16px 30px;
      font-weight: 500;
      font-size: 15px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      border-left: 3px solid transparent;
    }

    .sidebar a::before,
    .mobile-sidebar a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: -1;
    }

    .sidebar a:hover,
    .mobile-sidebar a:hover {
      color: #f0f0f5;
      background: rgba(240, 240, 245, 0.05);
      border-left-color: #667eea;
      transform: translateX(5px);
    }

    .sidebar a:hover::before,
    .mobile-sidebar a:hover::before {
      width: 100%;
    }

    .sidebar a.active,
    .mobile-sidebar a.active {
      color: #f0f0f5;
      background: rgba(240, 240, 245, 0.1);
      border-left-color: #667eea;
      font-weight: 600;
    }

    .sidebar a.active::before,
    .mobile-sidebar a.active::before {
      width: 100%;
    }

    /* Icon styling */
    .nav-icon {
      margin-right: 15px;
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    /* Menu Overlay */
    .menu-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 900;
      transition: opacity 0.3s ease;
    }

    .menu-overlay.active {
      display: block;
    }

    /* Main Content */
    .main-content {
      margin-left: 280px;
      padding: 40px;
      min-height: 100vh;
      transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .content-card {
      background: white;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .content-card h1 {
      color: #1a1a1a;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .content-card p {
      color: #666;
      font-size: 16px;
      line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .menu-toggle {
        display: block;
      }

      .mobile-sidebar {
        display: block;
      }

      .sidebar.active,
      .mobile-sidebar.active {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
        padding-top: 80px;
      }
    }

    @media (max-width: 480px) {

      .sidebar,
      .mobile-sidebar {
        width: 260px;
      }

      .main-content {
        padding: 15px;
        padding-top: 80px;
      }

      .content-card {
        padding: 20px;
      }
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar,
    .mobile-sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar::-webkit-scrollbar-track,
    .mobile-sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb,
    .mobile-sidebar::-webkit-scrollbar-thumb {
      background: rgba(240, 240, 245, 0.2);
      border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover,
    .mobile-sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(240, 240, 245, 0.3);
    }
  </style>
</head>

<body>
  <!-- Toggle Menu Button -->
  <button class="menu-toggle">&#9776;</button>

  <!-- Menu Overlay -->
  <div class="menu-overlay"></div>

  <!-- Desktop Sidebar -->
  <div class="sidebar">
    <div class="sidebar-brand">
      <!-- <img src="../assets/logo/ms-icon-70x70.png" alt="Logo"> -->
      <h2>LS<span>MT</span></h2>
    </div>
    <nav class="nav-menu">

      <div class="nav-item">
        <a href="viewAllUsers.php">
          <span class="nav-icon">👥</span>
          View All Users
        </a>
      </div>


      <!-- <div class="nav-item">
        <a href="#profile">
          <span class="nav-icon">✏️</span>
          Update
        </a>
      </div>

      <div class="nav-item">
        <a href="#settings">
          <span class="nav-icon">⚙️</span>
          Settings
        </a>
      </div> -->
    </nav>
  </div>

  <!-- Mobile Sidebar -->
  <div class="mobile-sidebar">
    <div class="sidebar-brand">
      <!-- <img src="../assets/logo/ms-icon-70x70.png" alt="Logo"> -->
      <!-- <h2>LS<span>MT</span></h2> -->
    </div>
    <nav class="nav-menu">

      <div class="nav-item">
        <a href="viewAllUsers.php">
          <span class="nav-icon">👥</span>
          View All Users
        </a>
      </div>
      <!-- <div class="nav-item">
        <a href="#profile">
          <span class="nav-icon">✏️</span>
          Update
        </a>
      </div>


      <div class="nav-item">
        <a href="#settings">
          <span class="nav-icon">⚙️</span>
          Settings
        </a>
      </div> -->

    </nav>
  </div>

  <!-- Sidebar Toggle Script -->
  <script>
    const menuToggle = document.querySelector(".menu-toggle");
    const mobileSidebar = document.querySelector(".mobile-sidebar");
    const menuOverlay = document.querySelector(".menu-overlay");

    // Toggle mobile menu
    menuToggle.addEventListener("click", () => {
      mobileSidebar.classList.toggle("active");
      menuOverlay.classList.toggle("active");
    });

    // Close menu when clicking overlay
    menuOverlay.addEventListener("click", () => {
      mobileSidebar.classList.remove("active");
      menuOverlay.classList.remove("active");
    });

    // Handle active navigation links
    document.querySelectorAll('.sidebar a, .mobile-sidebar a').forEach(link => {
      link.addEventListener('click', function(e) {
        // Remove active class from all links
        document.querySelectorAll('.sidebar a, .mobile-sidebar a').forEach(l => l.classList.remove('active'));

        // Add active class to clicked link
        this.classList.add('active');

        // Close mobile menu if open
        mobileSidebar.classList.remove("active");
        menuOverlay.classList.remove("active");
      });
    });

    // Close mobile menu when window is resized to desktop
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        mobileSidebar.classList.remove("active");
        menuOverlay.classList.remove("active");
      }
    });
  </script>
</body>

</html>