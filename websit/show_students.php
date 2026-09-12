
<?php

require_once('config.php');

$sql = "SELECT *
        FROM students
        ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الكورسات</title>

    <link rel="stylesheet" href="show_cour.css">


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
                <a href="show_students.php" class="active">الطلاب</a>
                <a href="show_courses.php">الكورسات</a>
            </nav>

        </div>

    </header>


    <!-- المحتوى -->

    <main class="main-content">

        <div class="container">

            <div class="page-header">

                <div>
                    <h1>الطلاب</h1>

                    <p>
                        جميع الطلاب المسجلين في النظام
                    </p>
                </div>

                <a href="add_student.php" class="add-button">
                    + إضافة طالب
                </a>

            </div>


            <?php if (count($students) > 0): ?>

                <div class="courses-table">

                    <table>

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>اسم الطالب</th>
                                <th>البريد الإلكتروني</th>
                                <th>العمر</th>
                                <th>الجنس</th>
                                <th>رقم الهاتف</th>
                                <th>الإجراءات</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($students as $student): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($student['id']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($student['name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($student['email']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($student['age']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($student['gender']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($student['phone']); ?>
                                    </td>
<td>
        <a href="edit_student.php?id=<?= $student['id'] ?>" class="btn-edit" >
            تعديل
        </a>

       <form action="delete_student.php" method="POST" style="display:inline-block;">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">

    <button type="submit" class="btn-delete">
        حذف
    </button>
</form>
    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="empty-message">

                    <h2>لا يوجد طلاب</h2>

                    <p>
                        لم يتم إضافة أي طلاب إلى النظام حتى الآن.
                    </p>

                    <a href="add_student.php" class="add-button">
                        إضافة أول طالب
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </main>

</body>

</html>