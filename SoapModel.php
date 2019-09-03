<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
class SoapModel {
    private $instance;
    
    public function SoapModel() {
        $wsdl = "http://localhost:8080/WebApplication1/TTTWebService?WSDL";
        $trace = true;
        $exceptions = true;

        try {
            $this->instance = new SoapClient($wsdl, array('trace' => $trace, 'exceptions' => $exceptions));
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function registerUser($uname, $pass, $fname, $sname) {
        $form = $this->instance->register(array( 
            'username' => $uname,
            'password' => $pass,
            'name' => $fname,
            'surname' => $sname));
        $_SESSION['uid'] = $form->return;
        return $form->return;
    }
    
    public function loginUser($uname, $pass) {
        $form = $this->instance->login(array(
            'username' => $uname,
            'password' => $pass));
        $_SESSION['uid'] = $form->return;
        return $form->return;
    }
    
    public function createNewGame($userID) {
        $form = $this->instance->newGame(array('uid' => $userID));
        return $form->return;
    }
    
    public function joinGame($userID, $gameID) {
        $form = $this->instance->joinGame(array(
            'uid' => $userID,
            'gid' => $gameID));
        return $form->return;
    }
    
    public function getBoard($gameID) {
        $form = $this->instance->getBoard(array('gid' => $gameID));
        return $form->return;
    }
    
    public function getGameState($gameID) {
        $form = $this->instance->getGameState(array(
            'gid' => $gameID));
        
        return $form->return;
    }
    
    public function setGameState($gameID,$gState) {
         $form = $this->instance->setGameState(array(
            'gid' => $gameID,
            'gstate' => $gState));
        
        return $form->return;
    }
    
public function checkSquare($x, $y, $gameID) {
         $form = $this->instance->checkSquare(array(
            'x' => $x,
            'y' => $y,
            'gid' => $gameID));
        
        return $form->return;
    }
    
    public function takeSquare($x, $y, $gameID, $pID) {
        $form = $this->instance->takeSquare(array(
            'x' => $x,
            'y' => $y,
            'gid' => $gameID,
            'pid' => $pID));
        return $form->return;
    }
    
    public function checkWin($gameID) {
        $form = $this->instance->checkWin(array(
            'gid' => $gameID));
        return $form->return;
    }
    
    public function deleteGame($gameId, $userID) {
        $form = $this->instance->deleteGame(array(
            'uid' => $userID,
            'gid' => $gameId));
        return $form->return;
    }
    
    public function showMyOpenGames($userID) {
        $form = $this->instance->showMyOpenGames(array(
            'uid' => $userID));
        return $form->return;
    }
    
    public function showAllMyGames($userID) {
        $form = $this->instance->showAllMyGames(array(
            'uid' => $userID));
        return $form->return;
    }
    
    public function getLeagueTable() {
        return $form = $this->instance->leagueTable()->return;
    }
    
    public function showOpenGames() {
        return $form = $this->instance->showOpenGames()->return;
    }
    
}
