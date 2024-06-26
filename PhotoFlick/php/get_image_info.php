<?php
if (isset($_GET["id"])) {
    $images_info = json_decode(file_get_contents("./db/post_data.json"), true);

    $image_id = $_GET["id"];
    if (isset($images_info[$image_id])) {
        $image_info = $images_info[$image_id];
        $return = json_encode($image_info);
        echo $return;
    } else {
        echo "False";
    }
} else {
    echo "False";
}