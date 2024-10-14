<?php
session_start(); // بدء جلسة جديدة

// إعداد اتصال قاعدة البيانات
$servername = "localhost";
$username = "root"; // الافتراضي في XAMPP
$password = ""; // لا يوجد كلمة مرور افتراضية
$dbname = "user_db";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // الاستعلام عن المستخدم
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        // تحقق من كلمة المرور
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username; // تخزين اسم المستخدم في الجلسة
            header("Location: long.html"); // توجيه المستخدم إلى الصفحة الرئيسية
            exit(); // تأكد من استخدام exit بعد header
              
           
            
       
        } else {
            echo "<p style='color: red;'>اسم المستخدم أو كلمة المرور غير صحيحة.</p>";
        }
    } else {
        echo "<p style='color: red;'>اسم المستخدم أو كلمة المرور غير صحيحة.</p>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة تسجيل الدخول</title>
    <link rel="stylesheet" href="login.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 50px 50px;}
        form { max-width: 400px; }
        input[type="text"], input[type="password"] { width: 80%; padding: 10px; margin: 10px 20px; }
        input[type="submit"] { width: 40%; padding: 10px; margin: 10px 90px; }
        
    </style>

</head>
<body>
<h2>(العربية)</h2>

    <h4>
    <a href="/tg/open.html">تسجيل خروج</a>
</h4>
<form method="POST" action="">
<h2>تسجيل الدخول</h2>

    <label for="username"></label>
    <input type="text" id="username" name="username" required placeholder="الاسم المستخدم">

    <label for="password"></label>
    <input type="password" id="password" name="password" required placeholder=" كلمة المرور">

<hj>
    <input type="submit" value="تسجيل الدخول">
</hj>
</form>
<meta http-equiv='refresh' content='20;url=/tg/open.html?search='>
</body>
</html>

