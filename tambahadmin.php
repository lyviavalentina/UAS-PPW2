<?php
// Koneksi ke database
$host = "localhost";
$dbname = "online_course_system";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Data admin
    $adminUsername = "admin";
    $adminPassword = "admin123"; // Ini akan di-hash
    $adminName = "Administrator";
    $adminEmail = "admin@example.com";
    
    // Hash password
    $passwordHash = password_hash($adminPassword, PASSWORD_DEFAULT);
    
    // Query untuk menambahkan admin
    $stmt = $pdo->prepare("INSERT INTO admin (username, password_hash, full_name, email) VALUES (:username, :password_hash, :full_name, :email)");
    $stmt->bindParam(":username", $adminUsername);
    $stmt->bindParam(":password_hash", $passwordHash);
    $stmt->bindParam(":full_name", $adminName);
    $stmt->bindParam(":email", $adminEmail);
    $stmt->execute();
    
    echo "Admin berhasil ditambahkan!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>