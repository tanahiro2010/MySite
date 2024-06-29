<?php
require "./functions.php";
$db = json_decode(file_get_contents('./database.json'), true);
if (isset($_GET['error'])) {
    alert("そのthread nameは使われています.");
}
?>
<html>
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

        fieldset {
            -moz-border-radius: 5px; /* for Firefox */
            -webkit-border-radius: 5px; /* for Chrome */
            * {
                margin-top: 0px;
            }
        }

    </style>
</head>
<body>
<h1 class="title">tanahiro2010 - Free Talk Japan</h1>
<main>
    <div class="info">
        <p>
            「Free Talk Japan」へようこそ！！<br>
            この掲示板は荒らしや晒し、暴言以外基本的に何でもありの掲示板です。<br>
            今有名な配信者について話したり政治について話したり自由に楽しんでください。
        </p>
    </div>
    <!--<div style="display: flex">-->
        <!-- ここからスレッドコントローラー -->
        <div>
            <fieldset>
                <?php
                # { name => {}}
                $html = "";
                foreach ($db as $key => $value) {
                    $html .= "<a href='./thread.php?name=$key'><h1 title='Click here'>$key</h1></a><br>";
                }
                echo $html;
                ?>
            </fieldset>
            <fieldset>
                <h2>Create thread</h2>
                <form action="./create.php" method="post">
                    <input name="name" type="text" placeholder="thread name"><br>
                    <textarea name="info" placeholder="スレッドについての主な説明"></textarea><br>
                    <input type="submit" value="Submit">
                </form>
            </fieldset>
        </div>
    <!--</div>-->
</main>
</body>
</html>
