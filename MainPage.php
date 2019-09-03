<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start(); 
    }
  else{
        header("location: LandingLogin.php");
  }
  
    require 'GameController.php';
    $controller = new GameController();
    $controller->showOpenGames();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>
        <link rel="stylesheet" href="./Assets/Style.css"/>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script>
              function logOutButton(){
                        $.ajax({
                           type:"post",
                           url:"GameController.php",
                           data: {
                               'logout' : true
                           },
                   success: function(response) {
                       window.location.replace(response);
                    }
                });
            }
              
                function createNewGameButton(){
                        $.ajax({
                           type:"post",
                           url:"GameController.php",
                           data: {
                               'createGame' : true
                           },
                   success: function(response) {
                       alert("Created new game");
                    }
                });
            }
            
            function getAllMyGames(){
                        $.ajax({
                           type:"post",
                           url:"GameController.php",
                           data: {
                               'allMyGames' : true
                           },
                   success: function(response) {
                       window.location.replace("GamePage.php");
                    }
                });
            }
            
            function getAllMyOpenGames(){
                        $.ajax({
                           type:"post",
                           url:"GameController.php",
                           data: {
                               'allMyOpenGames' : true
                           },
                   success: function(response) {
                       window.location.replace("GamePage.php");
                    }
                });
            }
            
            function getAllGames(){
                        $.ajax({
                           type:"post",
                           url:"GameController.php",
                           data: {
                               'showGames' : true
                           },
                   success: function(response) {
                       window.location.replace("GamePage.php");
                    }
                });
            }
         </script>
    </head>
    <body>
        <div class="header2"><img src="./Assets/Title.png"/></div>
        <section>
                <div>
                        <br>
                        <a class="button" href="Leaderboard.php">Leaderboard</a>
                        <a class="button" href="MyStats.php">My Stats</a>
                        <button class="button" onclick="getAllMyGames()">All My Games</button>
                        <button class="button" onclick="getAllGames()">Show Games</button>
                        <button class="button" onclick="getAllMyOpenGames()">Show My Open Games</button>
                        <button class="button" onclick="createNewGameButton()">Create Game</button>
                        <button onclick="logOutButton()" class="button">Log out</button>
                        <br>
                </div>
        </section>
    </body>
    
    


    
