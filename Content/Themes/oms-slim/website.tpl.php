<?php
header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Under Construction</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=yes">
    <style type="text/css">
        html, body {
            height: 100%;
            padding: 0;
            margin: 0 auto;
            font-family: arial, serif;
            background: #d9392d;
            color: #fff;
        }

        html, body, div {
            margin: 0;
            padding: 0;
        }

        .floater {
            float: left;
            height: 50%;
            width: 100%;
            margin-bottom: -130px;
        }

        #parent {
            display: table;
            position: static;
            clear: left;
            height: 230px;
            width: 600px;
            margin: 0 auto;
        }

        #child {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
            position: relative;
            font-size: 1.0em;
        }

        #title {
            text-align: center;
            font-size: 5em;
            padding-bottom: 20px;
        }

        #content {
        }
    </style>
</head>
<body>
<div class="floater"></div>
<div id="parent">
    <div id="child">
        <div id="title">[ Construction ]</div>
        <div id="content">

        </div>
    </div>
</div>
</body>
</html>