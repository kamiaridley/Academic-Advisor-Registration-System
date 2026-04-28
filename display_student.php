<?php
include "project_database.php";

//Retrieve student records from the student table
$result = $conn->query("SELECT * FROM students");

//Loop through each student row and display student ID and name
while ($row = $result->fetch_assoc()) {
    echo $row['student_id'] . " - " . $row['name'] . "<br>";
}
?>

<br><br>
<a href="index.html">
    <button type="button">Main Menu</button>
</a>