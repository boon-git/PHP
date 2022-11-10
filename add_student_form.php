<?php
require('database.php');
$query = 'SELECT *
          FROM majors
          ORDER BY majorID';
$statement = $db->prepare($query);
$statement->execute();
$majors = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Students Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Students Mangement</h1></header>

    <main>
        <h1>Add student</h1>
        <form action="add_student.php" method="post"
              id="add_student_form">

            <label>Majors:</label>
            <select name="major_id">
            <?php foreach ($majors as $major) : ?>
                <option value="<?php echo $major['majorID']; ?>">
                    <?php echo $major['majorName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Student ID:</label>
            <input type="text" name="code"><br>

            <label>Full Name:</label>
            <input type="text" name="name"><br>

            <label>Year:</label>
            <input type="text" name="birthday"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add"><br>
        </form>
        <p><a href="index.php">Back to list</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> THAIVO.</p>
    </footer>
</body>
</html>