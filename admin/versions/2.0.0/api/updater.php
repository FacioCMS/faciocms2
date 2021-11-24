<?php
    session_start();
    if(!$_SESSION["logged"]) {
        header('Location: ../../../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FacioCMS Updater</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        #app {
            padding: 20px 100px;
            background: #1f2020;
            color: #fff;
            height: 100vh;
        }

        h2 {
            font-size: 50px;
        }

        .bottom {
            width: 100%;
            height: 100px;
            background: #151515;
            color: #fff;
            position: fixed;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }
    </style>
</head>
<body>
    <div id="app">
        <h2>Downloading started!</h2>

        <div id="response"></div>

        <div class="bottom">
            Downloading ... ()
        </div>
    </div>
    <script>
        const $ = _ => document.querySelector(_)
        const xhr = new XMLHttpRequest();
        let isDownloading = true
        xhr.open("GET", "update.php")
        xhr.send()
        xhr.addEventListener("readystatechange", () => {
            if(xhr.responseText == '') return 
            isDownloading = false
            $("#response").innerHTML = ""
            $(".bottom").innerHTML = "Task finished"
            $("#response").innerHTML += xhr.responseText
        })

        const mult = (a, b) => {
            let str = ''
            for(let i = 0; i < a; i++) str+=b
            return str
        }

        let time = 0

        timeInterval()
        setInterval(() => {
            timeInterval()
        }, 1000)

        function timeInterval() {
            if(isDownloading == false) return
            time++
            $(".bottom").innerHTML = `Downloading ${mult(time % 3 + 1, '.')} (${time}s)`
        }
    </script>
</body>
</html>