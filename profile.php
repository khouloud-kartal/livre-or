<?php
session_start();
require('config.php');

$error = '';
$msg= false;
// Set variables to use in the following request.
if(isset($_POST['edit'])) {
$login = $_SESSION['login'];
$loginNew = $_POST['login'];

$prenom = $_SESSION['prenom'];
$prenomNew = $_POST['prenom'];

$nom = $_SESSION['nom'];
$nomNew = $_POST['nom'];

$passwordTrue = $_SESSION['password'];
$password = $_POST['currentpassword'];
$passwordNew = $_POST['newpassword'];
$passwordNewConfirm = $_POST['passwordconfirm'];



// Colect all datas from the user
$sql = "select * from utilisateurs where login = '$login'";
$rs = mysqli_query($db,$sql);
$numRows = mysqli_num_rows($rs);


if(password_verify($password,$passwordTrue)){
    
    if (!empty($passwordNew)){

        if(strlen($passwordNew) <= 5){    // If the password's lenght is less or equal to 5

            $error = "Short Password";

        }elseif (empty($passwordNewConfirm)){

            $error = "Confirm The New Password";

        }elseif(($passwordNew != $passwordNewConfirm)) {    // If the password is different than the password's confirmation

            $error = "Passwords do not match";

        }else{

            // Cripting the new password
            $hash = password_hash($passwordNew, PASSWORD_DEFAULT);

            $sqlPass = "update utilisateurs set password = '$hash' where login = '$login'";
            $rs = mysqli_query($db,$sqlPass);
            $_SESSION['password'] = $hash;
            $msg = true;
        }

    }
    
    if ($login != $loginNew){
        if($numRows != 1){

            $error = "Login already exists";

        }elseif(strlen($login) <= 5){    // If the login's lenght is less or equal to 5

            $error = "Login too short";

        }elseif(preg_match("[\W]", $loginNew)){    // If there is non-alphanumeric characters in the login

            $error = "Special caracteres are not allowed";

        }else{

            $sqlLog = "update utilisateurs set login = '$loginNew' where login = '$login'";
            $rs = mysqli_query($db,$sqlLog);
            $_SESSION['login'] = $loginNew;
            $msg = true;
        }

    }

}elseif (empty($password)){
    
    $error = "Enter the password to confirm the changes";

}else{

    $error = "Incorrect Password";

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
                <form action="profile.php" method="POST">
                    <h2>Edit</h2>
                    
                    <div class="group">
                        <label>Username</label>      
                        <input type="text" name="login" value="<?php {echo $_SESSION['login'];}?>"required><!--this php code is for when the passwords are not the same the login,nom et prenom wont be deleted from the input-->
                    </div>
                    
                    <div class="group">
                        <label>Current Password</label>     
                        <input type="password" name="currentpassword" required>
                        
                    </div>

                    <div class="group">
                        <label>New Password</label>     
                        <input type="password" name="newpassword" required>
                        
                    </div>

                    <div class="group">
                        <label>Confirm Password</label>      
                        <input type="password" name="passwordConfirm" required>
                        
                    </div>

                    <button type="submit" id="submit" class="draw" name="submit" value="Sign Up" class="form">Sign Up</button>
                    <h3><?php
                        if($error){
                            echo $error;
                        }
                        if($msg){
                            echo 'Your account had been changed succssefully.';
                        }
                    ?></h3>
                </form>
            </section>
        </main>
        <?php include 'footer.php'?>
    </body>
</html>