<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alear_database";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if ( isset($_POST['fail']) && isset($_POST['date']) && isset($_POST['name']) && isset($_POST['part_number']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['comm'])  ) {
       
        $fail = $conn->real_escape_string($_POST['fail']);
        $date = $conn->real_escape_string($_POST['date']);
        $name = $conn->real_escape_string($_POST['name']);
        $part_number = $conn->real_escape_string($_POST['part_number']);
        $comm = $conn->real_escape_string($_POST['comm']);
        $price = floatval($_POST['price']);
        $quantity = intval($_POST['quantity']);
        
        

        
        if ( !empty($fail) && !empty($date) && !empty($name) && !empty($comm) && !empty($part_number) && $price > 0 && $quantity > 0) {
            
            $sql = "INSERT INTO parts (fail, date, name, part_number, price, quantity, comm) VALUES ('$fail', '$date', '$name', '$part_number', '$price', '$quantity', '$comm')";

            if ($conn->query($sql) === TRUE) {
                echo "تم إضافة القطعة بنجاح!";
            } else {
                echo "خطأ: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "يرجى التأكد من ملء جميع الحقول بشكل صحيح.";
        }
    } else {
        echo "بعض الحقول مفقودة.";
    }
} else {
    echo "طريقة غير صحيحة. يجب إرسال البيانات باستخدام POST.";
}

// إغلاق الاتصال
$conn->close();
?>





<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة قطع الغيار</title>
    <link rel="stylesheet" href="stylesd.css">
</head>
<body>
    <div class="container">
        <h1>نظام إدارة قطع الغيار</h1>
        <form action="index.php" method="POST">

        <!-- نموذج إضافة قطعة جديدة -->
        <div class="add-part-form">
            <h2>إضافة قطعة جديدة</h2>
            <input type="text" id="name" placeholder="اسم القطعة" required>
            <input type="number" id="part_number" placeholder="الكمية" min="1" required>
            <input type="number" id="price" placeholder="السعر" min="0" required>
            <button onclick="addPart()">إضافة</button>
        </div>

        <!-- حقل البحث -->
        <input type="text" id="searchInput" placeholder="ابحث عن قطعة..." oninput="searchPart()">

        <!-- جدول عرض القطع المخزنة -->
        <table>
            <thead>
                <tr>
                    <th>اسم القطعة</th>
                    <th>الكمية</th>
                    <th>السعر (ريال)</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="partsTableBody">
                <!-- سيتم تعبئة القطع هنا ديناميكيًا -->
            </tbody>
        </table>
</form>
    </div>

    <script src="script.js"></script>
</body>
</html>
