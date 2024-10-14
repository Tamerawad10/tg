<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أخذ قطعة من المخزون</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>أخذ قطعة من المخزون</h2>
    <form action="alearabia_take1.php" method="POST">
       <h2> <label for="part_id">اختر القطعة:</label>
        <select name="part_id" id="part_id" required></h2>
            <?php
          // إعداد اتصال قاعدة البيانات
$servername = "localhost";
$username = "root"; // الافتراضي في XAMPP
$password = ""; // لا يوجد كلمة مرور افتراضية
$dbname = "alwarsha_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

            // التحقق من الاتصال
            if ($conn->connect_error) {
                die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
            }

            // جلب القطع من قاعدة البيانات
            $sql = "SELECT id, name FROM parts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''><h2>لا توجد قطع</h2></option>";
            }

            $conn->close();
            ?>
        </select>
<h2>
        <label for="quantity">الكمية المأخوذة:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        
        <button type="submit">تأكيد</button>
        <button> <a href="alearabia_mg.html">رجوع </a></button>
    </form>

    <!-- زر للعودة إلى الصفحة السابقة -->
    
    </h2>
</body>
</html>
