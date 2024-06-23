<?php
include 'db.php';

$id = $_GET['id'];

// Fetch student details
$query = "SELECT * FROM student WHERE id = $id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete student record and image file
    $query = "DELETE FROM student WHERE id = $id";
    mysqli_query($conn, $query);
    if (file_exists('uploads/' . $student['image'])) {
        unlink('uploads/' . $student['image']);
    }
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Delete Student</h1>
    <p>Are you sure you want to delete <?php echo htmlspecialchars($student['name']); ?>?</p>
    <form action="delete.php?id=<?php echo $id; ?>" method="post">
        <button type="submit">Yes, Delete</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
