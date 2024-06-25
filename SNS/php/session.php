<?php
$db = json_decode(file_get_contents('./db/database.json'), true);

if (isset($_POST["session_id"])) {
    $session_id = $_POST["session_id"];
    $keys = array_keys($db["session"]);

    if (in_array($session_id, $keys)) {
        $user_token = $db["session"][$session_id];
        $user_data = $db['users_data'][$user_token];
        $user_data['pass'] = "None";
        echo json_encode($user_data);
        unset($db["session"][$session_id]);

        $file = fopen('./db/sessions.json', 'w');
        fwrite($file, json_encode($db));
    } else {
        echo "False";
    }
}

?>