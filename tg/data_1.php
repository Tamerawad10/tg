<?php


try {
    // الاتصال بقاعدة البيانات العربية
    $pdo1 = new PDO("mysql:host=localhost;dbname=alear_database", "root", "");
    $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // الاتصال بقاعدة البيانات الورشة
    $pdo2 = new PDO("mysql:host=localhost;dbname=alwarsha_database", "root", "");
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // استعلام لجلب بيانات من قاعدة البيانات الورشة
    $stmt = $pdo2->query("SELECT name, quantity , date , part_number , price  FROM parts");

      // الاتصال بقاعدة البيانات الصفوة
      $pdo2 = new PDO("mysql:host=localhost;dbname=alsafwa_database", "root", "");
      $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       // استعلام لجلب بيانات من قاعدة البيانات الصفوة
    $stmt = $pdo2->query("SELECT name, quantity , date , part_number , price  FROM parts");
   

} 

catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
// العربية
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alear_database";

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
<a href="open.html">رجوع إلى لوحة التحكم</a>
<h2>جميع قطع الغيار (العربية)</h2>

    <!-- التحقق من وجود قطع غيار لعرضها -->
    <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
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
    
    <br><br>
    


<?php
//الورشة
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alwarsha_database";

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
    <h2>جميع قطع الغيار (الورشة)</h2>

    <!-- التحقق من وجود قطع غيار لعرضها -->
    <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
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
    
    <br><br>
    


<?php
//الصفوة
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
    <h2>جميع قطع الغيار (الصفوة)</h2>

    <!-- التحقق من وجود قطع غيار لعرضها -->
    <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
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
    
    <meta http-equiv='refresh' content='20;url=open.html?search='>
</body>
</html>