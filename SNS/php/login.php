<?php
$db = json_decode(fopen("./database.json", "r"));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['pass'])) {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        if (in_array($mail, $db['used_mails'])){
            $user_id = $db['Secure-mail'][$mail];
            $password = $db['users_data']['pass'];

            if ($pass == $password) {
                $token = bin2hex(random_bytes(32));
                echo $token;

                $db["session"][$token] = $mail;
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