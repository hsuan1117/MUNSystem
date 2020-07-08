<?php namespace MUNCore\Database;

use PDO;
use PDOException;

if (!defined("IN_SYSTEM")) die("Access Denied");

class MUNDatabase {
    public $db ;
    function PDO_prepare($statement) {
        global $MUNConfig;
        $dbconf = $MUNConfig["Database"];
        try {
            $this->db = new PDO("$dbconf[type]:host=$dbconf[host]; dbname=$dbconf[name]; charset=utf8", $dbconf["account"], $dbconf["password"]);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
        } catch (PDOException $e) {
            exit("Error establishing DB connection: <br>" . $e->getMessage());
        }
        $statement = str_replace("table:", $dbconf["table_pre"], $statement);
        $ret = $this->db->prepare($statement);
        try {
            return $ret;
        } catch (PDOException $e) {
            die("SQL ERROR: " . $e->getMessage());
        }
    }
}

