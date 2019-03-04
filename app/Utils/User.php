<?php
namespace Quizzoclock\Utils;
use Quizzoclock\Models\UserModel;

abstract class User {

    public static function isConnected(){
        if(empty($_SESSION['connectedUser'])){
            $connected = false;
        } else {
            $connected = true;
        }
        return $connected;
    }

    public static function getConnectedUser(){
        

        if(self::isConnected()){
            $userData = $_SESSION['connectedUser'];
        } else {
            $userData = [];
        }
        return $userData;
    }

    public static function connect(UserModel $userModel){
      
        $_SESSION['connectedUser'] = $userModel;
        return true;
    }

    public static function disconnect(){
        
        unset($_SESSION['connectedUser']);
        return true;
    }

}