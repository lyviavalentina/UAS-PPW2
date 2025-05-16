<?php
// tentang.php - About Us page
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - EduLearn</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563EB;
            --light-blue: #EFF6FF;
            --dark-blue: #1E3A8A;
            --gray: #6B7280;
            --light-gray: #F3F4F6;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: #1F2937;
            line-height: 1.6;
            background-color: #F9FAFB;
        }
        
        /* Improved Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
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
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .nav-link {
            text-decoration: none;
            color: var(--gray);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-blue);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
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
        
        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 5%;
        }
        
        /* About Header */
        .about-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }
        
        .about-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }
        
        .about-subtitle {
            font-size: 1.1rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Card Styles */
        .card {
            background: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.03);
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.8rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary-blue);
            border-radius: 3px;
        }
        
        /* Team Section */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .team-member {
            text-align: center;
            padding: 2rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.03);
        }
        
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        
        .member-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        .member-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-blue);
            font-size: 1.1rem;
        }
        
        .member-role {
            color: var(--primary-blue);
            font-weight: 500;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .member-bio {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Stats Section */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--light-blue);
            border-radius: 10px;
        }
        
        .stat-value {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--dark-blue);
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        /* Footer */
        .footer {
            padding: 3rem 5%;
            background: var(--dark-blue);
            color: white;
            text-align: center;
            margin-top: 3rem;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }
        
        .footer-link:hover {
            color: white;
        }
        
        .copyright {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .about-title {
                font-size: 2rem;
            }
            
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Improved Navigation -->
    <nav class="navbar">
        <a href="index.php" class="logo">
            <span class="material-icons logo-icon">school</span>
            <span class="logo-text">EduLearn</span>
        </a>
        <div class="nav-links">
            <a href="index.php" class="nav-link">Beranda</a>
            <a href="#visi" class="nav-link">Visi</a>
            <a href="#tim" class="nav-link">Tim Kami</a>
            <a href="#pencapaian" class="nav-link">Pencapaian</a>
            <a href="login.php" class="btn btn-primary">
                <span class="material-icons">login</span>
                Masuk
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-container">
        <!-- About Header -->
        <section class="about-header">
            <h1 class="about-title">Tentang EduLearn</h1>
            <p class="about-subtitle">Platform pembelajaran online yang membantu ribuan pelajar mencapai tujuan belajar mereka dengan metode yang efektif dan menyenangkan</p>
        </section>
        
        <!-- Vision Section -->
        <section id="visi" class="card">
            <h2 class="section-title">Visi Kami</h2>
            <p>EduLearn didirikan dengan misi untuk membuat pembelajaran berkualitas dapat diakses oleh semua orang. Kami percaya pendidikan adalah hak fundamental yang seharusnya tersedia tanpa hambatan geografis atau finansial.</p>
            <br>
            <p>Dengan teknologi terkini, kami menghadirkan pengalaman belajar yang interaktif dan menyenangkan, membantu pelajar memahami konsep-konsep kompleks dengan cara yang sederhana dan efektif.</p>
        </section>
        
        <!-- Team Section -->
        <section id="tim" class="card">
            <h2 class="section-title">Tim Kami</h2>
            <p>EduLearn dikembangkan oleh tim yang terdiri dari ahli pendidikan, pengembang teknologi, dan desainer yang berdedikasi untuk menciptakan platform belajar terbaik.</p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">LV</div>
                    <h3 class="member-name">Lyvia Valentina</h3>
                    <p class="member-role">Founder & CEO</p>
                    <p class="member-bio">Mantan dosen dengan pengalaman 15+ tahun di bidang pendidikan</p>
                </div>
                
                <div class="team-member">
                    <div class="member-avatar">L</div>
                    <h3 class="member-name">Lyvia</h3>
                    <p class="member-role">CTO</p>
                    <p class="member-bio">Spesialis teknologi pendidikan</p>
                </div>
                
                <div class="team-member">
                    <div class="member-avatar">V</div>
                    <h3 class="member-name">Valentina</h3>
                    <p class="member-role">Lead Developer</p>
                    <p class="member-bio">Pengembang dengan fokus pada sistem pembelajaran</p>
                </div>
                
                <div class="team-member">
                    <div class="member-avatar">V</div>
                    <h3 class="member-name">Via</h3>
                    <p class="member-role">Content Director</p>
                    <p class="member-bio">Perancang kurikulum dan pendidik</p>
                </div>
            </div>
        </section>
        
        <!-- Achievements Section -->
        <section id="pencapaian" class="card">
            <h2 class="section-title">Pencapaian Kami</h2>
            <p>Sejak diluncurkan, EduLearn telah membantu ribuan pelajar dalam perjalanan belajar mereka:</p>
            
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-value">10K+</div>
                    <div class="stat-label">Pengguna Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">500+</div>
                    <div class="stat-label">Materi Pembelajaran</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">95%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">120+</div>
                    <div class="stat-label">Sekolah Mitra</div>
                </div>
            </div>
        </section>
        
        <!-- Technology Section -->
        <section class="card">
            <h2 class="section-title">Teknologi Kami</h2>
            <p>EduLearn dibangun dengan teknologi modern untuk memastikan pengalaman belajar yang optimal:</p>
            <br>
            <ul style="list-style-type: none;">
                <li style="padding: 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-icons" style="color: var(--primary-blue);">check_circle</span>
                    PHP untuk pemrosesan server
                </li>
                <li style="padding: 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-icons" style="color: var(--primary-blue);">check_circle</span>
                    MySQL untuk penyimpanan data
                </li>
                <li style="padding: 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-icons" style="color: var(--primary-blue);">check_circle</span>
                    HTML5, CSS3 dan JavaScript untuk antarmuka
                </li>
                <li style="padding: 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-icons" style="color: var(--primary-blue);">check_circle</span>
                    Desain responsif untuk semua perangkat
                </li>
            </ul>
            <br>
            <p>Kami terus memperbarui platform berdasarkan masukan pengguna dan perkembangan teknologi terbaru.</p>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="index.php" class="footer-link">Beranda</a>
            <a href="tentang.php" class="footer-link">Tentang Kami</a>
            <a href="#" class="footer-link">Kontak</a>
            <a href="#" class="footer-link">Kebijakan Privasi</a>
            <a href="#" class="footer-link">Syarat Penggunaan</a>
        </div>
        <p class="copyright">© 2023 EduLearn. All rights reserved.</p>
    </footer>
</body>
</html>