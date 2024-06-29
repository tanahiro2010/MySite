<?php
$db = json_decode(file_get_contents('./database.json'), true);
if (isset($_POST['name']) && isset($_POST['text']) && isset($_POST['thread'])) {
    $thread_name = $_POST['thread'];
    $username = $_POST['name'];
    $text = $_POST['text'];

    if (array_key_exists($thread_name, $db)) {
        $push_message = array("name" => $username, "content" => $text);
        array_push($db[$thread_name]['messages'], $push_message);
        file_put_contents('./database.json', json_encode($db));
        header("Location: ./thread.php?name=$thread_name");
    } else {
        header('Location: ./');
    }
} else {
    echo "<h1>Error</h1>";
}