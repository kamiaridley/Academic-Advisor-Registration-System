<?php
include "project_database.php";

// Retrieve all students and courses from database
$students = $conn->query("SELECT * FROM students");
$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Student</title>
</head>

<body>

<h1>Enroll Student in Course</h1>

<!-- Enrollment form submits data to PHP file -->
<form action="enroll_process.php" method="POST">

    Student:<br>
    <select name="student_id" required>
        <option value="">-- Select Student --</option>
        <?php while($s = $students->fetch_assoc()): ?>
            <option value="<?php echo $s['student_id']; ?>">
                <?php echo $s['student_id'] . " - " . $s['name']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    Course:<br>
    <select name="course_id" required>
        <option value="">-- Select Course --</option>
        <?php while($c = $courses->fetch_assoc()): ?>
            <option value="<?php echo $c['course_id']; ?>">
                <?php echo $c['course_code'] . " - " . $c['course_title']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    <input type="submit" value="Enroll Student">

</form>

<br>
<a href="index.html">Main Menu</a>

</body>
</html>
