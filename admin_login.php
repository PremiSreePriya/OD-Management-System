<?php 
session_start(); 
include 'db.php';  

if ($_POST) {   
  $u = $_POST['username'];   
  $p = md5($_POST['password']);   
  $res = $conn->query("SELECT * FROM admin_users WHERE username='$u' AND password='$p'");   
  if ($res->num_rows > 0) {     
    $_SESSION['admin'] = $u;     
    header("Location: admin_dashboard.php");     
    exit();   
  } else {     
    $error = "Invalid Login";   
  } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Secure Access</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #4a90e2 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    /* Floating Admin Icons Background */
    .floating-icon {
      position: absolute;
      color: rgba(255, 255, 255, 0.1);
      font-size: 3rem;
      animation: floatUpDown 8s ease-in-out infinite;
      pointer-events: none;
    }

    .floating-icon:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .floating-icon:nth-child(2) { top: 20%; right: 15%; animation-delay: 1.5s; }
    .floating-icon:nth-child(3) { top: 60%; left: 8%; animation-delay: 3s; }
    .floating-icon:nth-child(4) { top: 75%; right: 10%; animation-delay: 4.5s; }
    .floating-icon:nth-child(5) { top: 45%; left: 20%; animation-delay: 6s; }
    .floating-icon:nth-child(6) { top: 30%; right: 25%; animation-delay: 7.5s; }
    .floating-icon:nth-child(7) { top: 85%; left: 30%; animation-delay: 2s; }
    .floating-icon:nth-child(8) { top: 15%; left: 50%; animation-delay: 5s; }
    .floating-icon:nth-child(9) { top: 70%; right: 35%; animation-delay: 1s; }
    .floating-icon:nth-child(10) { top: 55%; left: 60%; animation-delay: 3.5s; }

    @keyframes floatUpDown {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.1; }
      25% { transform: translateY(-30px) rotate(5deg); opacity: 0.15; }
      50% { transform: translateY(-15px) rotate(-3deg); opacity: 0.2; }
      75% { transform: translateY(-25px) rotate(3deg); opacity: 0.15; }
    }

    /* Geometric shapes floating */
    .geometric-shape {
      position: absolute;
      border: 2px solid rgba(255, 255, 255, 0.1);
      animation: rotate360 15s linear infinite;
      pointer-events: none;
    }

    .shape-1 { width: 80px; height: 80px; top: 15%; left: 75%; border-radius: 50%; animation-delay: 0s; }
    .shape-2 { width: 60px; height: 60px; top: 65%; left: 15%; animation-delay: 3s; }
    .shape-3 { width: 40px; height: 40px; top: 80%; right: 20%; border-radius: 8px; animation-delay: 6s; }
    .shape-4 { width: 100px; height: 100px; top: 25%; left: 5%; clip-path: polygon(50% 0%, 0% 100%, 100% 100%); animation-delay: 9s; }

    @keyframes rotate360 {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Glass morphism login container */
    .login-container {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      position: relative;
      z-index: 100;
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

    .login-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .admin-icon {
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
      box-shadow: 0 10px 25px rgba(255, 107, 107, 0.3);
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .login-container h2 {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 10px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .login-subtitle {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .input-group {
      position: relative;
      margin-bottom: 25px;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      font-size: 1.2rem;
      z-index: 1;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 16px 20px 16px 50px;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      background: rgba(255, 255, 255, 0.9);
      box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      outline: none;
    }

    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
      background: rgba(255, 255, 255, 1);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
    }

    .login-container button {
      width: 100%;
      padding: 16px;
      background: linear-gradient(45deg, #667eea, #764ba2);
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
      position: relative;
      overflow: hidden;
    }

    .login-container button:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
    }

    .login-container button:active {
      transform: translateY(-1px);
    }

    .login-container button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .login-container button:hover::before {
      left: 100%;
    }

    .error {
      background: rgba(231, 76, 60, 0.9);
      color: white;
      text-align: center;
      padding: 12px;
      border-radius: 25px;
      margin-bottom: 20px;
      font-weight: 500;
      animation: shake 0.5s ease-in-out;
      box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    .security-badge {
      position: absolute;
      top: -15px;
      right: -15px;
      background: linear-gradient(45deg, #27ae60, #2ecc71);
      color: white;
      padding: 8px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
      animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* Particle effect */
    .particle {
      position: absolute;
      width: 6px;
      height: 6px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: particleFloat 12s infinite linear;
    }

    @keyframes particleFloat {
      0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
      10% { opacity: 1; }
      90% { opacity: 1; }
      100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .login-container {
        margin: 20px;
        padding: 40px 30px;
      }
      
      .floating-icon {
        font-size: 2rem;
      }
      
      .geometric-shape {
        display: none;
      }
    }
  </style>
</head>
<body>
  <!-- Floating Admin Icons -->
  <div class="floating-icon">🔐</div>
  <div class="floating-icon">👤</div>
  <div class="floating-icon">⚙️</div>
  <div class="floating-icon">📊</div>
  <div class="floating-icon">🛡️</div>
  <div class="floating-icon">📋</div>
  <div class="floating-icon">🔑</div>
  <div class="floating-icon">💼</div>
  <div class="floating-icon">📈</div>
  <div class="floating-icon">🎯</div>

  <!-- Geometric Shapes -->
  <div class="geometric-shape shape-1"></div>
  <div class="geometric-shape shape-2"></div>
  <div class="geometric-shape shape-3"></div>
  <div class="geometric-shape shape-4"></div>

  <!-- Particles -->
  <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
  <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
  <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
  <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
  <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
  <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
  <div class="particle" style="left: 70%; animation-delay: 1s;"></div>
  <div class="particle" style="left: 80%; animation-delay: 3s;"></div>
  <div class="particle" style="left: 90%; animation-delay: 5s;"></div>

  <div class="login-container">
    <div class="security-badge">🔒 SECURE</div>
    
    <div class="login-header">
      <div class="admin-icon">👨‍💼</div>
      <h2>Admin Portal</h2>
      <p class="login-subtitle">Secure Administrative Access</p>
    </div>

    <form method="POST">
      <div class="input-group">
        <span class="input-icon">👤</span>
        <input type="text" name="username" placeholder="Administrator Username" required>
      </div>
      
      <div class="input-group">
        <span class="input-icon">🔑</span>
        <input type="password" name="password" placeholder="Secure Password" required>
      </div>
      
      <?php if (!empty($error)): ?>
        <div class="error">🚫 <?= $error ?></div>
      <?php endif; ?>
      
      <button type="submit">
        🚀 Access Dashboard
      </button>
    </form>
  </div>

  <script>
    // Add dynamic particle generation
    function createParticle() {
      const particle = document.createElement('div');
      particle.className = 'particle';
      particle.style.left = Math.random() * 100 + '%';
      particle.style.animationDelay = Math.random() * 12 + 's';
      document.body.appendChild(particle);
      
      setTimeout(() => {
        particle.remove();
      }, 12000);
    }

    // Create particles periodically
    setInterval(createParticle, 2000);

    // Add input focus effects
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input');
      
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.style.transform = 'scale(1)';
        });
      });

      // Add login button click effect
      const loginBtn = document.querySelector('button[type="submit"]');
      loginBtn.addEventListener('click', function() {
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });

    // Add typing effect for placeholder text
    function typeEffect(element, text, speed = 100) {
      let i = 0;
      element.placeholder = '';
      const timer = setInterval(() => {
        if (i < text.length) {
          element.placeholder += text.charAt(i);
          i++;
        } else {
          clearInterval(timer);
        }
      }, speed);
    }

    // Initialize typing effects
    window.addEventListener('load', () => {
      const usernameInput = document.querySelector('input[name="username"]');
      const passwordInput = document.querySelector('input[name="password"]');
      
      setTimeout(() => typeEffect(usernameInput, 'Administrator Username'), 500);
      setTimeout(() => typeEffect(passwordInput, 'Secure Password'), 1500);
    });
  </script>
</body>
</html>

