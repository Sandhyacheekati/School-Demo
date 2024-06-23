<?php
include 'db.php';

$id = $_GET['id'];

//To Fetch student details
$query = "SELECT * FROM student WHERE id = $id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

// Fetch classes for dropdown
$query = "SELECT * FROM classes";
$classes_result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    $image = $student['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $query = "UPDATE student SET name='$name', email='$email', address='$address', class_id=$class_id, image='$image' WHERE id=$id";
    mysqli_query($conn, $query);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Edit Student</h1>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo htmlspecialchars($student['address']); ?></textarea><br>
        <label for="class_id">Class:</label>
        <select id="class_id" name="class_id">
            <?php while($class = mysqli_fetch_assoc($classes_result)): ?>
            <option value="<?php echo $class['class_id']; ?>" <?php echo $class['class_id'] == $student['class_id'] ? 'selected' : ''; ?>><?php echo $class['name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/jpeg, image/png"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>