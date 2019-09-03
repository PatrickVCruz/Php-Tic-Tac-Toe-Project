<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'SoapModel.php';

/**
 * Description of GameSettings
 *
 * @author Patrick
 *
 */
class GameController {
        
        private $soap ;
        
        public function GameController() {
            $this->soap = new SoapModel();
        }
        
        public function logOut() {
            session_destroy();
        }
        
        public function createGame() {
            $result = $this->soap->createNewGame($_SESSION['uid']);      
            $_SESSION['gameID'] = $result;
        }
        
        public function joinGame($gameID) {
            $this->soap->joinGame($_SESSION['uid'], $gameID);
            $_SESSION['gameID'] = $gameID;
        }
        
        public function showOpenGames() {
           $result = $this->soap->showOpenGames();
           $_SESSION['myGames'] = explode("\n", $result);
           $_SESSION['all'] = 1;
        }
        
        public function showAllMyGames() {
            $result = $this->soap->showAllMyGames($_SESSION['uid']);
            $_SESSION['myGames'] = explode("\n", $result);
            $_SESSION['all'] = 1;
        }
        
        public function showMyOpenGames() {
            $result = $this->soap->showMyOpenGames($_SESSION['uid']);
            $_SESSION['myGames'] = explode("\n", $result);
            $_SESSION['all'] = '0';
        }
        
        public function deleteGame($gameID){
            return $this->soap->deleteGame($gameID, $_SESSION['uid']);
        }

}

    $controller = new GameController();
    
    if(isset($_POST["createGame"])) {
        $controller->createGame();
    }
    
    
    if(isset($_POST["joinGame"])) {
        $gameID = $_POST['gameID'];
        $controller->joinGame($gameID);
    }
    
    if(isset($_POST["allMyGames"])) {
        $controller->showAllMyGames();
        header('Location:GamePage.php');
    }
    
    if(isset($_POST["allMyOpenGames"])) {
        $controller->showMyOpenGames();
        echo $_SESSION['all'];
    }
    
    if(isset($_POST["showGames"])) {
        $controller->showOpenGames();
        echo $_SESSION['all'];
    }
    
    if(isset($_POST['logout'])) {
        $controller->logOut();
        echo "LandingLogin.php";
    }
    
    if(isset($_POST['Play'])) {
        $gameID = $_REQUEST['gameID'];
        $_SESSION['gameID'] = $gameID;
        $controller->joinGame($gameID);
        header('Location: ./TTTView.php');
        echo $gameID;
    }
    
    if(isset($_POST['Remove'])) {
        $gameID = $_REQUEST['gameID'];
        $controller->deleteGame($gameID);
        $controller->showMyOpenGames();
        header('Location: ./GamePage.php');
    }
    
    
    
    

