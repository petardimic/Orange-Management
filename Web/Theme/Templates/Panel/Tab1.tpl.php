<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <?php $i = 0; foreach($this->getViews() as $tab): $i++; ?>
            <li<?= ($tab->getData('active') === true ? ' class="a"' : ''); ?>><a href=".tab-<?= $this->id; ?>-<?= $i; ?>"><?= $this->tab->title; ?></a>
        <?php endforeach; ?>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <!-- @formatter:off -->
        <?php $i = 0; foreach($this->getViews() as $tab): $i++; ?>
            <div class="tab tab-<?= $this->id; ?>-<?= $i; ?><?= ($tab->getData('active') === true ? ' a' : ''); ?>">
                <?= $tab->getResponse(); ?>
            </div>
        <?php endforeach; ?>
        <!-- @formatter:on -->
    </div>
</div>