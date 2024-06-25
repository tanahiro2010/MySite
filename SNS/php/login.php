<?php
$db = json_decode(file_get_contents("./db/database.json"), true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['pass'])) {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        if (in_array($mail, $db['used_mails'])){
            $user_token = $db['Secure-mail'][$mail];
            $password = $db['users_data'][$user_token]['pass'];

            if ($pass == $password) {
                $token = bin2hex(random_bytes(32));
                echo $token;

                $db["session"][$token] = $user_token;

                $save_data = json_encode($db);

                $file = fopen("./db/database.json", "w");
                fwrite($file, $save_data);
            } else {
                echo "False";
            }
        } else {
            echo "False";
        }

    } else {
        echo "False";
    }
}
?>