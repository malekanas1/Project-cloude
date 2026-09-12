<?php
$host='sql204.infinityfree.com';
$dbname= 'if0_42816131_stu_courses';
$usernam='if0_42816131';
$password= '7X5uF3SREC1SW';
$dsn="mysql:host=$host;dbname=$dbname;charset=utf8mb4";
/*
$options=[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

];
*/
try {
$pdo = new PDO($dsn, $usernam, $password/*,$options*/);
#print('نجح الاتصال ب قاعدة البيانات ');
}
catch (PDOException $e) {
    die('فشل الاتصال ب قاعدة البيانات '. $e->getMessage());

}    
 


?>
