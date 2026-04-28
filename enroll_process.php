<?php
include "project_database.php";

//Get form data from HTML file
$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];

//Validate student and course is selected.
if ($student_id == "" || $course_id == "") {
    die("Error: Please select both student and course.");
}

//Get and store courses from courses table
$newCourse = $conn->query("SELECT * FROM courses WHERE course_id='$course_id'");
$new = $newCourse->fetch_assoc();

$new_days = $new['days'];
$new_start = $new['start_time'];
$new_end = $new['end_time'];

//Retrieve students current enrolled classes
$existing = $conn->query("
    SELECT c.*
    FROM enrollments e
    JOIN courses c ON e.course_id = c.course_id
    WHERE e.student_id = '$student_id'
");

//Check time conficts with existing courses
while ($row = $existing->fetch_assoc()) {
    $shared_days = false;
    for ($i = 0; $i < strlen($row['days']); $i++) {
        if (strpos($new_days, $row['days'][$i]) !== false) {
            $shared_days = true;
            break;
        }
    }

    if ($shared_days) {
        if ($new_start < $row['end_time'] && $new_end > $row['start_time']) {
            echo "Error: Student already has a course during this time.";
            echo "<br><a href='enroll.php'>Back to Enrollment</a>";
            exit();
        }
    }
}

//Retrieve prerequisite course for selected course
$prereq = $conn->query("
    SELECT prereq_course_id 
    FROM prerequisites 
    WHERE course_id = '$course_id'
");

//Check if student has completed prerequisites
while ($row = $prereq->fetch_assoc()) {
    $prereq_id = $row['prereq_course_id'];

    $check = $conn->query("
        SELECT * 
        FROM enrollments 
        WHERE student_id = '$student_id'
        AND course_id = '$prereq_id'
    ");

    if ($check->num_rows == 0) {
       echo "Error: Student has not completed a required prerequisite course.";
       echo "<br><a href='enroll.php'>Back to Enrollment</a>";
       exit();
    }
}

//Insert enrollment into database
$sql = "INSERT INTO enrollments (student_id, course_id, status)
        VALUES ('$student_id', '$course_id', 'enrolled')";

//Execute enrollment query
if ($conn->query($sql) === TRUE) {
    echo "Enrollment successful!";
} else {
    echo "Error: " . $conn->error;
}
?>

<br><br>
<a href="enroll.php">Enroll Another Student</a><br>
<a href="index.html">Main Menu</a>