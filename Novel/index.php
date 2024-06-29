<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tanahiro2010</title>
    <style>
        * {
            margin-top: 1%;
        }
        .title {
            text-align: center;
        }

        body {
            background-color: antiquewhite;
        }
        main {
            text-align: center;
            font-size: large;
        }
        a {
            color: black;
            text-decoration: dashed;
        }
        h2 + p {
            margin-top: 0px;
        }
    </style>
</head>
<body>
<h1 class="title">tanahiro2010 - Novel downloader</h1>
<main>
    <form action="./" method="POST">
        <input name="ncode" placeholder="ncode"><br>
        <input type="submit" value="Download">
    </form>

    <?php
    require "./functions.php";
    require "./userAgents.php";

    if (isset($_POST['ncode'])) {
        $ncode = strtolower($_POST['ncode']);
        $filePath = "./novels/$ncode.txt";
        if (!is_file($filePath)) {
            $api_url = "https://api.syosetu.com/novelapi/api?ncode=$ncode&out=json";
            $userAgent = $userAgents[array_rand($userAgents)];
            $response_str = request($api_url, $userAgent);
            consolePrint($response_str);
            $info = json_decode($response_str, true)[1];
            $title = $info['title'];
            $all_no = $info['general_all_no'];
            $content = "";

            libxml_use_internal_errors(true); // libxmlの内部エラーハンドリングを有効にする

            for ($i = 1; $i < $all_no + 1; $i++) {
                $html = request("https://ncode.syosetu.com/$ncode/$i", $userAgent);
                $parser = new DOMDocument();
                $parser->loadHTML($html);
                $text = $parser->getElementById("novel_honbun");
                if ($text) {
                    $content .= $text->textContent;
                }
            }

            libxml_clear_errors(); // エラーをクリアする

            file_put_contents($filePath, $content);
        }
        echo "<h1 style='display: none'><a href='$filePath' download='$ncode.txt' id='download-link'>Download</a></h1>";
        echo "<script>document.getElementById('download-link').click();</script>";
    }
    ?>
</main>
</body>
</html>
