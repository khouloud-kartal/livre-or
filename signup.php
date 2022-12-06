<?php
// errors declaration 
$showAlert = false; 
$showError = false; 
$error= '';
 
// 
if(isset($_POST['submit'])) {
      
    // Include file which makes the Database Connection.
    include 'config.php';   
    
    //declare the variables of Posts
    $login = $_POST["login"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
            
    $sql = "Select * from utilisateurs where login='$login'";

    //check if the login is already present or not in the Database
    $result = mysqli_query($db, $sql);
    
    //The table rows numbers
    $num = mysqli_num_rows($result); 
    
    //if the login doesn't exist
    if($num <= 0) {
        //Configurate the input length and characters
        if (strlen($login)>=5 &&  strlen($password)>=5 && !preg_match("[\W]",$_POST['login'])){
                //if the repeated password is the same as the first one 
                if($password == $passwordConfirm) {
            
                    // Password Hashing is used here to crypt the password in the database
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    //insert the inputs in the database
                    $sql = "INSERT INTO `utilisateurs` ( `login`, `password`) VALUES ('$login','$hash')";
            
                    $result = mysqli_query($db, $sql);
                    //if all conditions are true
                    if ($result) {
                        $showAlert = true;
                        header('Location: login.php');
                        session_destroy();
                    }
                } 
                else { 
                    $showError = "Passwords do not match"; 
                }  
        }elseif (strlen($login)<5 || strlen($password)<5) {
            $error = "The password or The username are too short";
        }elseif(preg_match("[\W]",$_POST['login'])){
            $error = "The special characters are not allowed";
        }

    }else{
      $error="Username already exist"; 
   }  
}  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <?php include 'header.php'?>
        <main>
            <section class="formulaire">
                <form action="signup.php" method="POST">
                    <h2>Sign Up here</h2>
                    
                    <div class="group">
                        <label>Username</label>      
                        <input type="text" name="login" value="<?php if($showError){ echo $_POST['login'];}?>"required><!--this php code is for when the passwords are not the same the login,nom et prenom wont be deleted from the input-->
                        
                    </div>
                    
                    <div class="group">
                        <label>Password</label>     
                        <input type="password" name="password" required>
                        
                    </div>

                    <div class="group">
                        <label>Confirm Password</label>      
                        <input type="password" name="passwordConfirm" required>
                        
                    </div>

                    <button type="submit" id="submit" class="draw" name="submit" value="Sign Up" class="form">Sign Up</button>
                    <h3><?php
                        // display the errors
                        if($showAlert) {
                            echo '<strong>Success!</strong> Your account is now created and you can login.';
                        }
            
                        if($showError) {
                        echo '<strong>Error!</strong>'. $showError; 
                        }
                    ?></h3>
                </form>
            </section>
        </main>
        <?php include 'footer.php'?>
    </body>
</html>