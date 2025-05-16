<?php
// navbar.php - Navigation bar untuk aplikasi EduLearn
?>

<nav class="main-navbar">
    <div class="navbar-container">
        <!-- Logo yang mengarah ke dashboard -->
        <a href="dashboard.php" class="navbar-brand">
            <span class="logo-text">EduLearn</span>
        </a>
        
        <div class="navbar-links">
            <!-- Link Home -->
            <a href="dashboard.php" class="nav-link">
                <span class="material-icons">home</span>
                <span class="nav-text">Home</span>
            </a>
            
            <!-- Link My Courses -->
            <a href="my-courses.php" class="nav-link">
                <span class="material-icons">menu_book</span>
                <span class="nav-text">My Courses</span>
            </a>
            
            <!-- Link Profile -->
            <a href="profile.php" class="nav-link">
                <span class="material-icons">person</span>
                <span class="nav-text">Profile</span>
            </a>
            
            <!-- Link About Us -->
            <a href="about.php" class="nav-link">
                <span class="material-icons">info</span>
                <span class="nav-text">About Us</span>
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

@media (max-width: 768px) {
    .navbar-links {
        gap: 15px;
    }
    
    .nav-text {
        font-size: 12px;
    }
}
</style>