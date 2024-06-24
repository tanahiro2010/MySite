<?php

function generateToken($length = 32) {
    // バイナリデータを生成
    $token = bin2hex(openssl_random_pseudo_bytes($length / 2));
    return $token;
}

$zip = new ZipArchive;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    // アップロードされたファイルの情報を取得
    $fileTmpPath = $_FILES['file']['tmp_name'];
    echo $fileTmpPath;
    $fileName = "main";
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // サーバー上で保存するファイルのパス
    $uploadFileDir = './zip/';
    $dest_path = $uploadFileDir . "main";

    // ディレクトリが存在しない場合は作成
    if (!is_dir($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }
    
    // ファイルをサーバーに移動
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
        $Token = generateToken();
        if ($zip->open($dest_path)) {
            //mkdir("./pages/$Token");
            $zip->extractTo("./pages/$Token");
            $zip->close();
            $names = scandir("./pages/$Token/");
            foreach ($name as $names) {
                echo $name;
            }
            //header("Location: ./pages/$Token/$name");
            echo "<h1>Link <a href='./pages/$Token/main'>Move</a></h1>";
        } else {
            echo "No<br>";
        }
        // アップロードされたファイルの内容を読み取る
        $fileContent = file_get_contents($dest_path);
        echo "ファイル内容:<br>";
        echo nl2br(htmlspecialchars($fileContent));
    } else {
        echo "ファイルのアップロードに失敗しました。<br>";
    }
} else {
    echo "ファイルのアップロード中にエラーが発生しました。<br>";
}




?>