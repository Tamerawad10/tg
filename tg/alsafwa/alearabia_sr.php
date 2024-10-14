<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alsafwa_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);




// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);

}

// التحقق من وجود كلمة البحث
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);

    // البحث في قاعدة البيانات
    $sql = "SELECT * FROM parts WHERE part_number LIKE '%$search%' OR name LIKE '%$search%' OR fail LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // عرض النتائج مع زر الحذف والتعديل
        echo "<h3>نتائج البحث:</h3>";
        echo "<table border='1' cellpadding='10'><tr><th>اسم المورد </th><th>التاريخ </th><th>اسم القطعة</th><th>رقم القطعة</th><th>السعر</th><th>الكمية</th><th>الملاحظات</th><th>إجراءات</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["fail"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["part_number"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["comm"] . "</td>";
            echo "<td>
                    <form action='alearabin_delete.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' value='حذف' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>
                    </form>
                    <form action='alearabia_edit.php' method='GET' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' value='تعديل'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "لم يتم العثور على نتائج.";
    }
} else {
    echo "يرجى إدخال كلمة البحث.";
}

// إغلاق الاتصال
$conn->close();
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث قطع غيار</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>بحث قطع غيار</h2>
        <form action="alearabia_sr.php" method="GET">
            <div class="form-group">
            <label for="search">بحث برقم أو اسم القطعة او اسم المورد:</label>
                <input type="text" id="search" name="search" required>
            </div>
            <input type="submit" value="بحث">
            <a href="alearabia_mg.html">رجوع </a>
        </form>

        <!-- النتائج ستظهر هنا -->
        <div id="results"></div>
    </div>
</body>
<meta http-equiv='refresh' content='20;url=alearabia_mg.html?search='>
</html>


