<table class="tc-1 m-<?= $this->getModule(); ?> mp-<?= ($this->getModule() + $this->getPageId()); ?>"
       id="i-<?= ($this->getModule() + $this->getId()); ?>">
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