<?php
include 'db.php';

// To Fetch students with their class names
$query = "SELECT student.*, classes.name AS class_name FROM student
          LEFT JOIN classes ON student.class_id = classes.class_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Students</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Students List</h1>
    <a href="create.php">Add New Student</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Class</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            <td><?php echo htmlspecialchars($row['class_name']); ?></td>
            <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="50" /></td>
            <td>
                <a href="view.php?id=<?php echo $row['id']; ?>">View</a>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
