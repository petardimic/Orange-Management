<?php /** @var \Web\Views\Lists\ListView $this */ ?>
<table class="tc-1 m-<?= $this->module; ?> mp-<?= ($this->module + $this->pageId); ?>"
       id="i-<?= ($this->module + $this->id); ?>">
    <?php foreach($this->elements as $rKey => $row): ?>
        <tr>
            <th>
                <lable><?= $row[0]; ?></lable>
            </th>
            <?php for($i = 1; $i < count($row); $i++): ?>
                <td><?= $row[$i]; ?></td>
            <?php endfor; ?>
        </tr>
    <?php endforeach; ?>
</table>