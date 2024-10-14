<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alwarsha_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من أن الـ ID تم إرساله عبر POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // حذف القطعة من قاعدة البيانات
    $sql = "DELETE FROM parts WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>تم حذف القطعة بنجاح!</h2>";
        echo "<meta http-equiv='refresh' content='4;url=alearabia_sr.php?search='>";
    } else {
        echo "<h2>خطأ أثناء الحذف: </h2>" . $conn->error;
    }
} else {
    echo "<h2>طلب غير صالح.</h2>";
}


// إغلاق الاتصال
$conn->close();

?>
<link rel="stylesheet" href="styles.css">
<title> جاري الحذف</title>