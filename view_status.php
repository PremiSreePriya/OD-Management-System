<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OD Status Check - Enhanced</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating Emojis Animation */
        .floating-emoji {
            position: absolute;
            font-size: 2rem;
            opacity: 0.7;
            animation: float 6s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
        }

        .floating-emoji:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
        .floating-emoji:nth-child(2) { top: 20%; right: 10%; animation-delay: 1s; }
        .floating-emoji:nth-child(3) { top: 50%; left: 5%; animation-delay: 2s; }
        .floating-emoji:nth-child(4) { top: 70%; right: 15%; animation-delay: 3s; }
        .floating-emoji:nth-child(5) { top: 80%; left: 20%; animation-delay: 4s; }
        .floating-emoji:nth-child(6) { top: 30%; right: 5%; animation-delay: 5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(-10px) rotate(-5deg); }
            75% { transform: translateY(-15px) rotate(3deg); }
        }

        /* Glass morphism container */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        /* Form Styling */
        .form-container {
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            outline: none;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            background: linear-gradient(45deg, #ff6b6b, #ffa500);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        /* Results Section */
        .results-container {
            margin-top: 30px;
        }

        .result-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .date-range {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .status {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .status.approved {
            color: #27ae60;
        }

        .status.pending {
            color: #f39c12;
        }

        .status.rejected {
            color: #e74c3c;
        }

        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 25px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .floating-emoji {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            color: white;
            font-size: 18px;
            margin-top: 20px;
        }

        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 3px solid white;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Particle background effect */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particle-float 8s infinite linear;
        }

        @keyframes particle-float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Floating Emojis -->
    <div class="floating-emoji">📚</div>
    <div class="floating-emoji">✅</div>
    <div class="floating-emoji">📝</div>
    <div class="floating-emoji">🎓</div>
    <div class="floating-emoji">⭐</div>
    <div class="floating-emoji">📋</div>

    <!-- Particle Effects -->
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 6s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 7s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 8s;"></div>

    <div class="container">
        <div class="header">
            <h1>🎓 OD Status Check</h1>
            <p>Check your On-Duty request status instantly</p>
        </div>

        <div class="form-container">
            <form method="GET" onsubmit="showLoading()">
                <div class="input-group">
                    <input name="reg_no" type="text" placeholder="Enter Register Number" required>
                </div>
                <button type="submit" class="submit-btn">
                    🔍 Check Status
                </button>
            </form>

            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Checking your status...</p>
            </div>
        </div>

        <div class="results-container">
            <?php
            if (isset($_GET['reg_no'])) {
                include 'db.php';
                $reg = $_GET['reg_no'];
                $result = $conn->query("SELECT * FROM od_requests WHERE reg_no='$reg'");
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
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
                        
                        echo "<div class='result-card'>";
                        echo "<div class='date-range'>📅 <strong>Duration:</strong> {$row['from_date']} to {$row['to_date']}</div>";
                        echo "<div class='status {$statusClass}'>{$statusEmoji} Status: {$row['status']}</div>";
                        
                        if ($row['status'] === 'Approved') {
                            echo "<a href='generate_letter.php?id={$row['id']}' class='download-btn'>📄 Download Letter</a>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<div class='result-card'>";
                    echo "<div style='text-align: center; color: #666;'>";
                    echo "<div style='font-size: 3rem; margin-bottom: 10px;'>🔍</div>";
                    echo "<p>No records found for this register number.</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }

        // Add more particles dynamically
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 8 + 's';
            document.body.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 8000);
        }

        // Create particles periodically
        setInterval(createParticle, 1000);

        // Add input focus effects
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name="reg_no"]');
            
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>