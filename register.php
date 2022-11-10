<?php
    require_once("database.php");

    if (isset($_POST["btn_submit"])) {
		
		$username = $_POST["username"];
		$password = $_POST["password"];
    $repassword = $_POST["repassword"];
    if($password != $repassword){
       echo"Please check your re-password";   
    }else if ($username == "" || $password == "") {
       echo "Please fill up all your information!";
    }else{
    
          $query = "INSERT INTO users(username,password) VALUES (:username, :password)";
          $statement = $db->prepare($query);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':password', $password);
          $statement->execute();
          $statement->closeCursor();
          header('location:login.php');
          }
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div style="margin: auto; width: 600px">
            <h3 style=" text-align:center">SIGN UP</h3>
            <form action="register.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="email" placeholder="ex: johndoe123" name="username">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="ex: 123abc" name="password">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Re-password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="ex: 123abc" name="repassword">
                </div>
                
                <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                
            </form>
        </div>
    </body>
</html>