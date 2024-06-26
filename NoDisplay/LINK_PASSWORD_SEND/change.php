<?php
$config = json_decode(file_get_contents("config.json"), true);
if (!empty($_POST['pass'])) {
    $members = $config['members'];
    $password = $_POST['pass'];
    $config['pass'] = $password;

    $title = "LINKのパスワードが変更されました";
    $content = "{name}さん！こんにちは！！！\nあなたがご登録しているLINKの会員パスワードが変更されたのでお知らせします。\n新しいパスワードは下記のとうりです\nPassword: $password";

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $errors = array();

    foreach ($members as $member) {
        $name = $member[0];
        $mail = $member[1];

        if (!mb_send_mail($mail, $title, str_replace("{name}", $name, $content))) {
            $errors = array_push($errors, [$name, $mail]);
        }
    }

    if (count($errors) > 0) {
        $send_content = "";
        foreach ($errors as $user) {
            $send_content .= "$user[0]: $user[1]\n";
        }
        echo $send_content;
    } else {
        echo "Done";
    }

    file_put_contents("config.json", json_encode($config, JSON_PRETTY_PRINT));
    echo "Password Changed";
} else {
    echo "No Password Changed";
}