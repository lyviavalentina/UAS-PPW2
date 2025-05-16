<?php
// manage-courses.php - CRUD Course Management
session_start();

require_once 'config.php';

// Inisialisasi variabel
$error = $success = "";
$course = [
    'course_name' => '',
    'description' => '',
    'category' => 'Mathematics',
    'education_level' => 'SD',
    'class_level' => '1',
    'instructor_id' => ''
];

// Ambil daftar instruktur dari tabel instructor
$instructors = [];
$instructor_sql = "SELECT id, nama, no_telp FROM instructor";
$instructor_result = mysqli_query($conn, $instructor_sql);
if ($instructor_result) {
    while ($row = mysqli_fetch_assoc($instructor_result)) {
        $instructors[] = $row;
    }
}

// Handle CRUD operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create/Update Course
    if (isset($_POST["save_course"])) {
        $course_id = $_POST["course_id"] ?? 0;
        $course_name = sanitize_input($_POST["course_name"]);
        $description = sanitize_input($_POST["description"]);
        $category = sanitize_input($_POST["category"]);
        $education_level = sanitize_input($_POST["education_level"]);
        $class_level = sanitize_input($_POST["class_level"]);
        $instructor_id = sanitize_input($_POST["instructor_id"]);

        // Validasi input
        if (empty($course_name)) {
            $error = "Nama kursus harus diisi";
        } elseif (empty($instructor_id)) {
            $error = "Instruktur harus dipilih";
        } else {
            try {
                if ($course_id > 0) {
                    // Update course
                    $sql = "UPDATE courses SET 
                            course_name = ?, 
                            description = ?, 
                            category = ?, 
                            education_level = ?, 
                            class_level = ?,
                            instructor_id = ?
                            WHERE course_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssssii", 
                        $course_name, $description, $category, 
                        $education_level, $class_level, $instructor_id, $course_id);
                } else {
                    // Create new course
                    $sql = "INSERT INTO courses 
                            (course_name, description, category, 
                            education_level, class_level, instructor_id) 
                            VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssssi", 
                        $course_name, $description, $category, 
                        $education_level, $class_level, $instructor_id);
                }
                
                if (mysqli_stmt_execute($stmt)) {
                    $success = "Kursus berhasil disimpan";
                    if ($course_id == 0) {
                        $course_id = mysqli_insert_id($conn);
                    }
                } else {
                    $error = "Gagal menyimpan kursus: " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } catch (Exception $e) {
                $error = "Error database: " . $e->getMessage();
            }
        }
    }
} elseif (isset($_GET["action"])) {
    // Delete Course
    if ($_GET["action"] == "delete") {
        $course_id = (int)$_GET["id"];
        
        try {
            mysqli_begin_transaction($conn);
            
            // Hapus registrations terlebih dahulu
            $delete_registrations = "DELETE FROM registrations WHERE course_id = ?";
            $stmt1 = mysqli_prepare($conn, $delete_registrations);
            mysqli_stmt_bind_param($stmt1, "i", $course_id);
            mysqli_stmt_execute($stmt1);
            
            // Kemudian hapus course
            $delete_course = "DELETE FROM courses WHERE course_id = ?";
            $stmt2 = mysqli_prepare($conn, $delete_course);
            mysqli_stmt_bind_param($stmt2, "i", $course_id);
            mysqli_stmt_execute($stmt2);
            
            mysqli_commit($conn);
            $success = "Kursus berhasil dihapus";
            
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $error = "Gagal menghapus kursus: " . $e->getMessage();
        }
        
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
    }
    
    // Edit Course - Load data
    if ($_GET["action"] == "edit") {
        $course_id = (int)$_GET["id"];
        $sql = "SELECT * FROM courses WHERE course_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $course_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $course = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
}

// Get all courses with instructor names
$courses = [];
$sql = "SELECT c.*, i.nama as instructor_name 
        FROM courses c 
        LEFT JOIN instructor i ON c.instructor_id = i.id
        ORDER BY c.course_id DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kursus</title>
    <link rel="stylesheet" href="css/styles7.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'navbar_admin.php'; ?>
    <div class="container">
        <div class="header">
            <h1>Kelola Kursus</h1>
            <a href="manage-courses.php" class="btn">Tambah Baru</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <!-- Course Form -->
        <form method="POST" class="course-form">
            <input type="hidden" name="course_id" 
                   value="<?= $course['course_id'] ?? 0 ?>">
            
            <div class="form-group">
                <label>Nama Kursus</label>
                <input type="text" name="course_name" required
                       value="<?= htmlspecialchars($course['course_name']) ?>">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" rows="3"><?= 
                    htmlspecialchars($course['description']) ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="Mathematics" <?= 
                            ($course['category'] == 'Mathematics') ? 'selected' : '' ?>>Matematika</option>
                        <option value="Science" <?= 
                            ($course['category'] == 'Science') ? 'selected' : '' ?>>Sains</option>
                        <option value="Language" <?= 
                            ($course['category'] == 'Language') ? 'selected' : '' ?>>Bahasa</option>
                        <option value="Social Studies" <?= 
                            ($course['category'] == 'Social Studies') ? 'selected' : '' ?>>Sosial</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jenjang Pendidikan</label>
                    <select name="education_level" required>
                        <option value="SD" <?= 
                            ($course['education_level'] == 'SD') ? 'selected' : '' ?>>SD</option>
                        <option value="SMP" <?= 
                            ($course['education_level'] == 'SMP') ? 'selected' : '' ?>>SMP</option>
                        <option value="SMA" <?= 
                            ($course['education_level'] == 'SMA') ? 'selected' : '' ?>>SMA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <input type="number" name="class_level" min="1" max="12" required
                           value="<?= htmlspecialchars($course['class_level']) ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Instruktur</label>
                <select name="instructor_id" required>
                    <option value="">Pilih Instruktur</option>
                    <?php foreach ($instructors as $instructor): ?>
                        <option value="<?= $instructor['id'] ?>" 
                            <?= (isset($course['instructor_id']) && $course['instructor_id'] == $instructor['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($instructor['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" name="save_course" class="btn primary">
                    <?= isset($course['course_id']) ? 'Update' : 'Simpan' ?> Kursus
                </button>
            </div>
        </form>

        <!-- Courses List -->
        <div class="courses-list">
            <?php foreach ($courses as $c): ?>
                <div class="course-item">
                    <div class="course-info">
                        <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                        <p><?= htmlspecialchars($c['description']) ?></p>
                        <div class="course-meta">
                            <span><?= $c['category'] ?></span>
                            <span><?= $c['education_level'] ?> Kelas <?= $c['class_level'] ?></span>
                            <span>Instruktur: <?= htmlspecialchars($c['instructor_name'] ?? 'Belum ditentukan') ?></span>
                        </div>
                    </div>
                    <div class="course-actions">
                        <a href="?action=edit&id=<?= $c['course_id'] ?>" 
                           class="btn icon" title="Edit">
                            <span class="material-icons">edit</span>
                        </a>
                        <a href="?action=delete&id=<?= $c['course_id'] ?>" 
                           class="btn icon danger" title="Hapus"
                           onclick="return confirm('Hapus kursus ini?')">
                            <span class="material-icons">delete</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>