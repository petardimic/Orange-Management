<thead>
<tr>
    <th colspan="<?= count($this->elements) - 1; ?>" class="lT">
        <i class="fa fa-filter p f dim"></i>

        <h1><?= $this->title; ?></h1>
    </th>
    <th class="rT">
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </th>
</tr>
<tr>
    <?php foreach($this->elements as $key => $element): ?>
        <td<?= ($element['full'] ? ' class="full"' : ''); ?>>
            <?php if($element['title'] != null): ?>
                <span><?= $element['title']; ?></span>
                <?php if($element['sortable']): ?>
                    <i class="fa fa-sort vh"></i>
                    <i class="fa fa-caret-up vh"></i>
                    <i class="fa fa-caret-down vh"></i>
                    <i class="fa fa-times vh"></i>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    <?php endforeach; ?>
</tr>
</thead>