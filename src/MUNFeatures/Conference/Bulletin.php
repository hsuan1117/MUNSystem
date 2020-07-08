<?php namespace MUNFeatures\Conference;
if(!defined("IN_SYSTEM"))die("Access Denied");

require __DIR__.'/../../../vendor/autoload.php';
use MUNCore\Database\MUNDatabase;
use MUNCore\Account\User;
use PDO;

class Bulletin{
    private User $User;
    private MUNDatabase $dbm;
    public int $ConferenceID;
    /**
     * @return array
     */
    public function add_bulletin(){
        $accounts = $this->dbm->PDO_prepare("INSERT INTO `table:Conference` (`title`, `time`, `chairs`) VALUES (:title, :time, :chairs)");
        $accounts->execute();
        print_r($accounts->fetchALL(PDO::FETCH_ASSOC));
        return array();
    }

    /**
     * @return array
     */
    public function list_bulletin(){
        $accounts = $this->dbm->PDO_prepare("SELECT * from `table:Bulletin`");
        $accounts->execute();
        print_r($accounts->fetchALL(PDO::FETCH_ASSOC));
        return array();
    }

    public function __construct($conf_id = 1){
        $this->ConferenceID = $conf_id;
        $this->User = new User();
        $this->dbm  = new MUNDatabase();
    }
}