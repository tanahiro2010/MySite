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
                echo $user_token;
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