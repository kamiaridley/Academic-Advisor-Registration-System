<?php 
include "project_database.php"; ?>

<h2>View Student Schedule</h2>

<style>
table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    background-color: white;
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
    background-color: white;
}

th {
    font-weight: bold;
}

h2 {
    text-align: center;
    font-family: Arial, sans-serif;
}

.back {
    text-align: center;
    margin-top: 20px;
}
</style>

<!-- Form to select a student and view their schedule -->
<form method="POST">
    Select Student:
    <select name="student_id">
        <?php
        $students = $conn->query("SELECT * FROM students");
        while ($row = $students->fetch_assoc()) {
            echo "<option value='" . $row['student_id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select>

    <br><br>
    <input type="submit" value="View Schedule">
</form>

<?php
// Process schedule request after student is selected
if (isset($_POST['student_id'])) {

    $student_id = $_POST['student_id'];
	$student = $conn->query("
    SELECT name, student_id, major
    FROM students
    WHERE student_id = '$student_id'
");

$student_row = $student->fetch_assoc();

 // Retrieve enrolled courses for selected student
    $result = $conn->query("
        SELECT s.name, c.course_id, c.course_code, c.course_title, c.days, c.start_time, c.end_time
        FROM enrollments e
        JOIN students s ON e.student_id = s.student_id
        JOIN courses c ON e.course_id = c.course_id
        WHERE s.student_id = '$student_id'
		ORDER BY 
        FIELD(c.days, 'M', 'T', 'W', 'R', 'F', 'MWF', 'TR'),
        c.start_time
    ");

// If no courses found, first case; otherwise second case, loop enrolled courses
  if ($result->num_rows == 0) {
    echo "<h3 style='text-align:center;'>Student is not enrolled in any classes. </h3>";
} else {
   echo "<h2>Schedule</h2>";
   echo "<h1 style='text-align:center;'>{$student_row['name']}</h1>";
   echo "<h3 style='text-align:center;'>Student ID: {$student_row['student_id']}</h3>";
   echo "<h3 style='text-align:center;'>Major: {$student_row['major']}</h3>";
   echo "<table border='.5' cellpadding='3'>";
    echo "<tr>
            <th>Course Code</th>
            <th>Title</th>
            <th>Days</th>
            <th>Start</th>
            <th>End</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
		
		$start = date("g:i A", strtotime($row['start_time']));
        $end   = date("g:i A", strtotime($row['end_time']));
		
        echo "<tr>
                <td>{$row['course_code']}</td>
                <td>{$row['course_title']}</td>
                <td>{$row['days']}</td>
                <td>{$start}</td>
                <td>{$end}</td>
				<td>
				    <a href='drop_course.php?student_id=$student_id&course_id={$row['course_id']}&course_code={$row['course_code']}'>
                            Drop
                        </a>
                    </td>
              </tr>";
    }

    echo "</table>";
}
}
?>

<div class="back">
    <a href="index.html">Main Menu</a>
</div>