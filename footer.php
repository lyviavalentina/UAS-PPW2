<footer class="main-footer">
    <div class="footer-container">
        <!-- Logo dan Sosial Media -->
        <div class="footer-section">
            <div class="footer-logo">
                <img src="logo.png" alt="EduLearn Logo" width="120">
            </div>
            <div class="social-links">
                <a href="https://www.instagram.com/lyviavalentina" target="_blank" class="social-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="https://linkedin.com/in/lyviavalentina" target="_blank" class="social-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <a href="https://github.com/lyviavalentina" target="_blank" class="social-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Bagian Tentang -->
        <div class="footer-section">
            <h4 class="footer-title">Tentang</h4>
            <ul class="footer-links">
                <li><a href="about.php">Tentang Kami</a></li>
            </ul>
        </div>

        <!-- Bagian Kursus -->
        <div class="footer-section">
            <h4 class="footer-title">Kursus</h4>
            <ul class="footer-links">
                <li><a href="courses.php?level=SD">SD</a></li>
                <li><a href="courses.php?level=SMP">SMP</a></li>
                <li><a href="courses.php?level=SMA">SMA</a></li>
            </ul>
        </div>

        <!-- Bagian Akun -->
        <div class="footer-section">
            <h4 class="footer-title">Akun</h4>
            <ul class="footer-links">
                <li><a href="my-courses.php">Kursus Saya</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright">
            &copy; 2025 EduLearn. All rights reserved.
        </div>
        <div class="legal-links">
            <a href="privacy.php">Kebijakan Privasi</a>
            <a href="terms.php">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>

<style>
.main-footer {
    background-color: #f8f9fa;
    padding: 40px 0 20px;
    font-family: 'Nunito', sans-serif;
    color: #333;
    margin-top: 50px;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-section {
    flex: 1;
    min-width: 200px;
    margin-bottom: 30px;
    padding: 0 15px;
    text-align: center;
}

.footer-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #2c3e50;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #555;
    text-decoration: none;
    transition: color 0.3s;
    font-size: 14px;
}

.footer-links a:hover {
    color: var(--primary);
}

.footer-bottom {
    border-top: 1px solid #e1e1e1;
    padding-top: 20px;
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
}

.copyright {
    margin-bottom: 10px;
    color: #666;
}

.legal-links {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

.legal-links a {
    color: #666;
    text-decoration: none;
}

.legal-links a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .footer-section {
        flex: 100%;
        text-align: center;
    }
    
    .legal-links {
        flex-direction: column;
        gap: 8px;
    }
}
.footer-logo {
    margin-bottom: 20px;
    text-align: center;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 15px;
}

.social-icon {
    color: #666;
    transition: all 0.3s ease;
    display: flex;
    padding: 8px;
    border-radius: 50%;
}

.social-icon:hover {
    color: var(--primary);
    background-color: rgba(58, 134, 255, 0.1);
    transform: translateY(-2px);
}

.social-icon svg {
    width: 24px;
    height: 24px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .footer-logo {
        margin-bottom: 15px;
    }
    
    .social-links {
        gap: 15px;
        margin-top: 10px;
    }
    
    .social-icon svg {
        width: 20px;
        height: 20px;
    }
}
</style>