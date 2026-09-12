<?php

require_once ('config.php');




$errors = [];

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
} else {
    exit('معرف الطالب غير موجود');
}

$sql="select * from students where id = :student_id";

$stmt=$pdo->prepare($sql);
$stmt->execute(
[
    ":student_id"=>$student_id
]

);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);





if($_SERVER['REQUEST_METHOD'] === 'POST')
{
#الاستلام البيانات من النموذج
$student_name = trim($_POST['student_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$age = trim($_POST['age'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$phone = trim($_POST['phone'] ?? '');


#التحقق من الاسم 
if(empty($student_name))
{
    $errors['student_name'] = 'اسم الطالب مطلوب.';
}

#التحقق من البريد الإلكتروني
if(empty($email))
{
    $errors['email'] = 'البريد الإلكتروني مطلوب.';
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = 'البريد الإلكتروني غير صالح.';
}

#التحقق من العمر
if(empty($age))
{
    $errors['age'] = 'العمر مطلوب.';
}

#التحقق من الجنس
if(empty($gender))
    {
        $errors['gender'] = 'الجنس مطلوب.';
    }

#التحقق من رقم الهاتف
if(empty($phone))
        {
            $errors['phone'] = 'رقم الهاتف مطلوب';
        }
elseif(strlen($phone) > 10)
{
    $errors['phone'] = 'رقم الهاتف يجب أن يكون على الأقل 10 أرقام.';
}

if(empty($errors))
    {
   
#إذا لم يكن هناك أخطاء، قم بإدخال البيانات في قاعدة البيانات
   


$sql = "UPDATE students
   SET 
   name = :name,
   email = :email,
   age = :age,
   gender = :gender,
   phone = :phone
   WHERE id=:student_id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $student_name,
                ':email' => $email,
                ':age'=> $age,
                ':gender' => $gender,
                ':phone' => $phone,
                ':student_id' =>$student_id
            ]);
    

        header('Location: show_students.php');
        exit;
}
}




?>








<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إضافة طالب</title>

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

                <a href="index.php">
                    الرئيسية
                </a>

                <a href="show_students.php" class="active">
                    الطلاب
                </a>

                <a href="show_courses.php">
                    الكورسات
                </a>

            </nav>

        </div>

    </header>


    <!-- المحتوى الرئيسي -->

    <main class="main-content">

        <div class="container">

            <!-- عنوان الصفحة -->

            <div class="page-header">

                <h1>
                    تعديل بيانات طالب 
                </h1>

                <p>
                    قم بتعديل بيانات الطالب لإضافته إلى النظام
                </p>

            </div>


            <!-- نموذج تعديل الطالب -->

            <div class="form-card">

                <form action="" method="POST">


                    <!-- اسم الطالب -->

                    <div class="form-group">

                        <label for="student_name">
                            اسم الطالب
                        </label>

                        <input
                            type="text"
                            id="student_name"
                            name="student_name"
                            placeholder="أدخل اسم الطالب"
                            required
                            value="<?php echo htmlspecialchars($result[0]["name"]);?>"
                        >

                    </div>
<?php if(isset($errors['student_name'])): ?>
<div class="error-message"> 
    <?php echo $errors['student_name']; ?>
</div>
<?php endif; ?>


                    <!-- البريد الإلكتروني -->

                    <div class="form-group">

                        <label for="email">
                            البريد الإلكتروني
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="مثال: student@example.com"
                            required
                            value="<?php echo htmlspecialchars($result[0]["email"]); ?> "
                        >

                    </div>

<?php if(isset($errors['email'])): ?>
<div class="error-message"> 
    <? echo $errors['email']; ?>
</div>
<?php endif; ?>

                    <!-- العمر -->

                    <div class="form-group">

                        <label for="age">
                            العمر
                        </label>

                        <input
                            type="number"
                            id="age"
                            name="age"
                            placeholder="أدخل عمر الطالب"
                            min="1"
                            required
                            value="<?php echo htmlspecialchars($result[0]["age"]); ?>"
                        >

                    </div>

<?php if(isset($errors['age'])): ?>
<div class="error-message"> 
    <? echo $errors['age']; ?>
</div>
<?php endif; ?>

                    <!-- الجنس -->

                    <div class="form-group">

                        <label for="gender">
                            الجنس
                        </label>

                        <select
                            id="gender"
                            name="gender"
                            required
                        >

                            <option value="">
                                اختر الجنس
                            </option>

                            <option value="male" <?= ($result[0]["gender"]=="male") ? 'selected':'' ?>>
                                ذكر
                            </option>

                            <option value="female"  <?= ($result[0]["gender"]=="female") ? 'selected':'' ?>>
                                أنثى
                            </option>

                        </select>

                    </div>

<?php if(isset($errors['gender'])): ?>
<div class="error-message"> 
    <? echo $errors['gender']; ?>
</div>
<?php endif; ?>

                    <!-- رقم الجوال -->

                    <div class="form-group">

                        <label for="phone">
                            رقم الجوال
                        </label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="أدخل رقم الجوال"
                            required
                            value="<?php echo htmlspecialchars($result[0]["phone"]);?>"
                        >

                    </div>

<?php if(isset($errors['phone'])): ?>
<div class="error-message"> 
    <? echo $errors['phone']; ?>
</div>
<?php endif; ?>




                    <!-- الأزرار -->

                    <div class="form-actions">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            تعديل الطالب
                        </button>

                        <a
                            href="index.php"
                            class="btn btn-secondary"
                        >
                            إلغاء
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</body>

</html>