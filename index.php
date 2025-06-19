<?php // index.php – Student OD Form ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OD Request Form</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: 
        linear-gradient(135deg, #1e3c72 0%, #2a5298 25%, #1e3c72 50%, #2a5298 75%, #1e3c72 100%),
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
      background-size: 400% 400%, 800px 800px, 600px 600px;
      animation: gradientShift 20s ease infinite;
      min-height: 100vh;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%, 0% 0%, 100% 100%; }
      50% { background-position: 100% 50%, 100% 100%, 0% 0%; }
      100% { background-position: 0% 50%, 0% 0%, 100% 100%; }
    }

    /* Animated geometric elements */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: 
        radial-gradient(circle at 20% 20%, rgba(41, 128, 185, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(52, 152, 219, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(46, 204, 113, 0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(155, 89, 182, 0.05) 0%, transparent 50%),
        linear-gradient(45deg, transparent 48%, rgba(255, 255, 255, 0.02) 50%, transparent 52%);
      background-size: 600px 600px, 800px 800px, 400px 400px, 700px 700px, 50px 50px;
      animation: float 25s ease-in-out infinite;
      z-index: -1;
    }

    body::after {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        conic-gradient(from 0deg at 15% 15%, transparent 0deg, rgba(52, 152, 219, 0.03) 90deg, transparent 180deg),
        conic-gradient(from 180deg at 85% 85%, transparent 0deg, rgba(46, 204, 113, 0.02) 90deg, transparent 180deg),
        conic-gradient(from 90deg at 50% 50%, transparent 0deg, rgba(155, 89, 182, 0.02) 45deg, transparent 90deg);
      animation: rotate 30s linear infinite;
      z-index: -1;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    .container {
      max-width: 650px;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      margin: auto;
      padding: 40px;
      border-radius: 24px;
      box-shadow: 
        0 32px 64px rgba(0,0,0,0.15),
        0 16px 32px rgba(30, 60, 114, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.3);
      position: relative;
      animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Decorative elements */
    .container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #3498db, #2ecc71, #9b59b6, #e74c3c, #f39c12, #3498db);
      background-size: 200% 100%;
      animation: gradientFlow 3s ease-in-out infinite;
      border-radius: 24px 24px 0 0;
    }

    @keyframes gradientFlow {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
      font-size: 2.2em;
      font-weight: 700;
      position: relative;
      background: linear-gradient(135deg, #3498db, #2ecc71, #9b59b6);
      background-size: 200% 200%;
      animation: gradientText 4s ease-in-out infinite;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    @keyframes gradientText {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(90deg, #3498db, #2ecc71);
      border-radius: 2px;
    }

    .form-group {
      margin-bottom: 25px;
      position: relative;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      position: relative;
    }

    label::before {
      content: '';
      position: absolute;
      left: -15px;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 15px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      border-radius: 2px;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #e1e5e9;
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.9);
      position: relative;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
      transform: translateY(-2px);
      background: #fff;
    }

    input[type="text"]:hover,
    input[type="date"]:hover,
    textarea:hover,
    input[type="file"]:hover {
      border-color: #74b9ff;
      transform: translateY(-1px);
    }

    textarea {
      height: 120px;
      resize: vertical;
      font-family: inherit;
    }

    input[type="file"] {
      padding: 20px;
      border: 2px dashed #74b9ff;
      background: rgba(52, 152, 219, 0.02);
      text-align: center;
      cursor: pointer;
      position: relative;
      transition: all 0.3s ease;
    }

    input[type="file"]:hover {
      border-color: #3498db;
      background: rgba(52, 152, 219, 0.05);
    }

    input[type="file"]::file-selector-button {
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      margin-right: 15px;
      transition: all 0.3s ease;
    }

    input[type="file"]::file-selector-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }

    button {
      width: 100%;
      background: linear-gradient(135deg, #3498db 0%, #2ecc71 30%, #9b59b6 60%, #e74c3c 100%);
      background-size: 300% 300%;
      animation: gradientButton 4s ease-in-out infinite;
      color: white;
      padding: 18px;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 10px;
      position: relative;
      overflow: hidden;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    @keyframes gradientButton {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    button:hover::before {
      left: 100%;
    }

    button:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(52, 152, 219, 0.4);
    }

    button:active {
      transform: translateY(-1px);
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 14px;
      color: #666;
      padding: 20px;
      border-top: 1px solid #eee;
    }

    .footer a {
      color: #3498db;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
    }

    .footer a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: #3498db;
      transition: width 0.3s ease;
    }

    .footer a:hover::after {
      width: 100%;
    }

    .footer a:hover {
      color: #2ecc71;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .container {
        margin: 10px;
        padding: 25px;
        border-radius: 15px;
      }

      h2 {
        font-size: 1.8em;
      }

      input[type="text"],
      input[type="date"],
      textarea,
      input[type="file"] {
        padding: 12px 15px;
      }

      button {
        padding: 15px;
        font-size: 16px;
      }
    }

    /* Loading animation for form submission */
    .loading {
      opacity: 0.7;
      pointer-events: none;
    }

    .loading button {
      background: #ccc;
      cursor: not-allowed;
    }

    /* Input validation styles */
    .error {
      border-color: #e74c3c !important;
      background: rgba(231, 76, 60, 0.05);
    }

    .success {
      border-color: #2ecc71 !important;
      background: rgba(46, 204, 113, 0.05);
    }

    /* Placeholder styling */
    ::placeholder {
      color: #999;
      font-style: italic;
    }

    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
      width: 8px;
    }

    textarea::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #3498db, #2ecc71);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>College OD Request Form</h2>
    <form action="submit_od.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required placeholder="John Doe">
      </div>

      <div class="form-group">
        <label for="reg_no">Register Number:</label>
        <input type="text" id="reg_no" name="reg_no" required placeholder="12345678">
      </div>

      <div class="form-group">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required placeholder="CSE / ECE / MECH">
      </div>

      <div class="form-group">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required>
      </div>

      <div class="form-group">
        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required>
      </div>

      <div class="form-group">
        <label for="reason">Reason for OD:</label>
        <textarea id="reason" name="reason" required placeholder="Mention your reason..."></textarea>
      </div>

      <div class="form-group">
        <label for="proof">Upload Proof (PDF/Image):</label>
        <input type="file" id="proof" name="proof" accept=".pdf,.jpg,.jpeg,.png" required>
      </div>

      <button type="submit">Submit OD Request</button>
    </form>

    <div class="footer">
      <p>Already submitted? <a href="view_status.php">Check OD Status</a></p>
    </div>
  </div>

  <script>
    function validateForm() {
      const from = document.getElementById("from_date").value;
      const to = document.getElementById("to_date").value;
      if (from > to) {
        alert("From Date cannot be after To Date.");
        return false;
      }
      return true;
    }

    // Enhanced user experience features
    document.addEventListener('DOMContentLoaded', function() {
      // Add focus effects
      const inputs = document.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.style.transform = 'scale(1)';
        });
      });

      // Add loading state on form submission
      const form = document.querySelector('form');
      form.addEventListener('submit', function() {
        document.querySelector('.container').classList.add('loading');
      });

      // Real-time validation feedback
      const fromDate = document.getElementById('from_date');
      const toDate = document.getElementById('to_date');
      
      function validateDates() {
        if (fromDate.value && toDate.value) {
          if (fromDate.value > toDate.value) {
            toDate.classList.add('error');
            toDate.classList.remove('success');
          } else {
            toDate.classList.remove('error');
            toDate.classList.add('success');
          }
        }
      }
      
      fromDate.addEventListener('change', validateDates);
      toDate.addEventListener('change', validateDates);
    });
  </script>
</body>
</html>