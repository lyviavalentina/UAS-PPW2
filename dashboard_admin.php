<?php
// dashboard.php - Main dashboard page

// Start session
session_start();

// Include database connection
require_once 'config.php';

$level_filter = isset($_GET['level']) ? $_GET['level'] : '';

// Fetch popular courses (tanpa filter level)
$popular_courses_sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
                       u.full_name AS instructor_name, 
                       (SELECT COUNT(*) FROM registrations WHERE course_id = c.course_id) AS enrollment_count 
                FROM courses c 
                JOIN users u ON c.instructor_id = u.user_id 
                ORDER BY enrollment_count DESC 
                LIMIT 4";
$popular_courses_result = mysqli_query($conn, $popular_courses_sql);

// Fetch new courses (tanpa filter level)
$new_courses_sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
                    u.full_name AS instructor_name 
                FROM courses c 
                JOIN users u ON c.instructor_id = u.user_id 
                ORDER BY c.creation_date DESC 
                LIMIT 4";
$new_courses_result = mysqli_query($conn, $new_courses_sql);

// Add WHERE clause if filter is set
if (!empty($level_filter)) {
    $popular_courses_sql .= "WHERE c.education_level = '" . mysqli_real_escape_string($conn, $level_filter) . "' ";
    $new_courses_sql .= "WHERE c.education_level = '" . mysqli_real_escape_string($conn, $level_filter) . "' ";
}

// Complete SQL queries
$popular_courses_sql .= "ORDER BY enrollment_count DESC LIMIT 4";
$new_courses_sql .= "ORDER BY c.creation_date DESC LIMIT 4";

// Fetch popular courses
$popular_courses_sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
                       u.full_name AS instructor_name, 
                       (SELECT COUNT(*) FROM registrations WHERE course_id = c.course_id) AS enrollment_count 
                FROM courses c 
                JOIN users u ON c.instructor_id = u.user_id 
                ORDER BY enrollment_count DESC 
                LIMIT 4";
$popular_courses_result = mysqli_query($conn, $popular_courses_sql);

// Fetch new courses
$new_courses_sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
                    u.full_name AS instructor_name 
                FROM courses c 
                JOIN users u ON c.instructor_id = u.user_id 
                ORDER BY c.creation_date DESC 
                LIMIT 4";
$new_courses_result = mysqli_query($conn, $new_courses_sql);

// Function to get education level display name
function get_education_level_display($level, $class) {
    return $level . " Kelas " . $class;
}

// Function to get course icon class based on category
function get_course_icon($category) {
    $icons = [
        'Science' => 'science',
        'Mathematics' => 'calculate',
        'Language' => 'language',
        'Social Studies' => 'history_edu',
        'Arts' => 'palette',
        'Technology' => 'computer',
        'Business' => 'business_center'
    ];
    
    return isset($icons[$category]) ? $icons[$category] : 'school';
}

// Function to get course background style based on category
function get_course_bg_style($category) {
    $styles = [
        'Science' => 'background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);',
        'Mathematics' => 'background: linear-gradient(135deg, #f72585 0%, #b5179e 100%);',
        'Language' => 'background: linear-gradient(135deg, #4895ef 0%, #3f37c9 100%);',
        'Social Studies' => 'background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);',
        'Arts' => 'background: linear-gradient(135deg, #f72585 0%, #7209b7 100%);',
        'Technology' => 'background: linear-gradient(135deg, #2ec4b6 0%, #1b9aaa 100%);',
        'Business' => 'background: linear-gradient(135deg, #ff9e00 0%, #ff7b00 100%);'
    ];
    
    return isset($styles[$category]) ? $styles[$category] : 'background: linear-gradient(135deg, #6a4c93 0%, #4361ee 100%);';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4cc9f0;
            --secondary: #3f37c9;
            --dark: #212529;
            --light: #f8f9fa;
            --gray: #6c757d;
            --success: #2ec4b6;
            --warning: #ff9e00;
            --danger: #e63946;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
        }
        
        .app-frame {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            margin-bottom: 2rem;
        }
        
        .header-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .filter-chips {
            display: flex;
            gap: 10px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .chip {
            padding: 8px 16px;
            background-color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .chip.active {
            background-color: var(--primary);
            color: white;
        }
        
        .chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-title span {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .section-title a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .section-title a:hover {
            text-decoration: underline;
        }
        
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .course-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .course-img {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .course-img .material-icons {
            font-size: 3rem;
            opacity: 0.8;
        }
        
        .course-content {
            padding: 1.25rem;
        }
        
        .course-tag {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .course-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .course-instructor {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        @media (max-width: 768px) {
            .course-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
            
            .header-title {
                font-size: 1.8rem;
            }
            
            .section-title span {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 576px) {
            .course-grid {
                grid-template-columns: 1fr;
            }
            
            .app-frame {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar_admin.php'; ?>
    
    <div class="container">
        <div id="app" class="app-frame">
            <div id="main-content">
                <!-- Dashboard Screen -->
                <div id="dashboard" class="screen">
                    <div class="header">
                        <div class="header-title">Selamat Datang Admin</div>
                        
                        <div class="section-title">
                            <span>Kursus Populer</span>
                            <a href="courses_admin.php?filter=popular">
                                Lihat Semua
                                <span class="material-icons" style="font-size:1rem;">chevron_right</span>
                            </a>
                        </div>
                        
                        <div class="course-grid">
                            <?php if(mysqli_num_rows($popular_courses_result) > 0): ?>
                                <?php while($course = mysqli_fetch_assoc($popular_courses_result)): ?>
                                <div class="course-card" onclick="window.location.href='course-detail_admin.php?id=<?= $course['course_id'] ?>'">
                                    <div class="course-img" style="<?= get_course_bg_style($course['category']) ?>">
                                        <span class="material-icons"><?= get_course_icon($course['category']) ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-tag"><?= get_education_level_display($course['education_level'], $course['class_level']) ?></div>
                                        <div class="course-title"><?= htmlspecialchars($course['course_name']) ?></div>
                                        <div class="course-instructor">Oleh <?= htmlspecialchars($course['instructor_name']) ?></div>
                                        <div class="enrollment-count mt-2 text-muted small">
                                            <span class="material-icons" style="font-size:1rem; vertical-align:middle;">people</span>
                                            <?= $course['enrollment_count'] ?> peserta
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        Tidak ada kursus populer yang tersedia.
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="section-title">
                            <span>Kursus Terbaru</span>
                            <a href="courses_admin.php? filter=new">
                                Lihat Semua
                                <span class="material-icons" style="font-size:1rem;">chevron_right</span>
                            </a>
                        </div>
                        
                        <div class="course-grid">
                            <?php if(mysqli_num_rows($new_courses_result) > 0): ?>
                                <?php while($course = mysqli_fetch_assoc($new_courses_result)): ?>
                                <div class="course-card" onclick="window.location.href='course-detail_admin.php?id=<?= $course['course_id'] ?>'">
                                    <div class="course-img" style="<?= get_course_bg_style($course['category']) ?>">
                                        <span class="material-icons"><?= get_course_icon($course['category']) ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-tag"><?= get_education_level_display($course['education_level'], $course['class_level']) ?></div>
                                        <div class="course-title"><?= htmlspecialchars($course['course_name']) ?></div>
                                        <div class="course-instructor">Oleh <?= htmlspecialchars($course['instructor_name']) ?></div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        Tidak ada kursus baru yang tersedia.
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Aktifkan chip filter saat diklik
        document.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelector('.chip.active').classList.remove('active');
                this.classList.add('active');
                // Tambahkan logika filter di sini
            });
        });
    </script>
</body>
</html>