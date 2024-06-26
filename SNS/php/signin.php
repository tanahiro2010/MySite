<?php
$db = json_decode(file_get_contents("./db/database.json"), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!($_POST['mail'] == "" && $_POST['pass'] == "" && $_POST['name'] == "" && $_POST['id'] == "")) {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $id = $_POST['id'];

        if (!in_array($mail, $db['used_mails'])) {
            $token = bin2hex(random_bytes(32));
            $db['used-mails'] = array_push($db['used_mails'], $mail);
            $db['users_data'][$token]['name'] = $name;
            $db['users_data'][$token]['id'] = $id;
            $db['users_data'][$token]['pass'] = $pass;
            $db['users_data'][$token]['my_post'] = [];

            $db['Secure-mail'][$mail] = $token;
            array_push($db['user_tokens'], $token);

            $save_data = json_encode($db);
            $file = fopen("./db/database.json", "w");
            fwrite($file, $save_data);
            echo 'True';
        } else {
            echo 'False';
        }
    } else {
        echo "Used-email";
    }
}