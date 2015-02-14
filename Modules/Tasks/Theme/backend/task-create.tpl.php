<?php /** @var \Modules\Tasks\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call(\phpOMS\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1001101001]);
?>

<div class="b b-4 c7-1 c7" id="i7-1-1">
    <h1><?= $this->app->user->getL11n()->lang[11]['Task']; ?></h1>

    <div class="bc-1">
        <ul class="l-1">
            <li>
                <lable><?= $this->app->user->getL11n()->lang[11]['Receiver']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->app->user->getL11n()->lang[11]['Due']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->app->user->getL11n()->lang[11]['Message']; ?></lable>
            <li><textarea style="width: 100%"></textarea>
        </ul>
        <button class="rf"><?= $this->app->user->getL11n()->lang[0]['Submit']; ?></button>
        <div class="clearfix"></div>
    </div>
</div>