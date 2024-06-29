<?php
$db = json_decode(file_get_contents("./database.json"), true);
if (isset($_GET['name'])) {
    $thread_name = $_GET['name'];
    if (!isset($db[$thread_name])) {
        header("location: ./");
    }
} else {
    header('Location: ./');
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo '<title>tanahiro2010 - ' . addslashes($thread_name) . '</title>';
    ?>
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
        .comments {
            height: 500px;
        }
        .comment-box {
            text-align: left;
        }
        .name {
            margin-top: auto;
        }
        .controller {
            text-align: center;
        }

        textarea {
            -moz-border-radius: 5px; /* for Firefox */
            -webkit-border-radius: 5px; /* for Chrome */
        }
    </style>
</head>
<body>
<?php
echo '<h1 class="title">Free-Talk-Japan' . addslashes($thread_name) . '</h1>';
?>
<main>
    <fieldset class="comments">
        <?php
        $comments = $db[$thread_name]["messages"];
        $html = "";
        $no = 1;
        foreach ($comments as $comment) {
            $name = $comment['name'];
            $content = htmlspecialchars($comment['content']);
            $html .= "
            <div class='comment-box'>
            $no. $name<br>
            $content
            </div>
            ";
            $no += 1;
        }
        echo $html;
        ?>
    </fieldset>
    <?php
    $form = "
    <form action='./post.php' method='post' class='controler'>
        <h2>コメント</h2>
        <input type='hidden' name='thread' value='$thread_name'>
        <input name='name' placeholder='name' class='name'><br>
        <textarea name='text' id='comment' cols='50' rows='5'></textarea>
        <input type='submit' class='send' value='投稿'>
    </form>";

    echo $form;
    ?>

</main>
</body>
</html>
