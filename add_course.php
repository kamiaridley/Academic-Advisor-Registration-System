<?php
include "project_database.php";

//Get form data from html file
$course_code = $_POST['course_code'];
$course_title = $_POST['course_title'];

$daysArray = $_POST['days'] ?? [];

//Validate all requirements are satisfied to add course
if (empty($daysArray)) {
    die("Error: Please select at least one day.");
}

$days = implode("", $daysArray);

$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

if (!$course_code || !$course_title || !$days || !$start_time || !$end_time) {
    die("Error: Please fill in all fields.");
}

//Execute and check for successful insertion
$sql = "INSERT INTO courses (course_code, course_title, days, start_time, end_time)
VALUES ('$course_code', '$course_title', '$days', '$start_time', '$end_time')";

if ($conn->query($sql)) {
    echo "Course added successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>

<br><br>
<a href="add_course.html">Add Another Course</a><br>
<a href="index.html">Main Menu</a>