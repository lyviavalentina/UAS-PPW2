<?php
// about.php - Halaman About Us
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya - EduLearn</title>
    <link rel="stylesheet" href="css/styles1.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .about-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            margin-bottom: 50px;
        }
        
        .developer-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 0 auto 30px;
            max-width: 600px;
            transition: transform 0.3s;
        }
        
        .developer-card:hover {
            transform: translateY(-5px);
        }
        
        .developer-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f8f9fa;
            margin: 0 auto 20px;
            display: block;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            color: var(--primary);
            font-size: 24px;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--primary-light);
        }
        
        .skills-section {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
        }
        
        .skill-item {
            margin-bottom: 15px;
        }
        
        .skill-name {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .progress {
            height: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <!-- Hero Section -->
        <section class="about-hero rounded-3 mb-5">
            <h1 class="display-4 fw-bold">Tentang Pengembang</h1>
            <p class="lead">Pembuat Platform EduLearn</p>
        </section>
        
        <!-- Developer Profile -->
        <section class="mb-5">
            <div class="developer-card text-center">
                <img src="lyvia valentina.jpg" alt="Lyvia Valentina" class="developer-img">
                <h2>Lyvia Valentina</h2>
                <p class="text-muted">Mahasiswa Sistem Informasi UNSRI</p>
                <p class="mb-4">Saya seorang mahasiswa yang passionate di bidang pengembangan web dan pendidikan teknologi. 
                Membangun EduLearn sebagai proyek untuk menerapkan pengetahuan saya dalam menciptakan solusi 
                e-learning yang mudah digunakan dan bermanfaat.</p>
                
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/lyviavalentina" title="LinkedIn"><i class="material-icons">person</i></a>
                    <a href="https://github.com/lyviavalentina" title="GitHub"><i class="material-icons">code</i></a>
                    <a href="https://www.instagram.com/lyviavalentina" title="Instagram"><i class="material-icons">photo_camera</i></a>
                    <a href="valentinalyvia@gmail.com" title="Email"><i class="material-icons">email</i></a>
                </div>
            </div>
        </section>
        
        <!-- Skills Section -->
        <section class="skills-section">
            <h3 class="text-center mb-4">Keahlian</h3>
            
            <div class="skill-item">
                <div class="skill-name">Pengembangan Web (PHP, JavaScript)</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 85%"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-name">Desain UI/UX</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-name">Basis Data (MySQL)</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-name">Machine Learning</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 90%"></div>
                </div>
            </div>
        </section>
        
        <!-- Education -->
        <section class="mb-5">
            <h3 class="mb-3">Pendidikan</h3>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Universitas Sriwijaya (UNSRI)</h5>
                    <p class="card-text">S1 Sistem Informasi</p>
                    <p class="card-text"><small class="text-muted">2023 - Sekarang</small></p>
                </div>
            </div>
        </section>
        
        <!-- Interests -->
        <section class="mb-5">
            <h3 class="mb-3">Minat</h3>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary">Pengembangan Web</span>
                <span class="badge bg-secondary">E-Learning</span>
                <span class="badge bg-success">UI/UX Design</span>
                <span class="badge bg-danger">Teknologi Pendidikan</span>
                <span class="badge bg-warning text-dark">Kecerdasan Buatan</span>
                <span class="badge bg-primary">Machine Learning</span>
            </div>
        </section>
    </div>
    
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>