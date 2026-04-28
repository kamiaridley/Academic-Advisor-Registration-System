<?php
include "project_database.php";

// Get data from HTML form
$student_id = $_GET['student_id'];
$course_id = $_GET['course_id'];
$course_code = $_GET['course_code'];

//Confirmation check before dropping course enrollment
if (!isset($_GET['confirm'])) {

    echo "<div style='text-align:center; margin-top:50px;'>
            <h3>Are you sure you want to drop <b>$course_code</b>?</h3>

            <br>

            <a href='drop_course.php?student_id=$student_id&course_id=$course_id&course_code=$course_code&confirm=1'>
                Yes, Drop Course
            </a>

            <br><br>

            <a href='view_schedule.php?student_id=$student_id'>
                Cancel
            </a>
          </div>";

    exit();
}

//Delete course enrollment from database
$conn->query("
    DELETE FROM enrollments
    WHERE student_id = '$student_id'
    AND course_id = '$course_id'
");

header("Location: view_schedule.php?student_id=$student_id");
exit();
?>