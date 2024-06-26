<?php
if (isset($_POST["session_id"]) && isset($_POST['title']) && isset($_POST['text']) && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $user_token = $_POST["session_id"];
    $title = $_POST["title"];
    $text = $_POST["text"];
    $image = $_FILES['file'];
    $fileTmpPath = $image['tmp_name'];
    $image_title = bin2hex(random_bytes(16));
    $image_type = $image['type'];
    $arrowTypes = array('image/jpeg', 'image/gif', 'image/png');
    if (in_array($image_type, $arrowTypes)) {
        $fileNameCmps = explode(".", $image_title);
        $fileExtension = strtolower(end($fileNameCmps));
        $save_path = "./db/images/$image_title.";
        switch ($image_type) {
            case 'image/jpeg':
                $save_path .= "jpg";
                break;
            case 'image/gif':
                $save_path .= "gif";
                break;
            case 'image/png':
                $save_path .= "png";
                break;
        }


        if (move_uploaded_file($fileTmpPath, $save_path)) {
            $today = date("Y-m-d H:i:s");
            $images_content = json_decode(file_get_contents("./db/post_data.json"), true);

            $images_content[$image_title]['title'] = $title;
            $images_content[$image_title]['text'] = $text;
            $images_content[$image_title]['create_day'] = $today;
            $images_content[$image_title]['type'] = $image_type;

            $save_data = json_encode($images_content);
            file_put_contents("./db/post_data.json", $save_data);

            echo $image_title;
        } else {
            echo 'False';
        }
    } else {
        echo "File-is-not-an-image.";
    }
} else {
    echo 'Input False';
}