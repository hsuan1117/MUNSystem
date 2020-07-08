<?php namespace MUNCore\Account;
if (!defined("IN_SYSTEM")) die("Access Denied");

require __DIR__.'/../../../vendor/autoload.php';
use MUNCore\Database\MUNDatabase;
use PDO;
use PDOException;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class AccountManager {
    const LEVEL_ADMIN = 10;
    private MUNDatabase $dbm;
    public function login($account , $password) {
        if(!$this->accountExist($account)){
            return array(
                "status"=>false,
                "message"=>"查無帳號!"
            );
        }
        $db = $this->dbm->PDO_prepare("SELECT * FROM `table:Account` WHERE `account`=? OR `email`=?");

        $db->bindValue(1, $account, PDO::PARAM_STR);
        $db->bindValue(2, $account, PDO::PARAM_STR);
        $db->execute();
        $data = $db->fetchAll()[0];
        //print_r($data);
        if (!password_verify($password, $data["password"])) {
            return array(
                "status"=>false,
                "message"=>"密碼錯誤!"
            );
        }
        $_SESSION["UserID"] = $data["id"];
        return array(
            "status"=>true,
            "message"=>"登入成功!"
        );
    }

    public function register($account, $password, $email, $nickname) {
        if(empty($account)){
            return array(
                "status"=>false,
                "message"=>"帳號不可為空!"
            );
        }
        if(empty($password)){
            return array(
                "status"=>false,
                "message"=>"密碼不可為空!"
            );
        }
        if(empty($email)){
            return array(
                "status"=>false,
                "message"=>"電子郵件不可為空!"
            );
        }
        if(empty($nickname)){
            return array(
                "status"=>false,
                "message"=>"暱稱不可為空!"
            );
        }
        if($this->accountExist($account)){
            return array(
                "status"=>false,
                "message"=>"帳號已使用!"
            );
        }
        if($this->accountExist($email)){
            return array(
                "status"=>false,
                "message"=>"電子郵件已使用!"
            );
        }
        try{
            $db = $this->dbm->PDO_prepare("INSERT INTO `table:account` (`account`, `password`, `email`, `nickname`, `level`) VALUES (:account, :password, :email, :nickname, :level)");

            $db->bindValue(':account', $account, PDO::PARAM_STR);
            $db->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $db->bindValue(':email', $email, PDO::PARAM_STR);
            $db->bindValue(':nickname', $nickname, PDO::PARAM_STR);
            $db->bindValue(':level', ($this->isFirst() ? $this::LEVEL_ADMIN : 1) , PDO::PARAM_INT);
            $db->execute();

            $db = $this->dbm->PDO_prepare("SELECT `id` FROM `table:account` WHERE `account`=? or `email`=?");
            $db->bindValue(1, $account, PDO::PARAM_STR);
            $db->bindValue(2, $account, PDO::PARAM_STR);
            $db->execute();

            $_SESSION["UserID"] = $db->fetchAll()[0]["id"];

            return array(
                "status"=>true,
                "message"=>"註冊成功!",
                "data"=>array(
                    "id"=>$_SESSION["UserID"]
                )
            );
        }catch(PDOException $e){
            return array(
                "status"=>false,
                "message"=>$e->getMessage()
            );
        }

    }

    /**
     * @param $account
     * @return bool True: 存在 , False: 不存在
     */
    private function accountExist($account){
        $db = $this->dbm->PDO_prepare("SELECT 1 FROM `table:Account` WHERE `account`=? OR `email`=?");

        $db->bindValue(1, $account, PDO::PARAM_STR);
        $db->bindValue(2, $account, PDO::PARAM_STR);
        $db->execute();
        return $db->rowCount() > 0;
    }

    /**
     * @return bool True: 第一次註冊 , False: 非第一次
     */
    private function isFirst(){
        $db = $this->dbm->PDO_prepare("SELECT * FROM `table:Account` ");
        $db->execute();
        return $db->rowCount() === 0;
    }

    public function __construct() {
        $this->dbm = new MUNDatabase();
    }
}