<?php
include 'db.php';

$id = $_GET['id'];
$query = "SELECT student.*, classes.name AS class_name FROM student
          LEFT JOIN classes ON student.class_id = classes.class_id
          WHERE student.id = $id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>View Student</h1>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($student['address']); ?></p>
    <p><strong>Class:</strong> <?php echo htmlspecialchars($student['class_name']); ?></p>
    <p><strong>Image:</strong> <img src="uploads/<?php echo htmlspecialchars($student['image']); ?>" width="100" /></p>
    <p><strong>Created At:</strong> <?php echo htmlspecialchars($student['created_at']); ?></p>
    <a href="index.php">Back to List</a>
</body>
</html>
