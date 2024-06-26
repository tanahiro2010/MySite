<?php
$db = json_decode(file_get_contents('./db/database.json'), true);

if (isset($_POST["session_id"])) {
    $user_token = $_POST["session_id"];
    $keys = $db['user_tokens'];
    if (in_array($user_token, $keys)) {
        $user_data = $db['users_data'][$user_token];
        $mail = array_keys($db['Secure-mail'], $user_token)[0];

        $user_data['pass'] = "None";
        $user_data['mail'] = $mail;

        echo json_encode($user_data);

        $file = fopen('./db/database.json', 'w');
        fwrite($file, json_encode($db));
    } else {
        echo "False";
    }
}

?>