<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <?php $i = 0; foreach($this->tab as $element): $i++; ?>
            <li<?= ($this->active === $i) ? ' class="active"' : ''; ?>><a href=".tab-<?= $i; ?>"><?= $element['title'] ?></a>
        <?php endforeach; ?>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <?php $i = 0; foreach($this->tab as $element): $i++; ?>
        <div class="tab tab-<?= $i; ?><?= ($this->active === $i) ? ' active' : ''; ?>">
            <?= $element['content']; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>