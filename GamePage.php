<?php if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require 'GameController.php';
    
    $state;
    $alertMsg;
    if($_SESSION['all'] == 0) {
        $state = "Remove";
        $alertMsg = 'Removing Game ';
    }
    else{
        $state = "Play";
        $alertMsg = 'Now Playing';
    }
    $openGames;
    
    $gControler = new GameController();
    if($_SESSION['myGames'] == 0) {
        $openGames = $gControler->showMyOpenGames();
    }
    else {
        $openGames = $_SESSION['myGames'];
    }   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game Page</title>
        <link rel="stylesheet" href="Assets/Style.css" />
        <style>
            a{
                color:#0067ab;
                position: center;
                text-decoration:none;
           }
           a:hover{
                text-decoration:underline;
           }
            
            .button {
                    padding: 10px 25px 8px;
                    color: #fff;
                    background-color: #0067ab;
                    text-shadow: rgba(0,0,0,0.24) 0 1px 0;
                    font-size: 16px;
                    box-shadow: rgba(255,255,255,0.5) 0 2px 0 0 inset;
                    border: 1px solid #0164a5;
                    border-radius: 2px;
                    margin-top: 10px;
                    cursor:pointer;   
            }         

            .button:hover {
                    background-color: #024978;
            }
        </style>
    </head>
    <h1>
        <?php    if($_SESSION['all'] == 0) { ?>
        <div class="header2"><img src="./Assets/Remove Games.png"/></div>
        <?php }
        else{ ?>
             <div class="header2"><img src="./Assets/Play Games.png"/></div>
        <?php
        }
    ?>
    </h1>
     <section id="one" class="main style1">
            <div class="container">
                <?php if ($openGames[0] != "ERROR-NOGAMES") { 
                    foreach ($openGames as $games) {   ?>
                    <form action="GameController.php" name="playGame" method="post">
                        <?php 
                            $gamesArray = explode(",",$games);
                            $gameID = $gamesArray[0];
                        ?>
                        <p><strong>Player 1: <?php echo $gamesArray[1] ?> Player 2: <?php echo $gamesArray[2] ?> Game ID: <?php echo $gamesArray[0] ?> </strong>
                        <input type ="hidden" name="gameID" value="<?php echo $gameID ?>"></input>
                        <input type="submit" onclick="alert('<?php echo $alertMsg?><?php echo $gameID ?>')" name="<?php echo $state ?>" value="<?php echo $state ?>"></input>    
                        </p>
                    </form>
                 <?php }
                 }
                 ?>
            </div>
        </section>
    <br>
    <a href="MainPage.php" class = 'button'>Return to Main Page</a>
</html>
<script>
</script>