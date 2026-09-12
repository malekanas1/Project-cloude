

<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('طلب غير صالح');
}

$course_id = $_POST['course_id'] ?? '';

if (empty($course_id)) {
    exit('معرف الطالب غير موجود');
}

$sql = "SELECT course_id, course_name
        FROM courses
        WHERE course_id = :course_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':course_id'=>$course_id
]);

$course = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$course) {
    exit('الطالب غير موجود');
}





$sql = "DELETE FROM course_student
        WHERE course_id = :course_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':course_id' => $course_id
]);


$delete='
DELETE FROM courses 
where course_id = :course_id';

$stmt = $pdo->prepare($delete);
$stmt->execute(
    [
        ":course_id"=>$course_id
    ]
);
header('location: show_courses.php');
exit;

?>