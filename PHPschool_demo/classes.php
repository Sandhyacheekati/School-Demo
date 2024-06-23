<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $query = "INSERT INTO classes (name) VALUES ('$name')";
    mysqli_query($conn, $query);
    header('Location: classes.php');
}

// To Fetch classes
$query = "SELECT * FROM classes";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Classes List</h1>
    <form action="classes.php" method="post">
        <label for="name">Class Name:</label>
        <input type="text" id="name" name="name" required><br>
        <button type="submit">Add Class</button>
    </form>
    <table border="1">
        <tr>
            <th>Class Name</th>
            <th>Actions</th>
        </tr>
        <?php while($class = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($class['name']); ?></td>
            <td>
                <a href="edit_class.php?id=<?php echo $class['class_id']; ?>">Edit</a>
                <a href="delete_class.php?id=<?php echo $class['class_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Back to Students List</a>
</body>
</html>
