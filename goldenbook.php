<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>GoldenBook</title>
    </head>

    <body>
        <?php include 'header.php' ?>
        <main class="goldenbook">
            <div class="commentbook">
                <h2>Comments</h2>
                <table>
                    <thead>
                        <tr>
                        <th>Posted</th>
                        <th>By</th>
                        <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'config.php';
                                                        
                            $sql = "SELECT * FROM utilisateurs  INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC";
                            $rs = mysqli_query($db,$sql);
                            $result = mysqli_fetch_assoc($rs);

                            
                            while ($result !=NULL){

                                $dateold=$result['date'];

                                $date = date('d-m-Y H:i:s', strtotime($dateold));
                                echo '<tr>';
                                echo '<td>'. $date .'</td>';
                                echo '<td>'. '<i class="fa fa-circle-user fa-2xl"></i>' .$result['login'] .'</td>';
                                echo '<td>'. $result['commentaire'] .'</td>';

                                $result = mysqli_fetch_assoc($rs);
                    
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <?php include 'footer.php' ?>
    </body>
</html>


