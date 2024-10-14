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
    <title>إضافة قطع غيار</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>إضافة قطع غيار</h2>
        <form action="alearabia_mgbl.php" method="POST">

        <div class="form-group">
                <label for="fail">اسم المورد:</label>
                <input type="text" id="fail" name="fail" required>
            </div>
        <div class="form-group">
                <label for="date">التاريخ الادخال:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="name">اسم القطعة:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="part_number">رقم القطعة:</label>
                <input type="text" id="part_number" name="part_number" required>
            </div>

            <div class="form-group">
                <label for="price">السعر:</label>
                <input type="number" id="price" name="price" required step="0.01">
            </div>

            <div class="form-group">
                <label for="quantity">الكمية:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="quantity">الملاحظات:</label>
                <input type="text" id="comm" name="comm" required>
            </div>

            <input type="submit" value="إضافة">
            <a href="alearabia_mg.html">رجوع </a>
        </form>
    </div>
</body>
</html>


