<?php
session_start();
// errors declaration 
$error= '';
 
if(isset($_POST['submit'])) {
      
    // Include file which makes the Database Connection.
    include 'config.php';   
    $comment = $_POST["comment"];
    
    if ($comment == null) { 
        $error='Write a comment';
        
    }else{
        //declare the variables of Posts
        
        $id = $_SESSION['id'];
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d H:i:s');
        //strip_tags supprime les balises HTML et PHP d'une chaîne (par sécurité)
        $comment2 = strip_tags(trim($comment));
        
		$comment3 = htmlspecialchars($comment2, ENT_QUOTES);
		//nl2br insère un retour à la ligne HTML à chaque nouvelle ligne du textarea
        $comment4 = nl2br($comment3);
		
        $sql = "INSERT INTO `commentaires` (`date`, `id_utilisateur`, `commentaire`) VALUES ('$date', '$id', '$comment4')";
        $result = mysqli_query($db, $sql);
        header('Location:goldenbook.php');
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
        <title>Comments</title>
    </head>
    <body>
        <?php include 'header.php'?>
        <main>
            <section class="comments">
                <form action="comments.php" method="POST">
                    <textarea name="comment" placeholder="Write a comment..."></textarea>
                    <button name="submit" class="b1">Comment</button>
                    <h3><?PHP if ($error){
                        echo $error;
                    }
                    ?></h3>
                </form>
            </section>
        </main>
        <?php include 'footer.php'?>
    </body>
</html>