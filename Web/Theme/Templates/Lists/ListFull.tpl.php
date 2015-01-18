<table class="t-1 m-<?= $this->getModule(); ?> mp-<?= ($this->getModule() + $this->getPageId()); ?>"
       id="i-<?= ($this->getModule() + $this->getId()); ?>">
    <?php if($this->header) {
        echo $this->header->getResponse();
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
    <?php if($this->footer): ?>
        <tfoot>
        <tr>
            <td colspan="<?= count($this->header->elements); ?>">
                <?= $this->footer->getResponse(); ?>
            </td>
        </tr>
        </tfoot>
    <?php endif; ?>
</table>