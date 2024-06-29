<?php
function request($url, $userAgent)
{
    // cURLセッションを初期化
    $ch = curl_init();

    // cURLオプションを設定
    curl_setopt($ch, CURLOPT_URL, $url); // リクエストするURLを設定
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // レスポンスを文字列で返すように設定
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); // ユーザーエージェントを設定

    // リクエストを実行し、レスポンスを取得
    $response = curl_exec($ch);

    // エラーが発生した場合はエラーメッセージを表示
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    // cURLセッションを終了
    curl_close($ch);

    return $response;
}

function consolePrint($text)
{
    echo '<script>console.log("' . addslashes($text) . '");</script>';
    return;
}

function isURL($target)
{
    $needWords = [
        "http://",
        "https://",
    ];

    $isInclude = false;
    foreach ($needWords as $word) {
        if (strpos($target, $word) !== false) {
            $isInclude = true;
            break;
        }
    }
    consolePrint($isInclude);
    return $isInclude;
}

function alert($text)
{
    echo '<script>alert("' . addslashes($text) . '");</script>';
}

function post($target, $postData){
    $ch = curl_init($target);

    // cURLオプションを設定
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列として返す
    curl_setopt($ch, CURLOPT_POST, true); // POSTリクエストを指定
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // POSTデータを設定

    // リクエストを実行し、レスポンスを取得
    $response = curl_exec($ch);

    // エラーチェック
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // cURLセッションを終了
    curl_close($ch);

    return $response;
}

function download($pPath, $pMimeType = null)
{
    //-- ファイルが読めない時はエラー(もっときちんと書いた方が良いが今回は割愛)
    if (!is_readable($pPath)) { die($pPath); }

    //-- Content-Typeとして送信するMIMEタイプ(第2引数を渡さない場合は自動判定) ※詳細は後述
    $mimeType = (isset($pMimeType)) ? $pMimeType
        : (new finfo(FILEINFO_MIME_TYPE))->file($pPath);

    //-- 適切なMIMEタイプが得られない時は、未知のファイルを示すapplication/octet-streamとする
    if (!preg_match('/\A\S+?\/\S+/', $mimeType)) {
        $mimeType = 'application/octet-stream';
    }

    //-- Content-Type
    header('Content-Type: ' . $mimeType);

    //-- ウェブブラウザが独自にMIMEタイプを判断する処理を抑止する
    header('X-Content-Type-Options: nosniff');

    //-- ダウンロードファイルのサイズ
    header('Content-Length: ' . filesize($pPath));

    //-- ダウンロード時のファイル名
    header('Content-Disposition: attachment; filename="' . basename($pPath) . '"');

    //-- keep-aliveを無効にする
    header('Connection: close');

    //-- readfile()の前に出力バッファリングを無効化する ※詳細は後述
    while (ob_get_level()) { ob_end_clean(); }

    //-- 出力
    readfile($pPath);

    //-- 最後に終了させるのを忘れない
    exit;
}

?>