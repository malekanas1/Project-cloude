






<?php
/*
require_once('config.php');

 $sql =$pdo->query( "SELECT * FORM  courses");
$cpurse=$sql->fetch();



*/
require_once('config.php');

$sql = "SELECT course_id, course_name, description, price
        FROM courses
        ORDER BY course_id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                <a href="show_students.php">الطلاب</a>
                <a href="show_courses.php" class="active">الكورسات</a>
            </nav>

        </div>

    </header>


    <!-- المحتوى -->

    <main class="main-content">

        <div class="container">

            <div class="page-header">

                <div>
                    <h1>الكورسات</h1>

                    <p>
                        جميع الكورسات المسجلة في النظام
                    </p>
                </div>

                <a href="add_cour.php" class="add-button">
                    + إضافة كورس
                </a>

            </div>


            <?php if (count($courses) > 0): ?>

                <div class="courses-table">

                    <table>

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>اسم الكورس</th>
                                <th>الوصف</th>
                                <th>السعر</th>
                                <th>الإجراءات</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($courses as $course): ?>

                                <tr>

                               
    <td><?= htmlspecialchars($course['course_id']) ?></td>
    <td><?= htmlspecialchars($course['course_name']) ?></td>
    <td><?= htmlspecialchars($course['description']) ?></td>
    <td><?= htmlspecialchars($course['price']) ?></td>
   
                                    
    <td>
      <a href="edit_course.php?course_id=<?= $course['course_id'] ?>" class="btn-edit">
    تعديل
</a>

       <form action="delete_course.php" method="POST" style="display:inline-block;">
    <input type="hidden" name="course_id" value="<?= $course['course_id'] ?>">

    <button type="submit" class="btn-delete">
        حذف
    </button>
</form>
    </td>
</tr>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="empty-message">

                    <h2>لا توجد كورسات</h2>

                    <p>
                        لم يتم إضافة أي كورسات إلى النظام حتى الآن.
                    </p>

                    <a href="add_cour.php" class="add-button">
                        إضافة أول كورس
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </main>

</body>

</html>