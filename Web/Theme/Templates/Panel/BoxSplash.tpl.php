<div class="b b-1 m-<?= $this->module; ?> mp-<?= ($this->module + $this->pageId); ?>"
     id="i-<?= ($this->module + $this->id); ?>">
    <h1>
        <?= $this->title ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>
    <div class="bc-1">
        <i class="fa fa-<?= $this->getData('icon'); ?>"></i>
        <?= $this->getView('table')->getResponse(); ?>
    </div>
</div>