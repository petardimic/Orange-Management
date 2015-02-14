<?php /** @var \Web\Views\Lists\ListView $this */ ?>
<table class="t t-1 m-<?= $this->module; ?> mp-<?= ($this->module + $this->pageId); ?>"
       id="i-<?= ($this->module + $this->id); ?>">
    <?php
    /** @var \Web\Views\Lists\HeaderView $header */
    $header = $this->getView('header');
    $footer = $this->getView('footer');
    if($header !== false) {
        echo $header->getOutput();
    } ?>
    <?php if(isset($this->elements)): ?>
        <tbody>
        <?php foreach($this->elements as $rKey => $row): ?>
            <tr>
                <?php foreach($row as $cKey => $column): ?>
                    <td><?= $column; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    <?php endif; ?>
    <?php if($footer): ?>
        <tfoot>
        <tr>
            <td colspan="<?= count($header->getHeaders()); ?>" class="cT">
                <?= $footer->getOutput(); ?>
            </td>
        </tr>
        </tfoot>
    <?php endif; ?>
</table>