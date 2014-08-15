<?php
/* TODO: Check 'id' with sanitizer for [A-Za-z] */
/** @var \Modules\Admin\Admin $this */
/** @var \Framework\Module\Modules $modules */
$modules_all = $this->app->modules->module_list_all_get();

if (array_key_exists($this->app->request->uri['id'], $modules_all)) {
    \Framework\Module\ModuleFactory::$initialized[1000500000]->show([3, 1000105001]);
}
?>

<div class="b b-5 c1-7 c1" id="i1-7-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Module']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <img alt="<?= \Framework\Localization\Localization::$lang[1]['Module']; ?>"
             src="/Modules/<?= $this->app->request->uri['id']; ?>/img/module_teaser_small.png" class="lf img-1">
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
                if (!array_key_exists($this->app->request->uri['id'], $this->app->modules->modules_installed_get())) {
                    ?>
                    <li>
                        <button class="d-call" data-requestType="PUT"
                                data-json='{"id":"<?= $this->app->request->uri['id']; ?>"}' data-src="<?=
                        $this->app->request->generate_uri([
                                $this->app->request->uri['l0'],
                                'api',
                                'admin',
                                'module'
                            ]
                        ); ?>"><?= \Framework\Localization\Localization::$lang[1]['Install']; ?></button>
                <?php } else { ?>
                    <li><a href="<?=
                        $this->app->request->generate_uri([
                                $this->app->request->uri['l0'],
                                $this->app->request->uri['l1'],
                                $this->app->request->uri['l2'],
                                $this->app->request->uri['l3'],
                                $this->app->request->uri['l4'],
                                'settings'
                            ],
                            [['id', $this->app->request->uri['id']]]
                        );
                        ?>"><?= \Framework\Localization\Localization::$lang[1]['Settings']; ?></a>
                <?php } ?>
                <li><a href=""></a>
            </ul>
        </div>
    </div>
</div>

<div class="b b-2 c1-7 c1" id="i1-7-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Features']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../../../' . $this->app->request->uri['id'] . '/docs/features.htm'; ?>
    </div>
</div>

<div class="b b-2 c1-7 c1" id="i1-7-3">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Version']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <?php /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../../../' . $this->app->request->uri['id'] . '/docs/version.htm'; ?>
    </div>
</div>