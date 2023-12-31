<?php
require_once '../config.php';
require_once '../jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$bearer_token = get_bearer_token();

#echo $bearer_token;

$is_jwt_valid = is_jwt_valid($bearer_token);


if($is_jwt_valid) {
    $sql = "SELECT `name`,`call`,`position` FROM `users` LIMIT 1";
    $results = dbQuery($sql);

    $rows = array();

    while($row = dbFetchAssoc($results)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
} else {
    echo json_encode([
        "success"   => 0,
        "message"   => "Foydalanuvchiga ruxsat bekor qilingan"
    ]);
}