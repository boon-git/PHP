<?php
    session_start();
    require_once("database.php");

    if (isset($_POST["btn_submit"])) {
		
		$username = $_POST["username"];
		$password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $query = $db->prepare($sql);
        $query->execute(
            array(
                ':username'=> $username,
                ':password'=> $password
            )
        );
        $cout = $query->rowCount();
        if($cout>0){
            $_SESSION['username']= $username;
            header("location:after_login.php");
        }else{
            echo"Please check your username and password!";
        }
    }
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div style="width:600px; margin:auto;">
        <h3 style=" text-align:center">LOG IN</h3>
        <form action="login.php" method="post" >
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Username:</label>
                <input type="text" class="form-control" id="email" placeholder="ex: jdoe123" name="username">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="ex: 123abc" name="password">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>