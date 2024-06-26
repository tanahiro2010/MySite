<!DOCTYPE html>
<html lang="en">
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
    <h1 class="title">tanahiro2010</h1>
    <main>
        <div class="whoami">
            <h2>Who am I?</h2>
            <p>
                Q. What is your name?<br>
                A. tanahiro2010<br>
                Q. How ald are you?<br>
                A. I'm 14 years old. (2024 now)<br>
                Q. When is your birthday?<br>
                A. My birthday is 8/18<br>
                Q. What is your hobby?<br>
                A. My hobby is being programming<br>
                <h3>
                    Q. What is this site?<br>
                    A. This is showing I to created programs.
                </h3>

            </p>
        </div>
        <div class="links">
            <h2>Links</h2>
            <p>
                Please click "Here" word.<br>
                <?php
                $path = "./*";
                $folders = glob($path, GLOB_ONLYDIR);

                $html = "";
                foreach ($folders as $folder) {
                    $folder = str_replace("./", "", basename($folder));
                    if ($folder != "NoDisplay") {
                        $html .= "$folder: <a href='/$folder/'>Here</a><br>";
                    }
                }
                echo $html;
                ?>

            </p>
        </div>
    </main>
</body>
</html>