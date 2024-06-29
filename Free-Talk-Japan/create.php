<?php
$db = json_decode(file_get_contents("./database.json"), true);
if (isset($_POST['name']) && isset($_POST['info'])) {
    $name = $_POST['name'];
    $info = $_POST['info'];
    $db[$name]['creat_day'] = date("Y-m-d");
    $db[$name]['messages'] = array();
    $push_message = array("name" => "Controller", "content" => "$name へようこそ！！\n$info");
    array_push($db[$name]['messages'], $push_message);
    file_put_contents("./database.json", json_encode($db, JSON_PRETTY_PRINT));
    header("Location: ./");
} else {
    header("Location: ./?error=name");
}