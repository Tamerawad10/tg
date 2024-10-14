<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alsafwa_database";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}


// التحقق من استلام الـ ID عبر GET أو POST
if (isset($_GET['id']) || isset($_POST['id'])) {
    // إذا تم الإرسال باستخدام GET، نستخدم الـ ID لجلب بيانات القطعة
    $id = isset($_GET['id']) ? intval($_GET['id']) : intval($_POST['id']);

    // جلب بيانات القطعة بناءً على ID فقط في حالة الطلب عبر GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sql = "SELECT * FROM parts WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "لم يتم العثور على القطعة المطلوبة.";
            exit;
        }
    }
}

// التحقق من أن النموذج تم تقديمه عبر POST (عملية التحديث)
$message = '';  // متغير لعرض رسالة بعد التحديث
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $name = $conn->real_escape_string($_POST['fail']);
    $name = $conn->real_escape_string($_POST['name']);
    $part_number = $conn->real_escape_string($_POST['part_number']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $date = $conn->real_escape_string($_POST['date']);

    // تحديث بيانات القطعة في قاعدة البيانات
    $sql = "UPDATE parts SET name='$name', part_number='$part_number', price='$price', quantity='$quantity', date='$date', fail='$fail', WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // إذا تم التحديث بنجاح، نعرض رسالة ونقوم بتوجيه المستخدم بعد ثوانٍ
        $message = "تم تحديث البيانات بنجاح!";
        echo "<meta http-equiv='refresh' content='3;url=alearabia_sr.php?search=$part_number'>";
    } else {
        $message = "حدث خطأ أثناء التحديث: " . $conn->error;
    }
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل القطعة</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>تعديل القطعة</h2>
        
        <!-- عرض رسالة النجاح أو الخطأ -->
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="alearabia_edit.php" method="POST">
            <!-- تأكد من إرسال ID القطعة مع النموذج -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="fail">اسم المورد:</label>
                <input type="text" id="fail" name="fail" value="<?php echo isset($row['fail']) ? $row['fail'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="date">تاريخ :</label>
                <input type="" id="date" name="date" value="<?php echo isset($row['date']) ? $row['date'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="name">اسم القطعة:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="part_number">رقم القطعة:</label>
                <input type="text" id="part_number" name="part_number" value="<?php echo isset($row['part_number']) ? $row['part_number'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="price">السعر:</label>
                <input type="number" id="price" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" required step="0.01">
            </div>

            <div class="form-group">
                <label for="quantity">الكمية:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo isset($row['quantity']) ? $row['quantity'] : ''; ?>" required>
            </div>

            <input type="submit" value="تحديث">
        </form>
        <a href="alearabia_mg.html">رجوع </a>
    </div>
</body>
</html>
