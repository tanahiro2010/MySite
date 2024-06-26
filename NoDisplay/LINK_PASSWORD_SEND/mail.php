<?php
$config = json_decode(file_get_contents("config.json"), true);
if (!(empty($_POST["title"]) && empty($_POST["content"]))){
    $members = $config['members'];
    $title = $_POST["title"];
    $content = $_POST["content"];

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $errors = "";

    foreach ($members as $member){
        if (!mb_send_mail($member[1], $title, $content)) {
            $errors .= "$member[0]: $member[1]<br>\n";
        }
    }

    if ($errors == "") {
        echo "Done";
    } else {
        echo $errors;
    }

} else {
    echo "<h1>404 Not Found</h1>";
}