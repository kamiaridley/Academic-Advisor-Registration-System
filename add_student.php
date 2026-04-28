<?php
include "project_database.php";

//Get form data from html file
$student_id = $_POST['student_id'];
$name = $_POST['name'];
$major = $_POST['major'];

//Validate student ID is 9 digits
if (!preg_match("/^[0-9]{9}$/", $student_id)) {
    die("Error: Student ID must be exactly 9 digits.");
}

//Insert new record into students table
$sql = "INSERT INTO students (student_id, name, major)
        VALUES ('$student_id', '$name', '$major')";

//Execute and check for successful insertion
if ($conn->query($sql) === TRUE) {
    echo "Student added successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>

<br><br>
<a href="add_student.html">
    <button type="button">Add Another Student</button>
</a>