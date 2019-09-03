<?php
  if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require 'SoapModel.php';  
    $soapController = new SoapModel();
    
    $leaderboard = $soapController->getLeagueTable();
    $board = explode("\n", $leaderboard);
    
    $uniquePlayers = array();
    $scores = array();
    
    $wins = 0;
    $loss = 0;
    $draw = 0;

    foreach($board as $rank) {
        $individualGames = explode(",", $rank);
        $uniquePlayers[] = $individualGames[1];
        $uniquePlayers[] = $individualGames[2];
   }
    
    $uniquePlayers = array_unique($uniquePlayers);
//    foreach($uniquePlayers as $names){
//        echo $names."<br>";
//    }
    
    foreach($board as $individualScore) {
//        echo "Player 1:".$individualScore."<br>";
        $score = explode(",", $individualScore);
//        echo $score[1]."<br>";
        
        foreach($uniquePlayers as $player){
            $wins = 0;
            $loss = 0;
            $draw = 0;
            if($score[1] == $player){
                if($soapController->getGameState($score[0]) == 1) {
                    $wins++;
                }
                else if($soapController->getGameState($score[0]) == 3) {
                    $draw++;
                }
                else {
                    $loss++;
                }
                $scores[] = array($player,$wins,$draw,$loss);
            }
            else if($score[2] == $player){
                if($soapController->getGameState($score[0]) == 1) {
                    $wins++;
                }
                else if($soapController->getGameState($score[0]) == 3) {
                    $draws++;
                }
                else {
                    $loss++;
                }
                $scores[] = array($player,$wins,$draw,$loss);
            }
        }
    }

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Leader Board</title>
        <link rel="stylesheet" href="./Assets/Style.css"/>
    </head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script>    
         
     </script>
     <body>
         <div class="header2"><img src="./Assets/Leader Board.png"/></div>
         <?php for($i = 0; $i < count($scores); $i++) { ?>
         <Strong> Player: </strong><?php  echo $scores[$i][0] ?> 
         <Strong> Wins: </strong><?php  echo $scores[$i][1] ?> 
         <Strong> Draws: </strong><?php  echo $scores[$i][2] ?>
         <Strong> Losses: </strong><?php  echo $scores[$i][3] ?> 
         <?php echo "<br>";
         } ?>
    </body>
    
</html>
