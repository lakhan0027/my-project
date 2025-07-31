<?php
require_once '../db.php';
require_once '../includes/sessionStore.php';
require_once __DIR__ . '/../user_panel/dao/UserRegistrationDAO.php';

// Create DAO instance
$dao = new UserRegistrationDAO($pdo);

// Fetch all user records
$users = $dao->getAll();

// print_r($users);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Admin - View All Users</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f0f5;
    }

    .header {
      background-color: #333;
      color: white;
      padding: 15px 20px;
      text-align: center;
      font-size: 22px;
    }

    .container {
      margin-left: 275px;
      padding: 30px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .top-bar h2 {
      margin: 0;
    }

    .user-card {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .user-info-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      flex-grow: 1;
    }

    .column {
      display: flex;
      flex-direction: column;
      font-size: 16px;
    }

    .label {
      font-weight: bold;
      color: #333;
      margin-bottom: 4px;
    }

    .value {
      color: #555;
    }

    .view-icon {
      background-color: transparent;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: #007BFF;
      transition: transform 0.2s;
      margin-left: 20px;
    }

    .view-icon:hover {
      transform: scale(1.2);
      color: #0056b3;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content {
      background-color: white;
      margin: 2% auto;
      padding: 0;
      border-radius: 10px;
      width: 90%;
      max-width: 1074px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      animation: slideIn 0.3s ease-in-out;
    }

    .modal-header {
      background-color: #333;
      color: white;
      padding: 20px;
      border-radius: 10px 10px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h2 {
      margin: 0;
      font-size: 24px;
    }

    .close-btn {
      background: none;
      border: none;
      color: white;
      font-size: 28px;
      cursor: pointer;
      padding: 0;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: background-color 0.2s;
    }

    .close-btn:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .modal-body {
      padding: 30px 60px;
    }

    .details-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .detail-section {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      border-left: 4px solid #007BFF;
    }

    .section-title {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      padding-bottom: 8px;
      border-bottom: 1px solid #e0e0e0;
    }

    .detail-row:last-child {
      border-bottom: none;
      margin-bottom: 0;
    }

    .detail-label {
      font-weight: 600;
      color: #555;

    }

    .detail-value {
      color: #333;

      text-align: left;
    }


    .email-text {
  max-width: 140px;      /* Adjust based on your design */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
  vertical-align: top;
}

.name-text {
  max-width: 150px;        /* Adjust based on layout */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
  vertical-align: top;
}



    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideIn {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

/* Tablet Devices: 481px - 768px */
@media (min-width: 481px) and (max-width: 768px) {
  .container {
    margin-left: 0px;
    padding: 30px;
  }

  .email-text {
    max-width: 130px;
  }

  .name-text {
    max-width: 120px;
  }

  .user-info-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  .modal-content {
    width: 95%;
    margin: 5% auto;
    border-radius: 12px;
  }

  .modal-body {
    padding: 20px;
  }

  .modal-header h2 {
    margin-left: 59px;
    font-size: 24px;
}

  .details-grid {
    grid-template-columns: 1fr;
  }

  .detail-row {
  display: flex;
  flex-direction: row; /* Ensure horizontal layout */
  align-items: center;
  gap: 10px; /* space between label and value */
}

.detail-label {
  font-weight: 600;
  white-space: nowrap; /* Prevent line break */
}

.detail-value {
  text-align: left;
  word-break: break-word;
  flex: 1; /* Let value take available space if needed */
}
}

/* Mobile Devices: up to 480px */
@media (max-width: 480px) {
  .container {
    margin-left: 0;
    padding: 30px;
  }

  .email-text {
    max-width: 130px;
  }

  .name-text {
    max-width: 120px;
  }

  .user-card {
    flex-direction: column;
    align-items: flex-start;
  }

  .view-icon {
    align-self: flex-end;
    margin-top: 10px;
  }

  .user-info-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  .modal-content {
    width: 95%;
    margin: 5% auto;
    border-radius: 12px;
  }

  .modal-body {
    padding: 60px 20px 20px 20px;
  }
  .modal-header h2 {
    margin-left: 59px;
    font-size: 24px;
}

  .details-grid {
    grid-template-columns: 1fr;
  }

  .detail-row {
  display: flex;
  flex-direction: row; /* Ensure horizontal layout */
  align-items: center;
  gap: 10px; /* space between label and value */
}

.detail-label {
  font-weight: 600;
  white-space: nowrap; /* Prevent line break */
}

.detail-value {
  text-align: left;
  word-break: break-word;
  flex: 1; /* Let value take available space if needed */
}

}


  </style>
</head>

<body>
   <?php include('../components/sidebar.php'); ?>
  <div class="header">Admin Dashboard - View All Users</div>

  <div class="container">
    <div class="top-bar">
      <h2>User List</h2>
    </div>

    <?php foreach ($users as $user): ?>
      <div class="user-card">
        <div class="user-info-grid">
          <div class="column">
            <div class="label">User ID:</div>
            <div class="value"><?= htmlspecialchars($user['id']) ?></div>
          </div>
        <div class="column">
  <div class="label">Full Name:</div>
  <div class="value name-text" title="<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
    <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
  </div>
</div>

          <div class="column">
            <div class="label">Contact:</div>
            <div class="value"><?= htmlspecialchars($user['phone_number']) ?></div>
          </div>
     <div class="column">
  <div class="label">Email ID:</div>
  <div class="value email-text" title="<?= htmlspecialchars($user['email']) ?>">
    <?= htmlspecialchars($user['email']) ?>
  </div>
</div>

        </div>
        <button class="view-icon" onclick="openModal('modal<?= $user['id'] ?>')" title="View Details">
          <i class="fas fa-eye" style="color: orange; font-size: 20px;"></i>
        </button>
      </div>

      <!-- Modal for this user -->
      <div id="modal<?= $user['id'] ?>" class="modal" style="display: none;">
        <div class="modal-content">
          <div class="modal-header">
            <h2><i class="fas fa-user-circle"></i> User Details</h2>
            <button class="close-btn" onclick="closeModal('modal<?= $user['id'] ?>')">&times;</button>
          </div>
          <div class="modal-body">
            <div class="details-grid">

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-user"></i> Personal Information</div>
                <div class="detail-row"><span class="detail-label">ID:</span><span class="detail-value"><?= $user['id'] ?></span></div>
                <div class="detail-row"><span class="detail-label">First Name:</span><span class="detail-value"><?= $user['first_name'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Last Name:</span><span class="detail-value"><?= $user['last_name'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Phone Number:</span><span class="detail-value"><?= $user['phone_number'] ?></span></div>
              </div>

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-users"></i> Family Information</div>
                <div class="detail-row"><span class="detail-label">Father's Name:</span><span class="detail-value"><?= $user['father_name'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Father's Occupation:</span><span class="detail-value"><?= $user['father_occupation'] ?></span></div>
              </div>

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-graduation-cap"></i> 10th Class Details</div>
                <div class="detail-row"><span class="detail-label">Board:</span><span class="detail-value"><?= $user['tenth_board'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Percentage:</span><span class="detail-value"><?= $user['tenth_percentage'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Year:</span><span class="detail-value"><?= $user['tenth_year'] ?></span></div>
              </div>

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-certificate"></i> 12th Class Details</div>
                <div class="detail-row"><span class="detail-label">Board:</span><span class="detail-value"><?= $user['twelfth_board'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Percentage:</span><span class="detail-value"><?= $user['twelfth_percentage'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Year:</span><span class="detail-value"><?= $user['twelfth_year'] ?></span></div>
              </div>

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-university"></i> Graduation Details</div>
                <div class="detail-row"><span class="detail-label">University:</span><span class="detail-value"><?= $user['graduation_university'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Percentage:</span><span class="detail-value"><?= $user['graduation_percentage'] ?></span></div>
                <div class="detail-row"><span class="detail-label">Year:</span><span class="detail-value"><?= $user['graduation_year'] ?></span></div>
              </div>

              <div class="detail-section">
                <div class="section-title"><i class="fas fa-passport"></i> Passport</div>
                <div class="detail-row">
                  <span class="detail-label">Do you have a passport?</span>
                  <span class="detail-value">
                    <?= htmlspecialchars(strtolower($user['passport']) == 'yes' || $user['passport'] == '1' ? 'Yes' : 'No') ?>
                  </span>
                </div>
              </div>


              <div class="detail-section" style="grid-column: 1 / -1;">
                <div class="section-title"><i class="fas fa-info-circle"></i> Description</div>
                <div class="detail-row">
                  <span class="detail-value"><?= htmlspecialchars($user['description']) ?></span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>


    <?php endforeach; ?>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
      document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        closeModal(event.target.id);
        closeModal(event.target.id);
      }
    };

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(modal => modal.style.display = 'none');
        document.body.style.overflow = 'auto';
      }
    });
  </script>
</body>

</html>