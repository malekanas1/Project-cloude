

<?php


require_once('config.php');



$errors=[];
$sql = "SELECT id,name
        FROM students
        ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);




require_once('config.php');

$sql = "SELECT course_id, course_name, description, price
        FROM courses
        ORDER BY course_id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
|--------------------------------------------------------------------------
| استقبال البيانات
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $student_id = trim($_POST['student_id'] ?? '');
    $course_id  = trim($_POST['course_id'] ?? '');
    $period     = trim($_POST['period'] ?? '');





/*
-------------------------------------------------------------------------
    | التحقق من الطالب
    |--------------------------------------------------------------------------
*/

    if (empty($student_id))
    {
        $errors['student_id'] = 'يجب اختيار الطالب.';
    }


    /*
    |--------------------------------------------------------------------------
    | التحقق من الكورس
    |--------------------------------------------------------------------------
    */

    if (empty($course_id))
    {
        $errors['course_id'] = 'يجب اختيار الكورس.';
    }


    /*
    |--------------------------------------------------------------------------
    | التحقق من الفترة
    |--------------------------------------------------------------------------
    */

    if (empty($period))
    {
        $errors['period'] = 'يجب اختيار الفترة.';
    }

  /*
    |--------------------------------------------------------------------------
    | إضافة العلاقة
    |--------------------------------------------------------------------------
    */

    if (empty($errors))
    {
        $sql = "INSERT INTO course_student
                (course_id, student_id, date, period)
                VALUES
                (:course_id, :student_id, :date, :period)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':course_id'  => $course_id,
            ':student_id' => $student_id,
            ':date'       => date('Y-m-d'),
            ':period'     => $period
        ]);

        header("Location: index.php");
        exit;
    }

}


?>





<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة طالب إلى كورس</title>
</head>
<style>

    /* ================================
   إعدادات عامة
================================ */

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    color: #222;
    direction: rtl;
}


/* ================================
   الحاوية
================================ */

form {
    width: 450px;
    max-width: 90%;
    margin: 70px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}


/* ================================
   العنوان
================================ */

h1 {
    width: 450px;
    max-width: 90%;
    margin: 50px auto 20px;
    text-align: center;
    font-size: 28px;
}


/* ================================
   Labels
================================ */

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}


/* ================================
   Select
================================ */

select {
    width: 100%;
    padding: 12px;
    margin-bottom: 6px;

    border: 1px solid #d0d5db;
    border-radius: 7px;

    background: #fff;
    font-size: 15px;

    outline: none;
    cursor: pointer;

    transition: 0.2s;
}

select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}


/* ================================
   رسائل الخطأ
================================ */

div {
    color: #dc2626;
    font-size: 14px;
    margin-bottom: 18px;
}


/* ================================
   زر التسجيل
================================ */

button {
    width: 100%;
    padding: 13px;

    margin-top: 15px;

    border: none;
    border-radius: 7px;

    background: #2563eb;
    color: white;

    font-size: 16px;
    font-weight: bold;

    cursor: pointer;

    transition: 0.2s;
}

button:hover {
    background: #1d4ed8;
}


/* ================================
   الشاشات الصغيرة
================================ */

@media (max-width: 600px) {

    form {
        margin-top: 40px;
        padding: 22px;
    }

    h1 {
        margin-top: 30px;
        font-size: 24px;
    }

}
</style>
<body>

<h1>إضافة طالب إلى كورس</h1>

<form method="POST">

    <!-- الطالب -->

    <label for="student_id">الطالب</label>

    <select name="student_id" id="student_id">

        <option value="">اختر الطالب</option>

        <?php foreach ($students as $student): ?>

            <option value="<?= htmlspecialchars($student['id']) ?>"
                <?= (isset($id) && $id == $student['id']) ? 'selected' : '' ?>>

                <?= htmlspecialchars($student['name']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <?php if (isset($errors['id'])): ?>
        <div>
            <?= htmlspecialchars($errors['id']) ?>
        </div>
    <?php endif; ?>


    <!-- الكورس -->

    <label for="course_id">الكورس</label>

    <select name="course_id" id="course_id">

        <option value="">اختر الكورس</option>

        <?php foreach ($courses as $course): ?>

            <option value="<?= htmlspecialchars($course['course_id']) ?>"
                <?= (isset($course_id) && $course_id == $course['course_id']) ? 'selected' : '' ?>>

                <?= htmlspecialchars($course['course_name']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <?php if (isset($errors['course_id'])): ?>
        <div>
            <?= htmlspecialchars($errors['course_id']) ?>
        </div>
    <?php endif; ?>


    <!-- الفترة -->

    <label for="period">الفترة</label>

    <select name="period" id="period">

        <option value="">اختر الفترة</option>

        <option value="صباحي"
            <?= (isset($period) && $period === 'صباحي') ? 'selected' : '' ?>>
            صباحي
        </option>

        <option value="مسائي"
            <?= (isset($period) && $period === 'مسائي') ? 'selected' : '' ?>>
            مسائي
        </option>

    </select>

    <?php if (isset($errors['period'])): ?>
        <div>
            <?= htmlspecialchars($errors['period']) ?>
        </div>
    <?php endif; ?>


    <button type="submit">تسجيل الطالب</button>

</form>

</body>
</html>