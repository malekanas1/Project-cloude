
<?php

session_start();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';

$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['success']);
unset($_SESSION['old']);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة كورس</title>

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
                <h1>إضافة كورس جديد</h1>
                <p>أدخل بيانات الكورس لإضافته إلى النظام</p>
            </div>


            <!-- نموذج إضافة الكورس -->
            <div class="form-card">

                <form action="add_courses.php" method="POST">

                    <div class="form-group">
                        <label for="course_name">اسم الكورس</label>
<input
    type="text"
    id="course_name"
    name="course_name"
    placeholder="أدخل اسم الكورس"
    required
value="<?php echo htmlspecialchars($old['course_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
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
                            placeholder="أدخل وصف الكورس"
                            rows="5"
                            value="<?php echo htmlspecialchars($old['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        ></textarea>
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
                            إضافة الكورس
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