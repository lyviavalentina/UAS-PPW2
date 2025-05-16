<?php
// dashboard.php - Main dashboard page

// Start session
session_start();

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include database connection
require_once 'config.php';

// Initialize variables for search and filter
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$education_filter = isset($_GET['education_level']) ? $_GET['education_level'] : '';

// Base SQL query for courses
$base_courses_sql = "SELECT c.course_id, c.course_name, c.description, c.category, c.education_level, c.class_level, 
                    u.full_name AS instructor_name, 
                    (SELECT COUNT(*) FROM registrations WHERE course_id = c.course_id) AS enrollment_count 
                FROM courses c 
                JOIN users u ON c.instructor_id = u.user_id ";

// Build WHERE conditions based on filters
$where_conditions = [];
$params = [];
$types = '';

if (!empty($search_query)) {
    $where_conditions[] = "(c.course_name LIKE ? OR c.description LIKE ? OR c.category LIKE ?)";
    $search_param = "%$search_query%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= 'sss';
}

if (!empty($education_filter)) {
    $where_conditions[] = "c.education_level = ?";
    $params[] = $education_filter;
    $types .= 's';
}

// Add WHERE clause if there are conditions
if (!empty($where_conditions)) {
    $base_courses_sql .= " WHERE " . implode(" AND ", $where_conditions);
}

// Fetch popular courses
$popular_courses_sql = $base_courses_sql . " ORDER BY enrollment_count DESC LIMIT 4";
$popular_courses_stmt = $conn->prepare($popular_courses_sql);

if (!empty($params)) {
    $popular_courses_stmt->bind_param($types, ...$params);
}

$popular_courses_stmt->execute();
$popular_courses_result = $popular_courses_stmt->get_result();

// Fetch new courses
$new_courses_sql = $base_courses_sql . " ORDER BY c.creation_date DESC LIMIT 4";
$new_courses_stmt = $conn->prepare($new_courses_sql);

if (!empty($params)) {
    $new_courses_stmt->bind_param($types, ...$params);
}

$new_courses_stmt->execute();
$new_courses_result = $new_courses_stmt->get_result();

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
        'Social Studies' => 'history',
        'Arts' => 'palette'
    ];
    
    return isset($icons[$category]) ? $icons[$category] : 'school';
}

// Function to get course background style based on category
function get_course_bg_style($category) {
    $styles = [
        'Science' => 'background: linear-gradient(135deg, #3a86ff 0%, #4361ee 100%);',
        'Mathematics' => 'background: linear-gradient(135deg, #f72585 0%, #b5179e 100%);',
        'Language' => 'background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);',
        'Social Studies' => 'background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);',
        'Arts' => 'background: linear-gradient(135deg, #f72585 0%, #7209b7 100%);'
    ];
    
    return isset($styles[$category]) ? $styles[$category] : '';
}

// Function to check if a filter is active
function is_filter_active($filter_value) {
    return isset($_GET['education_level']) && $_GET['education_level'] === $filter_value;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Dashboard</title>
    <link rel="stylesheet" href="css/styles1.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-bar {
    display: flex;
    align-items: center;
    width: 100%;
    background: white;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    gap: 10px;
}

.search-bar:focus-within {
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}

.search-icon {
    color: #9e9e9e;
    margin-left: 25px;
    font-size: 24px;
    flex-shrink: 0;
}

.search-input {
    border: none;
    outline: none;
    flex: 1;
    padding: 20px 0;
    font-size: 16px;
    font-family: 'Nunito', sans-serif;
    color: #333;
    background: transparent;
    min-width: 50px;
    padding: 20px 0 20px 100px;
}

.search-input::placeholder {
    color: #bdbdbd;
    padding: 20px 0 20px 100px;
    font-weight: 400;
}

.search-button {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0 30px;
    cursor: pointer;
    transition: all 0.3s;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    height: 60px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-shrink: 0;
}

.search-button:hover {
    background: var(--primary-dark);
}

