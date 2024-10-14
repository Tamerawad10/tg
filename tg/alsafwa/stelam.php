<?php

// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alsafwa_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// استعلام SQL لاسترجاع جميع قطع الغيار
$query = "SELECT * FROM parts";
$result = $conn->query($query);

// التحقق من وجود نتائج
if ($result === false) {
    die("فشل الاستعلام: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض قطع الغيار</title>
    <link rel="stylesheet" href="styles_stelam.css">

    <script>
        function printPage() {
            window.print();
        }

        function confirmDelete(partId) {
            if (confirm("هل أنت متأكد من حذف هذه القطعة؟")) {
                window.location.href = 'alearabin_delete.php?id=' + partId;
            }
        }
    </script>
</head>
<body>
    <h2>جميع قطع الغيار</h2>

    <!-- التحقق من وجود قطع غيار لعرضها -->
    <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
            <th>اسم المورد</t>
            <th>التاريخ</t>
                <th>اسم القطعة</th>
                <th>رقم القطعة</th>
                <th>الكمية</th>
                <th>السعر</t>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($row = $result->fetch_assoc()): ?>
            <tr>
            <td><?= $row['fail']; ?></td>
            <td><?= $row['date']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['part_number']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= $row['price']; ?></td>
                <td><?= $row['comm']; ?></td>
                
            
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>لا توجد قطع غيار مدخلة.</p>
    <?php endif; ?>

    <br>
    <button onclick="printPage()">طباعة</button>
    <br><br>
    <a href="alearabia_mg.html">رجوع إلى لوحة التحكم</a>
</body>
</html>
