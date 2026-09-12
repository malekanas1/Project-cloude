

<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('طلب غير صالح');
}

$student_id = $_POST['id'] ?? '';

if (empty($student_id)) {
    exit('معرف الطالب غير موجود');
}

$sql = "SELECT id, name
        FROM students
        WHERE id = :student_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':student_id' => $student_id
]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    exit('الطالب غير موجود');
}





$sql = "DELETE FROM course_student
        WHERE student_id = :student_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':student_id' => $student_id
]);


$delete='
DELETE FROM students 
where id = :student_id';

$stmt = $pdo->prepare($delete);
$stmt->execute(
    [
        ":student_id"=>$student_id
    ]
);
header('location: show_students.php');
exit;

?>