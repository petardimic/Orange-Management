<?php
/* TODO: Check 'id' with sanitizer for [A-Za-z] */
/** @var \Modules\Admin\Controller $this */
$modules_all = $this->app->modules->getAllModules();

if(array_key_exists($this->app->request->getData()['id'], $modules_all)) {
    /** @noinspection PhpUndefinedMethodInspection */
    \Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                     1000105001]);
}
?>

<div class="b b-5 c1-7 c1" id="i1-7-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Module']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <img alt="<?= $this->app->user->getL11n()->lang[1]['Module']; ?>"
             src="/Modules/<?= $this->app->request->getData()['id']; ?>/img/module_teaser_small.png" class="lf img-1">
        <span class="lf">
            <h1><?=
                /** @var array $info */
                $info['name']['external']; ?></h1>
            <p><?= $info['description']; ?></p>
        </span>

        <div class="clearfix rT">
            <ul>
                <?php
                /** @var \Framework\Module\Modules $modules */
                if (!array_key_exists($this->app->request->getData()['id'], $this->app->modules->getInstalledModules())) {
                ?>
                <li>
                    <button data-http="PUT" data-request="DYN"
                            data-json='{"id":"<?= $this->app->request->getData()['id']; ?>"}' data-uri="<?=
                    \Framework\Uri\UriFactory::build([
                            $this->app->request->getData()['l0'],
                            'api',
                            'admin',
                            'module'
                        ]
                    ); ?>"><?= $this->app->user->getL11n()->lang[1]['Install']; ?></button>
                    <?php } else { ?>
                <li><a href="<?=
                    \Framework\Uri\UriFactory::build([
                        $this->app->request->getData()['l0'],
                        $this->app->request->getData()['l1'],
                        $this->app->request->getData()['l2'],
                        $this->app->request->getData()['l3'],
                        $this->app->request->getData()['l4'],
                        'settings'
                    ],
                        [['id', $this->app->request->getData()['id']]]
                    );
                    ?>"><?= $this->app->user->getL11n()->lang[1]['Settings']; ?></a>
                    <?php } ?>
                <li><a href=""></a>
            </ul>
        </div>
    </div>
</div>

<div class="b b-2 c1-7 c1" id="i1-7-2">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Features']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../../../docs/features.htm'; ?>
    </div>
</div>

<div class="b b-2 c1-7 c1" id="i1-7-3">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Version']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../../../docs/version.htm'; ?>
    </div>
</div>