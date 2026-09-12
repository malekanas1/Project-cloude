<?php
require_once ('config.php');



$errors=[];


if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    exit('معرف الكورس غير موجود');
}

$sql = "SELECT *
        FROM courses
        WHERE course_id = :course_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':course_id' => $course_id
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');


    // التحقق من اسم الكورس
    if ($name === '')
    {
        $errors['name'] = "اسم الكورس مطلوب.";
    }
    elseif (mb_strlen($name, 'UTF-8') < 3 || mb_strlen($name, 'UTF-8') > 100)
    {
        $errors['name'] = "اسم الكورس يجب أن يكون بين 3 و100 حرف.";
    }


    // التحقق من الوصف
    if ($description === '')
    {
        $errors['description'] = "وصف الكورس مطلوب.";
    }
    elseif (mb_strlen($description, 'UTF-8') < 3 || mb_strlen($description, 'UTF-8') > 500)
    {
        $errors['description'] = "وصف الكورس يجب أن يكون بين 3 و500 حرف.";
    }


    // التحقق من السعر
    if ($price === '')
    {
        $errors['price'] = "سعر الكورس مطلوب.";
    }
    elseif (!is_numeric($price))
    {
        $errors['price'] = "سعر الكورس يجب أن يكون رقمًا.";
    }
    elseif ($price < 0)
    {
        $errors['price'] = "سعر الكورس لا يمكن أن يكون سالبًا.";
    }


   
if(empty($errors))
    {
        

    // إذا لم توجد أخطاء
    $sql = "UPDATE courses
SET
    course_name = :course_name,
    Description = :description,
    price = :price
WHERE course_id = :course_id;  ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':course_name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':course_id'=>$course_id,
    ]);



    header("Location: show_courses.php");

    exit;
    }
}









?>



<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الكورس</title>

    <link rel="stylesheet" href="add_cour.css">
</head>

<body>

    <!-- الشريط العلوي -->
    <header class="navbar">
        <div class="container navbar-content">

            <div class="logo">
                نظام إدارة الطلاب
            </div>

            <nav>
                <a href="index.php">الرئيسية</a>
                <a href="show_students.php">الطلاب</a>
                <a href="show_courses.php" class="active">الكورسات</a>
            </nav>

        </div>
    </header>


    <!-- المحتوى الرئيسي -->
    <main class="main-content">

        <div class="container">

            <div class="page-header">
                <h1>تعديل الكورس</h1>
                <p>أدخل بيانات الكورس لتعديلها في النظام</p>
            </div>


            <!-- نموذج تعديل الكورس -->
            <div class="form-card">

                <form action="" method="POST">

                    <div class="form-group">
                        <label for="course_name">اسم الكورس</label>
<input
    type="text"
    id="course_name"
    name="course_name"
    placeholder="أدخل اسم الكورس"
    required
value="<?php echo htmlspecialchars($result[0]['course_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
>
</div>
          

<?php if (isset($errors['name'])): ?>
<div class="error-message">
    <?php echo $errors['name']; ?>
</div>
<?php endif; ?>


                    <div class="form-group">
    <label for="description">وصف الكورس</label>

    <textarea
        id="description"
        name="description"
        rows="5"
        placeholder="أدخل وصف الكورس"><?= htmlspecialchars($result[0]['Description']) ?></textarea>


</div>
<?php if (isset($errors['description'])): ?>
<div class="error-message">
    <?php echo $errors['description']; ?>
</div>
<?php endif; ?>


<div class="form-group">
    <label for="price">سعر الكورس</label>

    <input
        type="number"
        id="price"
        name="price"
        placeholder="مثال: 100"
        value="<?= htmlspecialchars($result[0]['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        step="0.01"
        min="0"
    >
</div>
<?php if (isset($errors['price'])): ?>
<div class="error-message">
    <?php echo $errors['price']; ?>
</div>
<?php endif; ?>


                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            حفظ التعديل
                        </button>

                        <a href="#" class="btn btn-secondary">
                            إلغاء
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</body>
</html>