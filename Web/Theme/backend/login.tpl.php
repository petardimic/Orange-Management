<?php
$loginForm = new \Web\Views\Form\FormView($this->l11n, $this->response, $this->request);
$loginForm->setTemplate('/Web/Theme/Templates/Forms/FormFull');
$loginForm->setSubmit('submit1', $this->l11n->lang[0]['Login']);
$loginForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . '/' . $this->l11n->getLanguage() . '/api/login.php');
$loginForm->setMethod(\phpOMS\Message\RequestMethod::POST);

$loginForm->setElement(0, 0, [
    'type'      => \phpOMS\Html\TagType::INPUT,
    'subtype'   => 'text',
    'name'      => 'user',
    'tabindex'  => 0,
    'autofocus' => true,
    'label'     => $this->l11n->lang[0]['Username'],
]);

$loginForm->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::INPUT,
    'subtype'  => 'password',
    'name'     => 'pass',
    'tabindex' => 0,
    'label'    => $this->l11n->lang[0]['Password'],
]);

$head = $this->response->getHead();
?>
<!DOCTYPE HTML>
<html>
<head>
    <?= $head->getMeta()->render(); ?>
    <title><?= $a = $head->getTitle(); ?></title>
    <?= $head->renderAssets(); ?>
    <style>
        <?= $head->renderStyle(); ?>
    </style>
    <script>
        <?= $head->renderScript(); ?>
    </script>
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

        li {
            list-style-type: none;
        }

        input {
            margin-bottom: 5px;
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
            width: 270px;
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
        <?= $loginForm->render(); ?>
    </div>
</div>
</body>
</html>