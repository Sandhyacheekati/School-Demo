<?php
include 'db.php';

// To Fetch classes from dropdown
$query = "SELECT * FROM classes";
$classes_result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $query = "INSERT INTO student (name, email, address, class_id, image)
              VALUES ('$name', '$email', '$address', $class_id, '$image')";
    mysqli_query($conn, $query);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Create Student</h1>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address"></textarea><br>
        <label for="class_id">Class:</label>
        <select id="class_id" name="class_id">
            <?php while($class = mysqli_fetch_assoc($classes_result)): ?>
            <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/jpeg, image/png"><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
