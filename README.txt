SFHS COMPLAINT AND FEEDBACK MANAGEMENT SYSTEM - PHP + MySQL

INSTALLATION (XAMPP)
1. Extract this folder into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP Control Panel.
3. Visit http://localhost/phpmyadmin
4. Import database.sql.
5. Open http://localhost/SFHS_Complaint_Feedback/

ADMIN DEMO LOGIN
Email: admin@sfhs.local
Password: Admin@12345

FILES
config.php                 Database connection and session helpers
database.sql               Database and admin account (hashed password)
index.php                  Public landing page
submit.php                 Complaint/feedback form with anonymous option
track.php                  Tracking-code lookup
login.php                  Admin login using password_verify()
dashboard.php              Admin dashboard, counts, filters and records
view.php                   Review complaint and update status
export.php                 CSV export for admins
logout.php                 End admin session
includes/header.php        Shared header/navigation
includes/sidebar.php       Admin sidebar
includes/footer.php        Shared footer
assets/style.css           Styling

SECURITY NOTE
This is a classroom starter. Change the demo password before real deployment.
Use HTTPS, CSRF protection, rate limiting, audit logs, secure backups, and a
school-approved privacy/retention policy before production. Anonymous reporting
means the form does not ask for name/contact details; server logs may still
contain technical information. This is not an emergency channel.
