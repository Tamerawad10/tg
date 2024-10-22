<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':full_name' => $full_name,
            ':email' => $email,
            ':password' => $password
        ]);

        // إعادة التوجيه إلى صفحة النجاح
        header("Location: success.html");
        exit(); // إنهاء تنفيذ السكربت بعد التوجيه
    } catch (PDOException $e) {
        echo "خطأ: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #55efc4, #81ecec);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #2d3436;
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            background-color: #00b894;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #55efc4;
        }

        .form-container p {
            margin-top: 20px;
            font-size: 14px;
        }

        .form-container a {
            color: #6c5ce7;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>إنشاء حساب جديد</h2>
        <form action="signup.php" method="POST">
    <input type="text" name="full_name" placeholder="الاسم الكامل" required>
    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
    <input type="password" name="password" placeholder="كلمة المرور" required>
    <button type="submit">إنشاء حساب</button>
</form>

        <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>

</body>
</html>
