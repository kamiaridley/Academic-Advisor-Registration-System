<?php
include "project_database.php";

// Retrieve course records from the database; order by day and time
$result = $conn->query("
    SELECT *
    FROM courses
    ORDER BY 
        FIELD(days, 'M', 'T', 'W', 'R', 'F', 'MWF', 'TR'),
        start_time
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>

<style>
table {
    width: 80%;
    margin: 20px auto;
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

</head>

<body>

<h2>Available Courses</h2>

<table>
    <tr>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Days</th>
        <th>Start Time</th>
        <th>End Time</th>
    </tr>

    <?php
	//Loop through all courses and display each row
    while ($row = $result->fetch_assoc()) {
		
		$start = date("g:i A", strtotime($row['start_time']));
        $end   = date("g:i A", strtotime($row['end_time']));
		
        echo "<tr>
                <td>{$row['course_code']}</td>
                <td>{$row['course_title']}</td>
                <td>{$row['days']}</td>
                <td>{$start}</td>
                <td>{$end}</td>
              </tr>";
    }
    ?>

</table>

<div class="back">
    <a href="index.html">Main Menu</a>
</div>

</body>
</html>