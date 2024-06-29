<?php
$config = json_decode(file_get_contents('./config.json'), true);
$pass = $config['pass'];
$To = $_POST['mail'];
$name = $_POST['name'];

$title = "$name さん！LINKにご登録ありがとうございます！！";
$content = "$name さん！LINKにご登録ありがとうございます！！\nLinkの会員パスワードは下記のとうりです。\nPasswordがいきなり変更されることもありますゆえ、ご注意ください\nPassword: $pass\n\n\n※登録した覚えのない方は無視してください.また、他人にメールアドレスを利用されている可能性がありますので、ご注意ください。";

mb_language("Japanese");
mb_internal_encoding("UTF-8");

if (mb_send_mail($To, $title, $content, "")) {
    array_push($config['members'], [$name, $To]);
    echo "Done send.";
    $file = fopen("./config.json", "w");
    fwrite($file, json_encode($config));
} else {
    echo "Error send.";
}