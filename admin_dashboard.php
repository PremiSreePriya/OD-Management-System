<?php 
session_start(); 
include 'db.php'; 
if (!isset($_SESSION['admin'])) {     
    header("Location: admin_login.php");     
    exit(); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - OD Requests Management</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 40px 20px;
      position: relative;
      overflow-x: hidden;
    }

    /* Floating Student-Admin Relationship Icons */
    .floating-relationship {
      position: absolute;
      font-size: 2.5rem;
      opacity: 0.15;
      animation: floatRelationship 12s ease-in-out infinite;
      pointer-events: none;
      z-index: 1;
    }

    .floating-relationship:nth-child(1) { top: 5%; left: 5%; animation-delay: 0s; }
    .floating-relationship:nth-child(2) { top: 15%; right: 8%; animation-delay: 2s; }
    .floating-relationship:nth-child(3) { top: 35%; left: 3%; animation-delay: 4s; }
    .floating-relationship:nth-child(4) { top: 55%; right: 10%; animation-delay: 6s; }
    .floating-relationship:nth-child(5) { top: 75%; left: 8%; animation-delay: 8s; }
    .floating-relationship:nth-child(6) { top: 25%; right: 25%; animation-delay: 10s; }
    .floating-relationship:nth-child(7) { top: 45%; left: 15%; animation-delay: 1s; }
    .floating-relationship:nth-child(8) { top: 65%; right: 30%; animation-delay: 3s; }
    .floating-relationship:nth-child(9) { top: 85%; left: 30%; animation-delay: 5s; }
    .floating-relationship:nth-child(10) { top: 10%; left: 40%; animation-delay: 7s; }
    .floating-relationship:nth-child(11) { top: 70%; right: 5%; animation-delay: 9s; }
    .floating-relationship:nth-child(12) { top: 30%; left: 60%; animation-delay: 11s; }

    @keyframes floatRelationship {
      0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.1; }
      25% { transform: translateY(-40px) rotate(10deg) scale(1.1); opacity: 0.2; }
      50% { transform: translateY(-20px) rotate(-5deg) scale(0.9); opacity: 0.15; }
      75% { transform: translateY(-35px) rotate(8deg) scale(1.05); opacity: 0.18; }
    }

    /* Connection Lines Animation */
    .connection-line {
      position: absolute;
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      animation: connectionFlow 8s linear infinite;
      pointer-events: none;
    }

    .line-1 { top: 20%; left: 10%; width: 200px; animation-delay: 0s; }
    .line-2 { top: 60%; right: 15%; width: 150px; animation-delay: 2s; }
    .line-3 { top: 40%; left: 20%; width: 180px; animation-delay: 4s; }
    .line-4 { top: 80%; right: 25%; width: 160px; animation-delay: 6s; }

    @keyframes connectionFlow {
      0% { opacity: 0; transform: translateX(-50px); }
      50% { opacity: 0.3; }
      100% { opacity: 0; transform: translateX(50px); }
    }

    /* Main Container */
    .container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      padding: 40px 50px;
      border-radius: 25px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      max-width: 1000px;
      width: 100%;
      position: relative;
      z-index: 10;
      border: 1px solid rgba(255, 255, 255, 0.3);
      animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header Section */
    .dashboard-header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
    }

    .admin-avatar {
      width: 80px;
      height: 80px;
      background: linear-gradient(45deg, #ff6b6b, #ffa500);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2.5rem;
      color: white;
      box-shadow: 0 15px 35px rgba(255, 107, 107, 0.4);
      animation: adminPulse 3s ease-in-out infinite;
    }

    @keyframes adminPulse {
      0%, 100% { transform: scale(1); box-shadow: 0 15px 35px rgba(255, 107, 107, 0.4); }
      50% { transform: scale(1.05); box-shadow: 0 20px 40px rgba(255, 107, 107, 0.6); }
    }

    h2 {
      color: #1e293b;
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 10px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard-subtitle {
      color: #64748b;
      font-size: 1.1rem;
      margin-bottom: 20px;
    }

    .stats-bar {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .stat-item {
      background: linear-gradient(45deg, #667eea, #764ba2);
      color: white;
      padding: 15px 25px;
      border-radius: 20px;
      text-align: center;
      min-width: 120px;
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
      animation: statFloat 4s ease-in-out infinite;
    }

    .stat-item:nth-child(1) { animation-delay: 0s; }
    .stat-item:nth-child(2) { animation-delay: 1s; }
    .stat-item:nth-child(3) { animation-delay: 2s; }

    @keyframes statFloat {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }

    .stat-number {
      font-size: 1.8rem;
      font-weight: 700;
      display: block;
    }

    .stat-label {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    /* Request Cards */
    .request {
      background: linear-gradient(145deg, #ffffff, #f8fafc);
      border: none;
      border-radius: 20px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      border-left: 5px solid #667eea;
    }

    .request::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .request:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .request:hover::before {
      opacity: 1;
    }

    .request-header {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
      gap: 15px;
    }

    .student-avatar {
      width: 50px;
      height: 50px;
      background: linear-gradient(45deg, #4facfe, #00f2fe);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: white;
      box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
    }

    .request h4 {
      margin: 0;
      color: #0f172a;
      font-size: 1.3rem;
      font-weight: 600;
    }

    .request-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      margin-bottom: 20px;
    }

    .info-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px;
      background: rgba(102, 126, 234, 0.1);
      border-radius: 12px;
    }

    .info-icon {
      font-size: 1.2rem;
    }

    .info-content {
      flex: 1;
    }

    .info-label {
      font-size: 0.85rem;
      color: #64748b;
      font-weight: 500;
    }

    .info-value {
      font-size: 1rem;
      color: #1e293b;
      font-weight: 600;
    }

    .reason-section {
      background: rgba(240, 147, 251, 0.1);
      padding: 15px;
      border-radius: 12px;
      margin-bottom: 20px;
      border-left: 4px solid #f093fb;
    }

    .reason-section .info-label {
      color: #7c3aed;
      font-weight: 600;
    }

    .status {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.9rem;
      margin-bottom: 20px;
    }

    .status.pending {
      background: linear-gradient(45deg, #fbbf24, #f59e0b);
      color: white;
      box-shadow: 0 5px 15px rgba(251, 191, 36, 0.3);
    }

    .status.approved {
      background: linear-gradient(45deg, #10b981, #059669);
      color: white;
      box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .status.rejected {
      background: linear-gradient(45deg, #ef4444, #dc2626);
      color: white;
      box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
    }

    .action-buttons {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .action-buttons a {
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 25px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .view-proof {
      background: linear-gradient(45deg, #6366f1, #8b5cf6);
      color: white;
    }

    .approve-btn {
      background: linear-gradient(45deg, #10b981, #059669);
      color: white;
    }

    .reject-btn {
      background: linear-gradient(45deg, #ef4444, #dc2626);
      color: white;
    }

    .action-buttons a:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        padding: 30px 25px;
        margin: 20px 10px;
      }
      
      .request-info {
        grid-template-columns: 1fr;
      }
      
      .stats-bar {
        gap: 15px;
      }
      
      .stat-item {
        min-width: 100px;
        padding: 12px 20px;
      }
      
      .floating-relationship {
        font-size: 2rem;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .action-buttons a {
        justify-content: center;
      }
    }

    /* Loading Animation */
    .loading-animation {
      text-align: center;
      padding: 40px;
      color: #64748b;
    }

    .spinner {
      width: 40px;
      height: 40px;
      border: 4px solid rgba(102, 126, 234, 0.2);
      border-radius: 50%;
      border-top: 4px solid #667eea;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <!-- Floating Student-Admin Relationship Icons -->
  <div class="floating-relationship">👨‍🎓</div> <!-- Student -->
  <div class="floating-relationship">👨‍💼</div> <!-- Admin -->
  <div class="floating-relationship">📝</div> <!-- Request -->
  <div class="floating-relationship">✅</div> <!-- Approval -->
  <div class="floating-relationship">📋</div> <!-- Documents -->
  <div class="floating-relationship">🤝</div> <!-- Collaboration -->
  <div class="floating-relationship">🎯</div> <!-- Goals -->
  <div class="floating-relationship">📊</div> <!-- Management -->
  <div class="floating-relationship">🔄</div> <!-- Process -->
  <div class="floating-relationship">⭐</div> <!-- Excellence -->
  <div class="floating-relationship">🏛️</div> <!-- Institution -->
  <div class="floating-relationship">📚</div> <!-- Education -->

  <!-- Connection Lines -->
  <div class="connection-line line-1"></div>
  <div class="connection-line line-2"></div>
  <div class="connection-line line-3"></div>
  <div class="connection-line line-4"></div>

  <div class="container">
    <div class="dashboard-header">
      <div class="admin-avatar">👨‍💼</div>
      <h2>🎓 OD Requests Dashboard</h2>
      <p class="dashboard-subtitle">Managing Student On-Duty Applications</p>
      
      <div class="stats-bar">
        <div class="stat-item">
          <span class="stat-number" id="totalRequests">0</span>
          <span class="stat-label">📋 Total Requests</span>
        </div>
        <div class="stat-item">
          <span class="stat-number" id="pendingRequests">0</span>
          <span class="stat-label">⏳ Pending</span>
        </div>
        <div class="stat-item">
          <span class="stat-number" id="approvedRequests">0</span>
          <span class="stat-label">✅ Approved</span>
        </div>
      </div>
    </div>

    <div id="requestsContainer">
      <?php
      $res = $conn->query("SELECT * FROM od_requests ORDER BY id DESC");
      $totalRequests = 0;
      $pendingRequests = 0;
      $approvedRequests = 0;
      
      if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
          $totalRequests++;
          if ($row['status'] === 'Pending') $pendingRequests++;
          if ($row['status'] === 'Approved') $approvedRequests++;
          
          $statusClass = strtolower($row['status']);
          $statusEmoji = '';
          
          switch($statusClass) {
            case 'approved':
              $statusEmoji = '✅';
              break;
            case 'pending':
              $statusEmoji = '⏳';
              break;
            case 'rejected':
              $statusEmoji = '❌';
              break;
            default:
              $statusEmoji = '📋';
          }
          
          echo "<div class='request'>";
          echo "<div class='request-header'>";
          echo "<div class='student-avatar'>👨‍🎓</div>";
          echo "<div>";
          echo "<h4>{$row['name']} ({$row['reg_no']})</h4>";
          echo "</div>";
          echo "</div>";
          
          echo "<div class='request-info'>";
          echo "<div class='info-item'>";
          echo "<span class='info-icon'>📅</span>";
          echo "<div class='info-content'>";
          echo "<div class='info-label'>From Date</div>";
          echo "<div class='info-value'>{$row['from_date']}</div>";
          echo "</div>";
          echo "</div>";
          
          echo "<div class='info-item'>";
          echo "<span class='info-icon'>📅</span>";
          echo "<div class='info-content'>";
          echo "<div class='info-label'>To Date</div>";
          echo "<div class='info-value'>{$row['to_date']}</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          
          echo "<div class='reason-section'>";
          echo "<div class='info-label'>💭 Reason for OD</div>";
          echo "<div class='info-value'>{$row['reason']}</div>";
          echo "</div>";
          
          echo "<div class='status {$statusClass}'>{$statusEmoji} Status: {$row['status']}</div>";
          
          echo "<div class='action-buttons'>";
          echo "<a href='uploads/{$row['proof']}' target='_blank' class='view-proof'>📎 View Proof</a>";
          
          if ($row['status'] === 'Pending') {
            echo "<a href='update_od.php?id={$row['id']}&status=Approved' class='approve-btn'>✅ Approve</a>";
            echo "<a href='update_od.php?id={$row['id']}&status=Rejected' class='reject-btn'>❌ Reject</a>";
          }
          
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "<div class='loading-animation'>";
        echo "<div class='spinner'></div>";
        echo "<h3>📭 No OD Requests Found</h3>";
        echo "<p>All caught up! No pending requests to review.</p>";
        echo "</div>";
      }
      ?>
    </div>
  </div>

  <script>
    // Update statistics
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('totalRequests').textContent = <?= $totalRequests ?>;
      document.getElementById('pendingRequests').textContent = <?= $pendingRequests ?>;
      document.getElementById('approvedRequests').textContent = <?= $approvedRequests ?>;
      
      // Animate statistics counting
      function animateCounter(element, target) {
        let current = 0;
        const increment = target / 30;
        const timer = setInterval(() => {
          current += increment;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          element.textContent = Math.floor(current);
        }, 50);
      }
      
      setTimeout(() => {
        animateCounter(document.getElementById('totalRequests'), <?= $totalRequests ?>);
        animateCounter(document.getElementById('pendingRequests'), <?= $pendingRequests ?>);
        animateCounter(document.getElementById('approvedRequests'), <?= $approvedRequests ?>);
      }, 500);
    });

    // Add click animation to action buttons
    document.querySelectorAll('.action-buttons a').forEach(button => {
      button.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });

    // Add hover effect to request cards
    document.querySelectorAll('.request').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.borderLeftWidth = '8px';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.borderLeftWidth = '5px';
      });
    });
  </script>
</body>
</html>