.search-button .material-icons {
    font-size: 22px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .search-bar {
        flex-direction: column;
        border-radius: 15px;
        padding: 15px;
        gap: 15px;
    }
    
    .search-icon {
        margin: 0 0 10px 0;
        align-self: flex-start;
    }
    
    .search-input {
        width: 100%;
    }
    
    .search-button {
        width: 100%;
        justify-content: center;
        height: auto;
        padding: 15px;
    }
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
        
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0 15px;
        }
        
        .section-title span {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .section-title a {
            color: var(--primary);
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        .section-title a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
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
        
        .course-img .material-icons {
            font-size: 48px;
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
<?php include 'navbar.php'; ?>
    <div class="container">
        <div id="app" class="app-frame">
            <div id="main-content">
                <!-- Dashboard Screen -->
                <div id="dashboard" class="screen">
                    <div class="content">
                        <div class="dashboard">
                            <form method="GET" action="dashboard.php" class="d-flex flex-column align-items-center">
                                <div class="search-bar">
                                    <span class="material-icons search-icon">search</span>
                                    <input type="text" class="search-input" name="search" placeholder="Search for courses..." 
                                           value="<?php echo htmlspecialchars($search_query); ?>">
                                    <button type="submit" class="search-button">Search</button>
                                </div>
                            </form>
                            
                            <div class="carousel-container mb-4">
                                <div id="eduCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        <div class="carousel-item active" data-bs-interval="5000">
                                            <img src="Gambar 1.png" class="d-block w-100" alt="EduLearn 1">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3>Welcome to EduLearn</h3>
                                                <p>Start your learning journey with us</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item" data-bs-interval="5000">
                                            <img src="Gambar 1.jpg" class="d-block w-100" alt="EduLearn 2">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3>Expert Instructors</h3>
                                                <p>Learn from industry professionals</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item" data-bs-interval="5000">
                                            <img src="Gambar 3.png" class="d-block w-100" alt="EduLearn 3">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3>Interactive Courses</h3>
                                                <p>Engaging and practical learning materials</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#eduCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#eduCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <form method="GET" action="dashboard.php" class="d-flex flex-column align-items-center">
                                <div class="filter-chips">
                                    <div class="chip <?php echo empty($education_filter) ? 'active' : ''; ?>" 
                                         onclick="window.location.href='dashboard.php?search=<?php echo urlencode($search_query); ?>'">All</div>
                                    <div class="chip <?php echo is_filter_active('SD') ? 'active' : ''; ?>" 
                                         onclick="window.location.href='dashboard.php?search=<?php echo urlencode($search_query); ?>&education_level=SD'">Elementary (SD)</div>
                                    <div class="chip <?php echo is_filter_active('SMP') ? 'active' : ''; ?>" 
                                         onclick="window.location.href='dashboard.php?search=<?php echo urlencode($search_query); ?>&education_level=SMP'">Junior High (SMP)</div>
                                    <div class="chip <?php echo is_filter_active('SMA') ? 'active' : ''; ?>" 
                                         onclick="window.location.href='dashboard.php?search=<?php echo urlencode($search_query); ?>&education_level=SMA'">High School (SMA)</div>
                                </div>
                            </form>
                            
                            <div class="section-title">
                                <span>Popular Courses</span>
                                <a href="courses.php?filter=popular<?php echo !empty($education_filter) ? '&education_level='.$education_filter : ''; ?><?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>">See All</a>
                            </div>
                            
                            <div class="course-grid">
                                <?php
                                // Display popular courses
                                if(mysqli_num_rows($popular_courses_result) > 0){
                                    while($course = mysqli_fetch_assoc($popular_courses_result)){
                                ?>
                                <div class="course-card" onclick="window.location.href='course-detail.php?id=<?php echo $course['course_id']; ?>'">
                                    <div class="course-img" style="<?php echo get_course_bg_style($course['category']); ?>">
                                        <span class="material-icons"><?php echo get_course_icon($course['category']); ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-tag"><?php echo get_education_level_display($course['education_level'], $course['class_level']); ?></div>
                                        <div class="course-title"><?php echo $course['course_name']; ?></div>
                                        <div class="course-instructor">By <?php echo $course['instructor_name']; ?></div>
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    echo '<div class="no-results">No courses found matching your criteria.</div>';
                                }
                                ?>
                            </div>
                            
                            <div class="section-title">
                                <span>New Courses</span>
                                <a href="courses.php?filter=new<?php echo !empty($education_filter) ? '&education_level='.$education_filter : ''; ?><?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>">See All</a>
                            </div>
                            
                            <div class="course-grid">
                                <?php
                                // Display new courses
                                if(mysqli_num_rows($new_courses_result) > 0){
                                    while($course = mysqli_fetch_assoc($new_courses_result)){
                                ?>
                                <div class="course-card" onclick="window.location.href='course-detail.php?id=<?php echo $course['course_id']; ?>'">
                                    <div class="course-img" style="<?php echo get_course_bg_style($course['category']); ?>">
                                        <span class="material-icons"><?php echo get_course_icon($course['category']); ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-tag"><?php echo get_education_level_display($course['education_level'], $course['class_level']); ?></div>
                                        <div class="course-title"><?php echo $course['course_name']; ?></div>
                                        <div class="course-instructor">By <?php echo $course['instructor_name']; ?></div>
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    echo '<div class="no-results">No courses found matching your criteria.</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to filter chips when clicked
        document.addEventListener('DOMContentLoaded', function() {
            const chips = document.querySelectorAll('.chip');
            
            chips.forEach(chip => {
                chip.addEventListener('click', function(e) {
                    // Prevent form submission if chip is inside a form
                    e.preventDefault();
                    
                    // Get the URL from the onclick attribute
                    const url = this.getAttribute('onclick').match(/window\.location\.href='([^']+)'/)[1];
                    window.location.href = url;
                });
            });
        });
    </script>
</body>
</html>