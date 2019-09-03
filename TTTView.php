<!DOCTYPE html>
<?php if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require 'TicTacToeController.php';
    
    $ttt = new TicTacToeController($_SESSION['gameID'], $_SESSION['uid']);
    $movesDone = $ttt->getBoard();
    $usedButtons =  array();
    if($movesDone =="ERROR-NOMOVES") {
        $movesDone = "ERROR-NOMOVES";
    }
    else{        
        $playerMoves = explode("\n", $movesDone);
        foreach($playerMoves as $individualMoves){
            $moved = explode(",", $individualMoves);
            $usedButtons[] = $moved[1].",".$moved[2];
            
        }
    }
    
    $gameBoard = array("0,0", "0,1", "0,2",
                       "1,0", "1,1", "1,2", 
                       "2,0", "2,1", "2,2"
        );
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TicTacToe</title>
        <link rel="stylesheet" href="Assets/Style.css" />
        <style>
            body {
                font-family:Arial, Sans-Serif;
                background-color: #FFFFFF; 
                text-align: center;
                }
            #xo {
                padding: 40px 40px 40px;
                color: #fff;
                background-color: #0067ab;
                text-shadow: rgba(0,0,0,0.24) 0 1px 0;
                font-size: 10px;
                box-shadow: rgba(255,255,255,0.5) 0 2px 0 0 inset;
                border: 1px solid #0164a5;
                border-radius: 2px;
                margin-top: 10px;
                cursor:pointer;   
           }
           #xo:hover {
                background-color: #024978;
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>                
            function clicked(buttonName) {    
                $.ajax({
                           type:"post",
                           url:"TicTacToeController.php",
                           data: {
                               'clicked' : true ,
                               'name' : buttonName 
                           },
                   success: function(response) {
                        document.getElementsByName(buttonName)[0].innerHTML = "X";  
                        window.location.replace("TTTView.php");
                        console.log(response);
                    }
                });
            }
            
            var w;
            var i = 0;
            var gameBoard = <?php echo json_encode($gameBoard) ?>;
            var  movesDone;
            function startWorker() {
                var pID = <?php echo $_SESSION['uid']?>;
                movesDone = <?php 
                if($movesDone != "ERROR-NOMOVES"){
                    $movesDone = $ttt->getBoard();
                    echo json_encode($movesDone);
                }
                else { 
                    echo json_encode("ERROR-NOMOVES");
                }
                ?>;
                
                if(typeof(Worker) !== "undefined") {
                    if(typeof(w) == "undefined") {
                        w = new Worker("checkTurn.js");
                        w.postMessage(movesDone);
                    }
                    w.onmessage = function(event) {
                        setBoard();
                          if(event.data == pID) {
                              for(i = 0; i < gameBoard.length;i++) {
                                  document.getElementsByName(gameBoard[i])[0].disabled = true;
                              }
                          }
                          else {
                              for(i = 0; i < gameBoard.length;i++) {
                                  document.getElementsByName(gameBoard[i])[0].disabled = false;
                              }
                          }
                        movesDone = <?php 
                              echo json_encode($ttt->getBoard());
                          ?>;
                    };
                }
            }
            
            
            function setBoard(){
                <?php $movesDone = $ttt->getBoard(); ?>
                var usedButtons = <?php echo json_encode($usedButtons)?>;
                  for(i = 0; i < gameBoard.length;i++){
                      for(j = 0; j < usedButtons.length;j++) {
                      if(gameBoard[i] == usedButtons[j]){
                          if(i%2 == 0){
                              document.getElementsByName(gameBoard[i])[0].innerHTML = "X";  
                          }
                          else {
                              document.getElementsByName(gameBoard[i])[0].innerHTML = "O";  
                          }
                        }
                    }
                }
            }
            
        </script>
    </head>
    <h1>
        Game <?php echo $ttt->getGID() ?>
    </h1>
    <body onload="startWorker()">
    <!--<body onload="startWorker()">-->
        <!--<p>Turn: <output id="result"></output></p>-->
        
        <div>
        <button id="xo" name="0,0" onclick="clicked(this.name)"></button>
        <button id="xo" name="0,1" onclick="clicked(this.name)"></button>
        <button id="xo" name="0,2" onclick="clicked(this.name)"></button>
        <br>
        <button id="xo" name="1,0" onclick="clicked(this.name)"></button>
        <button id="xo" name="1,1" onclick="clicked(this.name)"></button>
        <button id="xo" name="1,2" onclick="clicked(this.name)"></button>
        <br>
        <button id="xo" name="2,0" onclick="clicked(this.name)"></button>
        <button id="xo" name="2,1" onclick="clicked(this.name)"></button>
        <button id="xo" name="2,2" onclick="clicked(this.name)"></button>
        </div>
        
        
        <?php 
            if($movesDone != "ERROR-NOMOVES"){
            $moves = explode("\n", $movesDone);
            foreach($moves as $done) {
                $playerMove = explode(",", $done);?>
        <p>
               Player: <?php echo $playerMove[0]?> Move: <?php echo $playerMove[1]?> , <?php echo $playerMove[2]?>
        </p>
            <?php }
            }
            ?>
        <br>
        <a href="MainPage.php" class = 'button'>Return to Main Page</a>
    </body>
</html>

