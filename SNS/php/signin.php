<?php
$db = json_decode(file_get_contents("./database.json"));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
    if (($_POST['mail'] == "" && $_POST['pass'] == "" && $_POST['name'] == "" && $_POST['id'] == "")) {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $id = $_POST['id'];
        $icon = $_POST['icon'];

        if (!in_array($mail, $db['used-mails'])) {
            $token = bin2hex(random_bytes(32));
            $db['used-mails'] = array_push($db['used-mails'], $mail);
            $db['users_data'][$mail]['name'] = $name;
            $db['users_data'][$mail]['id'] = $id;
            $db['users_data'][$mail]['icon'] = $token;
            $db['users_data'][$mail]['pass'] = $pass;
            $db['users_data'][$mail]['my_post'] = [];

            $save_data = json_encode($db);
            $file = fopen("./database.json", "w");
            fwrite($file, $save_data);
            echo 'True';
        } else {
            echo 'False';
        }
    } else {
        echo "Used-email";
    }
}