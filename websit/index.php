<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>نظام إدارة الطلاب والكورسات</title>

    <link rel="stylesheet" href="style.css">
</head>



>
    
    <!-- الشريط العلوي -->
    <header class="navbar">

        <div class="container navbar-content">

            <div class="logo">
                نظام إدارة الطلاب
            </div>


            <nav>
                <a href="index.php" class="active">الرئيسية</a>
                <a href="show_students.php">الطلاب</a>
                <a href="show_courses.php">الكورسات</a>
            </nav>

        </div>

    </header>


<body>

    <!-- المحتوى الرئيسي -->
    <main class="main-content">

        <div class="container">

            <section class="welcome">

                <h1>مرحباً بك في نظام إدارة الطلاب والكورسات</h1>

                <p>
                    يمكنك من خلال النظام إدارة بيانات الطلاب والكورسات
                    بسهولة من خلال الخيارات التالية.
                </p>

            </section>


            <!-- الخيارات -->
            <section class="dashboard">

                <!-- إضافة كورس -->
                <div class="card">

                    <div class="card-icon">
                        📚
                    </div>

                    <h2>إضافة كورس</h2>

                    <p>
                        إضافة كورس جديد إلى النظام
                        مع إدخال جميع بياناته.
                    </p>

                    <a href="add_cour.php" class="card-button">
                        إضافة كورس
                    </a>

                </div>



                     <!-- إضافة كورس -->
                <div class="card">

                    <div class="card-icon">
                        👨‍💻
                    </div>

                    <h2>إضافة طالب إلى كورس</h2>

                    <p>
                        إضافة طالب إلى كورس موجود
                        مع إدخال جميع بياناته.
                    </p>

                    <a href="course_student.php" class="card-button">
                        إضافة طالب إلى كورس
                    </a>

                </div>


                <!-- عرض الكورسات -->
                <div class="card">

                    <div class="card-icon">
                        📋
                    </div>

                    <h2>عرض الكورسات</h2>

                    <p>
                        عرض جميع الكورسات الموجودة
                        في النظام وإدارتها.
                    </p>

                    <a href="show_courses.php" class="card-button">
                        عرض الكورسات
                    </a>

                </div>


                <!-- إضافة طالب -->
                <div class="card">

                    <div class="card-icon">
                        👨‍🎓
                    </div>

                    <h2>إضافة طالب</h2>

                    <p>
                        تسجيل طالب جديد وإدخال
                        بياناته في النظام.
                    </p>

                    <a href="add_student.php" class="card-button">
                        إضافة طالب
                    </a>

                </div>


                <!-- عرض الطلاب -->
                <div class="card">

                    <div class="card-icon">
                        👥
                    </div>

                    <h2>عرض الطلاب</h2>

                    <p>
                        عرض جميع الطلاب المسجلين
                        في النظام وإدارة بياناتهم.
                    </p>

                    <a href="show_students.php" class="card-button">
                        عرض الطلاب
                    </a>

                </div>

            </section>

        </div>

    </main>


    <!-- التذييل -->
    <footer>

        <p>
            نظام إدارة الطلاب والكورسات © 2026
        </p>

    </footer>

</body>

</html>