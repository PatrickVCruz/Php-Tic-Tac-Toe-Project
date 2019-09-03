<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'SoapModel.php';
    $soapController = new SoapModel();
    $stats = $soapController->showAllMyGames($_SESSION['uid']);
    $playerName = $_SESSION['username'];
    $individualGames = explode("\n", $stats);
    $wins = 0;
    $loss = 0;
    $draw = 0;
    foreach($individualGames as $game) {
        $eachGame = explode(",", $game);
        if($playerName == $eachGame[1]){
            if($soapController->getGameState($eachGame[0]) == 1) {
                $wins++;
            }
            else if($soapController->getGameState($eachGame[0]) == 3) {
                $draws++;
            }
            else {
                $loss++;
            }
        }
        else if($playerName ==$eachGame[2]){
            if($soapController->getGameState($eachGame[0]) == 1) {
                $wins++;
            }
            else if($soapController->getGameState($eachGame[0]) == 3) {
                $draws++;
            }
            else {
                $loss++;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="./Assets/Style.css"/>
    </head>
    <body>
        <div class="header2"><img src="./Assets/My Stats.png"/></div>
        <strong> Player: </strong>
        <?php
        echo $playerName;
        ?>
        <br>
        <strong> Wins: </strong>
        <?php
        echo $wins;
        ?>
        <br>
        <strong> Losses: </strong>
        <?php
        echo $loss;
        ?>
        <br>
        <strong> Draws: </strong>
        <?php
        echo $draw;
        ?>
        
    </body>
</html>
