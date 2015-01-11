<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 300');
header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ERROR 503</title>
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
            font-size: 10em;
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
        <div id="title">[ error ]</div>
        <div id="content">
            This service is currently not available. We are sorry for your inconvenience, the server administrator is
            aware of this situation. Please be patient until the service comes back online.
        </div>
    </div>
</div>
</body>
</html>