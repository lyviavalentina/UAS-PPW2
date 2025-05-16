<?php
// admin_navbar.php - Navigation bar untuk admin EduLearn (gaya seperti user)
?>

<nav class="main-navbar">
    <div class="navbar-container">
        <!-- Logo yang mengarah ke dashboard admin -->
        <a href="dashboard_admin.php" class="navbar-brand">
            <span class="logo-text">EduLearn Admin</span>
        </a>
        
        <div class="navbar-links">
            <!-- Link Dashboard -->
            <a href="dashboard_admin.php" class="nav-link">
                <span class="material-icons">dashboard</span>
                <span class="nav-text">Dashboard</span>
            </a>
            
            <!-- Link Kelola Courses -->
            <a href="courses_admin.php" class="nav-link">
                <span class="material-icons">school</span>
                <span class="nav-text">Courses</span>
            </a>
            
            <!-- Link Tambah Course -->
            <a href="manage-courses.php" class="nav-link">
                <span class="material-icons">add_circle</span>
                <span class="nav-text">Tambah Course</span>
            </a>
            
            <!-- Link Laporan -->
            <a href="laporan.php" class="nav-link">
                <span class="material-icons">assessment</span>
                <span class="nav-text">Laporan</span>
            </a>
            
            <!-- Link Logout -->
            <a href="loginadmin.php" class="nav-link">
                <span class="material-icons">logout</span>
                <span class="nav-text">Logout</span>
            </a>
        </div>
    </div>
</nav>

<style>
.main-navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.navbar-brand {
    font-size: 24px;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
    display: flex;
    align-items: center;
}

.logo-text {
    margin-left: 10px;
}

.navbar-links {
    display: flex;
    gap: 30px;
}

.nav-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: #555;
    transition: color 0.3s;
}

.nav-link:hover {
    color: var(--primary);
}

.nav-link .material-icons {
    font-size: 24px;
    margin-bottom: 4px;
}

.nav-text {
    font-size: 14px;
    font-weight: 500;
}

/* Tampilan untuk admin */
.navbar-brand::before {
    content: "admin_panel_settings";
    font-family: 'Material Icons';
    font-size: 28px;
    margin-right: 8px;
    color: var(--primary);
}

@media (max-width: 768px) {
    .navbar-links {
        gap: 15px;
    }
    
    .nav-text {
        font-size: 12px;
    }
    
    .navbar-brand::before {
        font-size: 24px;
    }
}

@media (max-width: 576px) {
    .navbar-links {
        gap: 10px;
    }
    
    .nav-text {
        display: none;
    }
    
    .navbar-brand .logo-text {
        display: none;
    }
}
</style>