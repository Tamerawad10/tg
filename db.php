<?php
$host = 'localhost';
$dbname = 'user_system';
$username = 'root';  // استخدم اسم المستخدم المناسب
$password = '';      // استخدم كلمة المرور المناسبة

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
