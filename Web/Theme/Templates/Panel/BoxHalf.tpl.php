<div class="b b-2 m-<?= $this->module; ?> mp-<?= ($this->module + $this->id); ?>"
     id="i-<?= ($this->module + $this->id); ?>">
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