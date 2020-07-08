<?php namespace MUNCore\Account;
if (!defined("IN_SYSTEM")) die("Access Denied");

require __DIR__.'/../../../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class User {
    const LEVEL_ADMIN = 10;

    public string $ID;
    public int $level;

    /**
     * @param int $checkLevel
     * @return bool
     */
    public function checkPermission(int $checkLevel){
        return $this->level >= $checkLevel;
    }

    public function __construct() {
        if(!empty($_SESSION["UserID"])){
            $this->ID = $_SESSION["UserID"];
        };

    }
}