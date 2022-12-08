<?php
session_start();
include('config.php');
$error= '';
if(isset($_POST['submit'])){
	$login = $_POST['login'];
	$password = $_POST['password'];

	//set the request in avariable
	$sql = "select * from utilisateurs where login = '$login'";
	//check if the username exists in the database
	$rs = mysqli_query($db,$sql);
	$numRows = mysqli_num_rows($rs);
	//if the username exists in the database
	if($numRows  == 1){
		$row = mysqli_fetch_assoc($rs);
        $id = $row['id'];

		//check if it is the correct password and decript it 
		if(password_verify($password,$row['password'])){
            $_SESSION['id'] = $id;
			$_SESSION['login'] = $login;
			$_SESSION['password'] = $row['password'];
            header('Location: index.php');
		}else{
			$error= "Wrong Password";
		}
	}else{
		$error= "No User found";
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">*
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Login</title>
    </head>
    <body>
        <?php include 'header.php'?>
        <main>
            <section class="formulaire">
                <form action="login.php" method="POST">
                    <h2>Login here</h2>
                    
                    <div class="group">
                        <label>Username</label>      
                        <input type="text" name="login" value=""required><!--this php code is for when the passwords are not the same the login,nom et prenom wont be deleted from the input-->
                        
                    </div>
                    
                    <div class="group">
                        <label>Password</label>     
                        <input type="password" name="password" required>
                        
                    </div>

                    <button type="submit" id="submit" class="b1" name="submit" value="Sign Up">Login</button>
                    <h3><?php
                        if($error){
                            echo $error;
                        }
                    ?></h3>
                </form>
            </section>
        </main>
        <?php include 'footer.php'?>
    </body>
</html>