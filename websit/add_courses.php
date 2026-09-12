<?php




/*
session_start();
require_once('config.php');









$success = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');

    if ($name === '')
    {
        $errors['name'] = "اسم الكورس مطلوب.";
    }
    elseif (mb_strlen($name, 'UTF-8') < 3 || mb_strlen($name, 'UTF-8') > 100)
    {
        $errors['name'] = "اسم الكورس يجب أن يكون بين 3 و100 حرف.";
    }

    if ($description === '')
    {
        $errors['description'] = "وصف الكورس مطلوب.";
    }
    elseif (mb_strlen($description, 'UTF-8') < 3 || mb_strlen($description, 'UTF-8') > 500)
    {
        $errors['description'] = "وصف الكورس يجب أن يكون بين 3 و500 حرف.";
    }

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

    if (empty($errors))
    {
        $sql = "INSERT INTO courses
                (course_name, description, price)
                VALUES (:name, :description, :price)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price
        ]);

        $success = "تمت إضافة الكورس بنجاح.";
    }
}
*/





session_start();

require_once('config.php');

$errors = [];

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


    // إذا كان هناك أخطاء
    if (!empty($errors))
    {
        $_SESSION['errors'] = $errors;

        $_SESSION['old'] = [
            'course_name' => $name,
            'description' => $description,
            'price' => $price
        ];

        header("Location: add_cour.php");
        exit;
    }


    // إذا لم توجد أخطاء
    $sql = "INSERT INTO courses
            (course_name, description, price)
            VALUES (:name, :description, :price)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':price' => $price
    ]);


    $_SESSION['success'] = "تمت إضافة الكورس بنجاح.";

    header("Location: show_courses.php");
      #  echo "<script>alert('تمت إضافة الكورس بنجاح.');</script>";

    exit;
    
}
?>