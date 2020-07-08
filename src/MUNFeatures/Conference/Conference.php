<?php namespace MUNFeatures\Conference;
if (!defined("IN_SYSTEM")) die("Access Denied");

require __DIR__ . '/../../../vendor/autoload.php';

use MUNCore\Database\MUNDatabase;
use MUNCore\Account\User;
use PDO;
use PDOException;

class Conference {
    protected $title;
    protected $time;
    protected $id;
    protected $chairs;
    protected $confTime;
    protected $participant;
    private MUNDatabase $dbm;

    public function make_bulletin() {
        $db = $this->dbm->PDO_prepare("select 1 from `table:" . $this->title . "_bulletin` LIMIT 1");
        $db->execute();
        if ($db->rowCount() == 0) {
            try {
                ob_start();
                global $MUNConfig;
                $ConferenceTitle = $this->title;
                require("asset/bulletin.sql");
                $sql = ob_get_contents();
                ob_end_clean();
                $db = $this->dbm->PDO_prepare($sql);
                $db->execute();

                return array(
                    "status" => true,
                    "message" => "公佈欄資料表建立成功!",
                    "data" => array()
                );
            } catch (PDOException $e) {
                return array(
                    "status" => false,
                    "message" => $e->getMessage()
                );
            }
        } else {
            return array(
                "status" => false,
                "message" => "會議公布欄已建立!"
            );
        }
    }

    public function make_conference() {
        $db = $this->dbm->PDO_prepare("select 1 from `table:Conference` WHERE `title`=:title");
        $db->bindValue(":title", $this->title);
        $db->execute();
        if ($db->rowCount() == 0) {
            try {
                $db = $this->dbm->PDO_prepare("INSERT INTO `table:Conference` (`title`, `time`, `chairs`) VALUES (:title, :time, :chairs)");
                $db->bindValue(":title", $this->title, PDO::PARAM_STR);
                $db->bindValue(":chairs", implode(",", $this->chairs), PDO::PARAM_STR);
                $db->bindValue(":time", date("Y/m/d H:i:s", strtotime($this->confTime)), PDO::PARAM_STR);

                $db->execute();

                //ID
                $db = $this->dbm->PDO_prepare("SELECT * FROM `table:Conference` WHERE `title`=? ");
                $db->bindValue(1, $this->title, PDO::PARAM_STR);
                $db->execute();
                $data = $db->fetchAll()[0]['id'];
                $_SESSION['ConferenceID'] = $data;

                return array(
                    'status' => true,
                    'message' => '公佈欄資料表建立成功!',
                    'data' => array(
                        'id' => $data
                    )
                );
            } catch (PDOException $e) {
                return array(
                    "status" => false,
                    "message" => $e->getMessage()
                );
            }
        } else {
            return array(
                "status" => false,
                "message" => "此會議已建立!"
            );
        }
    }

    public function __construct($title, $chairs, $time) {
        $this->dbm = new MUNDatabase();
        $this->title = $title;
        $this->chairs = $chairs;
        $this->confTime = $time;
    }
}