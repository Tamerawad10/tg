<?php
session_start(); // بدء جلسة جديدة

// إعداد اتصال قاعدة البيانات
$servername = "localhost";
$username = "root"; // الافتراضي في XAMPP
$password = ""; // لا يوجد كلمة مرور افتراضية
$dbname = "alwarsha_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// الحصول على بيانات القطعة والكمية المأخوذة من النموذج
$part_id = $_POST['part_id'];
$quantity_taken = $_POST['quantity'];

// التحقق من أن القيم المدخلة صحيحة
if (isset($part_id) && isset($quantity_taken) && $quantity_taken > 0) {

    // الحصول على الكمية الحالية من قاعدة البيانات
    $sql = "SELECT quantity FROM parts WHERE id = $part_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // استرجاع الكمية الحالية
        $row = $result->fetch_assoc();
        $current_quantity = $row['quantity'];

        // التحقق مما إذا كانت الكمية المأخوذة أقل أو تساوي الكمية المتاحة
        if ($quantity_taken <= $current_quantity) {
            // تقليل الكمية
            $new_quantity = $current_quantity - $quantity_taken;

            // تحديث الكمية في قاعدة البيانات
            $update_sql = "UPDATE parts SET quantity = $new_quantity WHERE id = $part_id";
            if ($conn->query($update_sql) === TRUE) {
                echo "<h2>تم أخذ </h2><h2>$quantity_taken</h2> <h2>من القطعة بنجاح! الكمية الجديدة:</h2> <h2>$new_quantity</h2>";
                echo "<meta http-equiv='refresh' content='4;url=alearabia_take.php?search='>";
            } else {
                echo "خطأ في تحديث الكمية: " . $conn->error;
            }
        } else {
            echo "<h2>خطأ:</h2> <h2> الكمية المأخوذة أكبر من الكمية المتاحة!</h2>";
            echo "<meta http-equiv='refresh' content='4;url=alearabia_take.php?search='>";
        }
    } else {
        echo "<h2>خطأ:</h2><h2> القطعة غير موجودة!</h2>";
        echo "<meta http-equiv='refresh' content='4;url=alearabia_take.php?search='>";
    }

} else {
    echo "الرجاء إدخال بيانات صحيحة.";
    echo "<meta http-equiv='refresh' content='4;url=alearabia_take.php?search='>";
}

$conn->close();
?>

<!-- زر للعودة إلى الصفحة السابقة -->
<br>

<link rel="stylesheet" href="styles.css">
<title> جاري اخذ من المخزون</title>
<button><a href="alearabia_mg.html">رجوع </a></button>