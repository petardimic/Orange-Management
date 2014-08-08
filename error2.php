<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ERROR</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
    <style type="text/css">
        html, body {
            height: 100%;
            padding: 0;
            margin: 0 auto;
            font-family: arial, serif;
            background: #4c4c4c;
        }

        html, body, div {
            margin: 0;
            padding: 0;
        }

        .floater {
            float: left;
            height: 50%;
            width: 100%;
            margin-bottom: -115px;
            background: #424242;
            border-bottom: 2px solid #383838;
        }

        #parent {
            display: table;
            position: static;
            clear: left;
            height: 230px;
            width: 500px;
            margin: 0 auto;
        }

        #child {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
            position: relative;
            background: #fff;
            padding: 10px;
        }

        #title {
            text-align: center;
            font-size: 70px;
            padding-bottom: 40px;
        }

        #content {
        }
    </style>
</head>
<body>
<div class="floater"></div>
<div id="parent">
    <div id="child">
        <div id="title">[ error ]</div>
        <div id="content">
            There has been a problem with the page. We are sorry for your inconvenience, the server administrator has
            been
            informed about this. Please be patient until this problem gets resolved.
        </div>
    </div>
</div>
</body>
</html>