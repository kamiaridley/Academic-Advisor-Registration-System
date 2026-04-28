<?php
include "project_database.php";

// Retrieve all student records from the database
$result = $conn->query("
    SELECT *
    FROM students
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>

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

<h2>Students</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Student ID</th>
        <th>Major</th>
    </tr>

    <?php
	//Loop through all students and display each row
    while ($row = $result->fetch_assoc()) {
		
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['major']}</td>
              </tr>";
    }
    ?>

</table>

<div class="back">
    <a href="index.html">Main Menu</a>
</div>

</body>
</html>