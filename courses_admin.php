<?php
// courses.php - Page to display all courses with filtering

// Start secure session
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

require_once 'config.php';

// Get filter parameter
$level_filter = isset($_GET['level']) ? $_GET['level'] : '';

// Build SQL query with filter
$sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
               u.full_name AS instructor_name, 
               (SELECT COUNT(*) FROM registrations WHERE course_id = c.course_id) AS enrollment_count 
        FROM courses c 
        JOIN users u ON c.instructor_id = u.user_id ";

// Add WHERE clause if filter is set
if (!empty($level_filter)) {
    $sql .= "WHERE c.education_level = '" . mysqli_real_escape_string($conn, $level_filter) . "' ";
}

$sql .= "ORDER BY c.creation_date DESC";

// Fetch courses
$courses = [];
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
}

mysqli_close($conn);

// Helper function to get education level display
function get_education_level_display($level, $class) {
    $levels = [
        'SD' => 'Kelas',
        'SMP' => 'Kelas', 
        'SMA' => 'Kelas'
    ];
    return htmlspecialchars($levels[$level] . ' ' . $class);
}

// Helper function to get course icon
function get_course_icon($category) {
    $icons = [
        'math' => 'calculate',
        'science' => 'science',
        'language' => 'menu_book'
    ];
    return $icons[strtolower($category)] ?? 'school';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - All Courses</title>
    <link rel="stylesheet" href="css/styles3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .filter-chips {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .chip {
            padding: 8px 16px;
            background: #f8f9fa;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            border: 1px solid #dee2e6;
        }
        
        .chip:hover {
            background: #e9ecef;
        }
        
        .chip.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .course-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .course-img {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .course-content {
            padding: 16px;
        }
        
        .course-tag {
            font-size: 12px;
            color: var(--primary);
            background: rgba(58, 134, 255, 0.1);
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 8px;
        }
        
        .course-title {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 18px;
            color: var(--dark);
        }
        
        .course-instructor {
            font-size: 14px;
            color: #6c757d;
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>
<?php include 'navbar_admin.php'; ?>
    <div class="container">
        <div id="app" class="app-frame">
            <div id="main-content">
                <!-- All Courses Screen -->
                <div id="all-courses" class="screen">
                    <div class="header">
                        <a href="dashboard_admin.php" class="back-button">
                            <span class="material-icons">arrow_back</span>
                        </a>
                        <div class="header-title">Semua Kursus</div>
                    </div>
                    
                    <div class="content">
                        <!-- Filter Chips -->
                        <div class="filter-chips">
                            <div class="chip <?= empty($level_filter) ? 'active' : '' ?>" 
                                 onclick="window.location.href='courses_admin.php'">Semua</div>
                            <div class="chip <?= $level_filter === 'SD' ? 'active' : '' ?>" 
                                 onclick="window.location.href='courses_admin.php?level=SD'">SD</div>
                            <div class="chip <?= $level_filter === 'SMP' ? 'active' : '' ?>" 
                                 onclick="window.location.href='courses_admin.php?level=SMP'">SMP</div>
                            <div class="chip <?= $level_filter === 'SMA' ? 'active' : '' ?>" 
                                 onclick="window.location.href='courses_admin.php?level=SMA'">SMA</div>
                        </div>

                        <!-- Course Grid -->
                        <div class="course-grid">
                            <?php if (empty($courses)): ?>
                                <div class="no-results">
                                    <p>Tidak ada kursus yang tersedia untuk level ini.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($courses as $course): ?>
                                <div class="course-card" onclick="window.location.href='course-detail_admin.php?id=<?= $course['course_id'] ?>'">
                                    <div class="course-img" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);">
                                        <span class="material-icons"><?= get_course_icon($course['category']) ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-tag"><?= get_education_level_display($course['education_level'], $course['class_level']) ?></div>
                                        <div class="course-title"><?= htmlspecialchars($course['course_name']) ?></div>
                                        <div class="course-instructor">Oleh <?= htmlspecialchars($course['instructor_name']) ?></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Highlight active chip
        document.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('onclick').match(/window\.location\.href='([^']+)'/)[1];
                window.location.href = url;
            });
        });
    </script>
</body>
</html>