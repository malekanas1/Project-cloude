<?php

require_once("config.php");

$sql = "SELECT course_id, course_name, description, price
        FROM courses
        ORDER BY course_id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
echo "<br>". $courses[1]["course_id"]
."<br>".
$courses[1]["course_name"]
."<br>".
$courses[1]["description"]
."<br>".
$courses[1]["price"]
."<br>";
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php 
/*echo "<br>";*/ ?>
<!--
    <tabl >
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>

<tbody>

<?php
/*
foreach ($courses as $course):  ?>
<tr>  
<?php echo "<br>"; 
*/?>


<td style="border: 1px solid black; padding: 8px;">
<?php /*
echo $course["course_id"]
*/?>
</td>


<td style="border: 1px solid black; padding: 8px;">
<?php /*
echo $course["course_name"]
*/?>
</td>


<td style="border: 1px solid black; padding: 8px;">
<?php /*
echo $course["description"]
*/
?>
</td>


<td style="border: 1px solid black; padding: 8px;">
<?php 
/*
echo $course["price"]
*/?>
</td>


<?php /*endforeach;*/ ?>

</tr>

</tbody>

    
    
</tabl>



</body>
</html>


 -->



 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

/* جدول الكورسات */

.courses-table {
    width: 100%;
    margin-top: 25px;
    background-color: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.courses-table table {
    width: 100%;
    border-collapse: collapse;
}

.courses-table th {
    background-color: #1e3a5f;
    color: #ffffff;
    padding: 16px 18px;
    text-align: right;
    font-size: 15px;
    font-weight: bold;
}

.courses-table td {
    padding: 15px 18px;
    text-align: right;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
    font-size: 14px;
    vertical-align: middle;
}

.courses-table tbody tr {
    transition: background-color 0.2s ease;
}

.courses-table tbody tr:hover {
    background-color: #f5f8fc;
}

.courses-table tbody tr:last-child td {
    border-bottom: none;
}


/* رقم الكورس */

.courses-table td:first-child {
    font-weight: bold;
    color: #1e3a5f;
}


/* اسم الكورس */

.courses-table td:nth-child(2) {
    font-weight: 600;
    color: #1f2937;
}


/* السعر */

.courses-table td:last-child {
    font-weight: bold;
    color: #2563eb;
    white-space: nowrap;
}
    </style>
 </head>
 <body>
    

 
<div class="courses-table">

    <table>

        <thead>
            <tr>
                <th>رقم الكورس</th>
                <th>اسم الكورس</th>
                <th>الوصف</th>
                <th>السعر</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($courses as $course): ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($course['course_id']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($course['description']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($course['price']); ?> دولار
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>
 </body>
 </html>
