<?php


namespace App\Security;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {
    protected $roles = array("ROLE_USER");
    protected $id;
    protected $username;
    protected $password;
    protected $gold = 0;
    protected $warpoints = 0;
    protected $biscuits = 0;
    protected $players = array();
    protected $currentPlayerId;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }
    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getPlayers(){
        return $this->players;
    }

    public function getPlayer($id){
        if(isset($this->players[$id])){
            return $this->players[$id];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getCurrentPlayerId() {
        return $this->currentPlayerId;
    }

    /**
     * @param mixed $currentPlayerId
     */
    public function setCurrentPlayerId($currentPlayerId): void {
        $this->currentPlayerId = $currentPlayerId;
    }

    public function setPlayers($players){
        $this->players = $players;
    }

    public function getGold(){
        return $this->gold;
    }

    public function setGold($amount){
        $this->gold = $amount;
    }

    public function eraseCredentials() {
        return null;
    }

    public function getWarpoints(){
        return $this->warpoints;
    }

    public function setWarpoints($warpoints){
        $this->warpoints = $warpoints;
    }

    public static function createFromMetin2Data($data){
        if(!isset($data['login']) || !isset($data['password']))
            throw new \InvalidArgumentException("data should contain a login and password field");
        $user = new User();
        $user->setUsername($data['login']);
        $user->setId($data['id']);
        $user->setGold($data['gold']);
        $user->setWarpoints($data["warpoints"]);
        $user->setBiscuits($data["biscuits"]);
        $user->setPassword($data['password']);
        if(@$data["players"]){
            $user->setPlayers($data['players']);
        }

        return $user;
    }

    /**
     * @return int
     */
    public function getBiscuits() {
        return $this->biscuits;
    }

    /**
     * @param int $biscuits
     */
    public function setBiscuits($biscuits) {
        if($biscuits !== null)
            $this->biscuits = $biscuits;
    }


}