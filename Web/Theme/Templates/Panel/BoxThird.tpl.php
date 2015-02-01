<div class="b b-1 m-<?= $this->getModule(); ?> mp-<?= ($this->getModule() + $this->getPageId()); ?>"
     id="i-<?= ($this->getModule() + $this->getId()); ?>">
    <h1>
        <?= $this->title ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>
    <div class="bc-1">
        <?php
        /** @var  \Framework\Views\ViewAbstract $view */
        foreach($this->views as $view) {
            echo $view->getResponse();
        }
        ?>
    </div>
</div>