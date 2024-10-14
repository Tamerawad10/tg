<?php
session_start();
session_destroy(); // دمر الجلسة
header("Location: llogini.php"); // ارجع إلى صفحة تسجيل الدخول
exit();
?>
