<?php
    require_once('database.php');

    // Get category ID
    if (!isset($major_id)) {
        $major_id = filter_input(INPUT_GET, 'major_id', 
                FILTER_VALIDATE_INT);
        if ($major_id == NULL || $major_id == FALSE) {
            $major_id = 1;
        }
    }
    // Get name for selected category
    $querymajor = 'SELECT * FROM majors
                    WHERE majorID = :major_id';
    $statement1 = $db->prepare($querymajor);
    $statement1->bindValue(':major_id', $major_id);
    $statement1->execute();
    $major = $statement1->fetch();
    $major_name = $major['majorName'];
    $statement1->closeCursor();

    // Get all categories
    $query = 'SELECT * FROM majors
                ORDER BY majorID';
    $statement = $db->prepare($query);
    $statement->execute();
    $majors = $statement->fetchAll();
    $statement->closeCursor();

    // Get products for selected category
    $queryStudents = 'SELECT * FROM students
    WHERE majorID = :major_id
    ORDER BY studentID';
    $statement3 = $db->prepare($queryStudents);
    $statement3->bindValue(':major_id', $major_id);
    $statement3->execute();
    $students = $statement3->fetchAll();
    $statement3->closeCursor();
?>

<!DOCTYPE html>
<html>
<!-- the head section -->
    <head>
        <title>Students Management</title>
        <link rel="stylesheet" type="text/css" href="main.css" />
    </head>

<!-- the body section -->
    <body>
        <header>
            <div>
                <h1 style = 'float: left;'>Students Mangement</h1>
                <p class = right><a href='login.php'>Login</a></p>
                <p class = right><a href='register.php'>Sign up</a></p>
            </div>
        </header>
        <main>
            <h1 style = 'text-align: center'>Students list</h1>

            <aside style = 'width: 200px'>
                <!-- display a list of categories -->
                <h2 style = 'text-align: center; color: purple'>Major</h2>
                <nav>
                <ul>
                    <?php foreach ($majors as $major) : ?>
                    <li><a href=".?major_id=<?php echo $major['majorID']; ?>">
                            <?php echo $major['majorName']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                </nav>          
            </aside>
            <section style = 'width: 560px; text-align: center'>
        <!-- display a table of products -->
            <h2 style = 'color: purple'><?php echo $major_name; ?></h2>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th class="right">Year of birth</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?php echo $student['studentCode']; ?></td>
                    <td><?php echo $student['studentName']; ?></td>
                    <td class="right"><?php echo $student['birthDay']; ?></td>
                    <td><form action="delete_student.php" method="post">
                        <input type="hidden" name="student_id"
                            value="<?php echo $student['studentID']; ?>">
                        <input type="hidden" name="major_id"
                            value="<?php echo $student['majorID']; ?>">
                        <input type="submit" value="Delete">
                    </form></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p><a href="add_student_form.php">Add more students</a></p>
            <!--<p><a href="category_list.php">List Categories</a></p>-->
        </section>
        </main>
        <footer>
        <p>&copy; <?php echo date("Y"); ?> THAIVO.</p>
        </footer>
    </body>
</html>