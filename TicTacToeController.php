<?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'SoapModel.php';

class TicTacToeController {
    
    private $soap;
    private $gID;
    private $uID;
    
    public function TicTacToeController($gID,$uID) {
        $this->soap = new SoapModel();
        $this->gID = $gID;
        $this->uID = $uID;
    }
    
    public function checkSquare($x,$y) {
        return $this->soap->checkSquare($x,$y,$this->gID);
    }
    
    public function takeSquare($x,$y) {
        return $this->soap->takeSquare($x,$y,$this->gID, $this->uID);
    }
    
    public function getBoard(){
        return $this->soap->getBoard($this->gID);
    }
    
    public function TTTController(){
        $this->soap = new SoapModel();
    }
    
    public function getGID(){
        return $this->gID;
    }
    
    public function checkWin() {
        $state = $this->soap->checkWin($this->gID);
         if($state == 1) {
                $tttController->setGameState($this->gID, $state);
                echo "1,";
                echo 'Player one has won';
            }
            else if($state == 2) {
                $tttController->setGameState($this->gID, $state);
                echo "2,";
                echo 'Player two has won';
            }
            else if($state == 3) {
                $tttController->setGameState($this->gID, $state);
                echo "3,";
                echo 'The game has ended in a draw';
            }

    }
}
    $tttController = new SoapModel();

    if(isset($_POST['clicked'])) {
            $gameID = $_SESSION['gameID'];
            $positions = $_REQUEST['name'];
            $xy = explode(",",$positions);
            $x = $xy[0];
            $y = $xy[1];
            $result = $tttController->checkSquare($x, $y, $gameID);
            if($result ==0) {
                $tttController->takeSquare($x, $y, $gameID, $_SESSION['uid']);
                echo '0,';
                echo 'next Players turn';
                echo 'TTTView.php';
            }
            else{
                echo 'Not your turn';
            }
            $gameResult = $tttController->checkWin($gameID);
            if($gameResult == 1) {
                $tttController->setGameState($gameID, $gameResult);
                echo "1,";
                echo 'Player one has won';
                echo ',MainPage.php';
            }
            else if($gameResult == 2) {
                $tttController->setGameState($gameID, $gameResult);
                echo "2,";
                echo 'Player two has won';
                echo ',MainPage.php';
            }
            else if($gameResult == 3) {
                $tttController->setGameState($gameID, $gameResult);
                echo "3,";
                echo 'The game has ended in a draw';
                echo ',MainPage.php';
            }
        }
