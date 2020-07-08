<?php
define("IN_SYSTEM",true);
require __DIR__.'/vendor/autoload.php';
require_once "config.php";
use MUNCore\Account\AccountManager;
use MUNFeatures\Conference\Conference;
use MUNFeatures\Conference\Bulletin;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


$op = isset($_REQUEST['op']) ? filter_var($_REQUEST['op'], FILTER_SANITIZE_SPECIAL_CHARS) : "";

switch ($op) {
    case "make_bulletin":
        $title = isset($_REQUEST['title']) ? filter_var($_REQUEST['title'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $chairs = isset($_REQUEST['chairs']) ? filter_var_array($_REQUEST['chairs'], FILTER_SANITIZE_SPECIAL_CHARS) : array();
        $time = isset($_REQUEST['time']) ? filter_var($_REQUEST['time'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $Conference = new Conference($title,$chairs,$time);
        echo json_encode($Conference->make_conference(),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
    case "make_conference":
        $title = isset($_REQUEST['title']) ? filter_var($_REQUEST['title'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $chairs = isset($_REQUEST['chairs']) ? filter_var_array($_REQUEST['chairs'], FILTER_SANITIZE_SPECIAL_CHARS) : array();
        $time = isset($_REQUEST['time']) ? filter_var($_REQUEST['time'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $Conference = new Conference($title,$chairs,$time);
        echo json_encode($Conference->make_conference(),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
    case "register":
        $ACM = new AccountManager();

        $account = isset($_REQUEST['account']) ? filter_var($_REQUEST['account'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $password = isset($_REQUEST['password']) ? filter_var($_REQUEST['password'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $email = isset($_REQUEST['email']) ? filter_var($_REQUEST['email'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $nickname = isset($_REQUEST['nickname']) ? filter_var($_REQUEST['nickname'], FILTER_SANITIZE_SPECIAL_CHARS) : "";

        echo json_encode($ACM->register($account,$password,$email,$nickname),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
    case "login":
        $ACM = new AccountManager();

        $account = isset($_REQUEST['account']) ? filter_var($_REQUEST['account'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
        $password = isset($_REQUEST['password']) ? filter_var($_REQUEST['password'], FILTER_SANITIZE_SPECIAL_CHARS) : "";

        echo json_encode($ACM->login($account,$password),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
    default:
        //預設: 顯示第1號公佈欄
        $Bulletin = new Bulletin();
        echo json_encode($Bulletin->list_bulletin(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
}

