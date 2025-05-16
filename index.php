<?php
// index.php - EduLearn Landing Page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Platform Belajar Online</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563EB;
            --light-blue: #EFF6FF;
            --dark-blue: #1E3A8A;
            --gray: #6B7280;
            --light-gray: #F9FAFB;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #1F2937;
            line-height: 1.6;
        }
        
        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            color: var(--primary-blue);
            font-size: 2rem;
        }
        
        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue);
            background: linear-gradient(to right, #2563EB, #3B82F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        
        .nav-link {
            text-decoration: none;
            color: var(--gray);
            font-weight: 600;
            transition: all 0.3s;
            padding: 0.5rem 0;
            position: relative;
            font-size: 0.95rem;
        }
        
        .nav-link:hover {
            color: var(--primary-blue);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-blue);
            transition: width 0.3s;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            font-size: 0.95rem;
            cursor: pointer;
        }
        
        .btn-primary {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.2);
        }
        
        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        /* Hero Section */
        .hero {
            padding: 6rem 5% 4rem;
            text-align: center;
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        }
        
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.6;
        }
        
        .hero-image {
            max-width: 800px;
            width: 100%;
            margin: 3rem auto 0;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        /* Features */
        .features {
            padding: 5rem 5%;
            background: var(--light-gray);
        }
        
        .section-title {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 3rem;
            font-size: 1.1rem;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #E5E7EB;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            background: var(--light-blue);
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary-blue);
            font-size: 1.8rem;
            transition: all 0.3s;
        }
        
        .feature-card:hover .feature-icon {
            background: var(--primary-blue);
            color: white;
        }
        
        .feature-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-blue);
        }
        
        .feature-desc {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* CTA */
        .cta {
            padding: 5rem 5%;
            background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%);
            text-align: center;
            color: white;
        }
        
        .cta .section-title,
        .cta .section-subtitle {
            color: white;
        }
        
        .cta .section-subtitle {
            opacity: 0.9;
        }
        
        .cta .btn-primary {
            background: white;
            color: var(--primary-blue);
            font-weight: 700;
        }
        
        .cta .btn-primary:hover {
            background: var(--light-gray);
            color: var(--dark-blue);
        }
        
        /* Footer */
        .footer {
            padding: 3rem 5%;
            background: var(--dark-blue);
            color: white;
            text-align: center;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        .footer-link:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
        
        .copyright {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin-top: 1rem;
                gap: 1rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <span class="material-icons logo-icon">school</span>
            <span class="logo-text">EduLearn</span>
        </div>
        <div class="nav-links">
            <a href="index.php" class="nav-link">Beranda</a>
            <a href="#features" class="nav-link">Fitur</a>
            <a href="tentang.php" class="nav-link">Tentang</a>
            <a href="login.php" class="btn btn-primary">
                <span class="material-icons">login</span>
                Masuk
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1 class="hero-title">Belajar Lebih Mudah dengan EduLearn</h1>
        <p class="hero-subtitle">Platform pembelajaran online dengan materi lengkap dan latihan soal terstruktur untuk membantu Anda menguasai berbagai mata pelajaran</p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="register.php" class="btn btn-primary">
                <span class="material-icons">person_add</span>
                Daftar Sekarang
            </a>
            <a href="#features" class="btn" style="background: white; color: var(--primary-blue); border: 1px solid #E5E7EB;">
                <span class="material-icons">info</span>
                Pelajari Lebih Lanjut
            </a>
        </div>
        <img src="belajar online.jpg" alt="Belajar Online" class="hero-image">
    </section>

    <!-- Features -->
    <section class="features" id="features">
        <h2 class="section-title">Fitur EduLearn</h2>
        <p class="section-subtitle">Platform kami menyediakan berbagai fitur untuk mendukung proses belajar Anda</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">library_books</span>
                </div>
                <h3 class="feature-title">Materi Lengkap</h3>
                <p class="feature-desc">Koleksi modul pembelajaran berbagai mata pelajaran yang disusun oleh ahli pendidikan dengan pendekatan mudah dipahami</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">quiz</span>
                </div>
                <h3 class="feature-title">Latihan Soal</h3>
                <p class="feature-desc">Bank soal dengan pembahasan lengkap untuk menguji pemahaman Anda, dilengkapi dengan sistem penilaian otomatis</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">trending_up</span>
                </div>
                <h3 class="feature-title">Progress Belajar</h3>
                <p class="feature-desc">Pantau perkembangan belajar dan identifikasi topik yang perlu diperdalam dengan dashboard analisis belajar</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">videocam</span>
                </div>
                <h3 class="feature-title">Video Pembelajaran</h3>
                <p class="feature-desc">Koleksi video pembelajaran interaktif dengan pengajar berpengalaman untuk penjelasan visual</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">forum</span>
                </div>
                <h3 class="feature-title">Diskusi</h3>
                <p class="feature-desc">Forum diskusi dengan pengajar dan sesama pelajar untuk bertanya dan berbagi pengetahuan</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <span class="material-icons">mobile_friendly</span>
                </div>
                <h3 class="feature-title">Akses Mobile</h3>
                <p class="feature-desc">Belajar kapan saja, di mana saja dengan aplikasi mobile yang kompatibel di berbagai perangkat</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <h2 class="section-title">Mulai Belajar Sekarang</h2>
        <p class="section-subtitle">Bergabung dengan ribuan pelajar lainnya yang telah menggunakan EduLearn untuk mencapai tujuan belajar mereka</p>
        <a href="register.php" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.1rem;">
            <span class="material-icons">rocket_launch</span>
            Gabung Gratis
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#" class="footer-link">Beranda</a>
            <a href="#features" class="footer-link">Fitur</a>
            <a href="tentang.php" class="footer-link">Tentang Kami</a>
            <a href="#" class="footer-link">Kontak</a>
            <a href="#" class="footer-link">Kebijakan Privasi</a>
            <a href="#" class="footer-link">Syarat Penggunaan</a>
        </div>
        <p class="copyright">© 2023 EduLearn. All rights reserved.</p>
    </footer>
</body>
</html>