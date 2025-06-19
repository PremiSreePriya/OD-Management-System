# OD (On-Duty) Management-System 📄
A PHP-based web application to manage On-Duty (OD) requests for college students and allow administrators to approve/reject requests and generate OD approval letters in PDF format.

💻 Tech Stack & Purpose

◆ PHP – Backend logic and request handling

◆ MySQL – Stores OD request and approval data

◆ HTML/CSS – Frontend user interface

◆ FPDF – Generates OD approval letters in PDF format

◆ XAMPP/Local Server – Runs PHP and MySQL locally for development/testing

📂 Project Structure & File Descriptions

🔷  index.php — OD request form for students

🔷  submit_od.php — Handles form submission logic

🔷  view_status.php — Displays status of the OD request to students

🔷  admin_login.php — Login page for administrators

🔷  admin_dashboard.php — Admin dashboard to manage OD requests

🔷  update_od.php — Processes approval/rejection actions

🔷  generate_letter.php — Generates downloadable PDF for approved OD

🔷  db.php — Connects application to MySQL database

🔷  fpdf.php — FPDF library file used for PDF generation

🛠️ Setup Instructions

◆ Place the project folder in htdocs/ (XAMPP).

◆ Create a database (e.g., od_system) and paste the provided SQL code to create the table.

◆ Update db.php with your database credentials.

◆ Download FPDF and add fpdf.php and the font/ folder to the project.

🌐 Run in browser:

👨‍🎓 Student: localhost/od-system/index.php

🧑‍💼 Admin: localhost/od-system/admin_login.php

🚀 How It Works

◆ Student submits OD request form

◆ Admin logs in, views, and approves/rejects requests

◆ Approved requests generate a PDF letter for download

◆ Students can check the status anytime




