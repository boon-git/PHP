<?php
// Get the product data
$major_id = filter_input(INPUT_POST, 'major_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$birthday = filter_input(INPUT_POST, 'birthday', FILTER_VALIDATE_FLOAT);

// Validate inputs
if ($major_id == null || $major_id == false ||
        $code == null || $name == null || $birthday == false) {
    $error = "Invalid user data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO students
                 (majorID, studentCode, studentName, birthDay)
              VALUES
                 (:major_id, :code, :name, :birthDay)';
    $statement = $db->prepare($query);
    $statement->bindValue(':major_id', $major_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':birthDay', $birthday);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>