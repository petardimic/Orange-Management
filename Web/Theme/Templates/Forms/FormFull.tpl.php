<form action="<?= $this->action; ?>" method="<?= $this->method; ?>">
    <ul>
        <?php foreach($this->elements as $row): ?>
            <li>
                <?php foreach($row as $element): ?>
                    <?php if($element['type'] === \Framework\Html\TagType::GENERIC): ?>
                        <?= '<' . $element['tag'] . '>' . $element['content'] . '</' . $element['tag'] . '>'; ?>
                    <?php elseif($element['type'] === \Framework\Html\TagType::INPUT): ?>
                        <input name="<?= $element['name']; ?>" id="<?= $element['id']; ?>"
                               type="<?= $element['subtype']; ?>" value="<?= $element['value']; ?>"
                               placeholder="<?= $element['placeholder']; ?>"<?= (isset($element['regex']) ? ' data-validate="' . $element['regex'] . '"' : ''); ?>>
                        <?php if(isset($element['info'])): ?>
                            <i class="bt-1 b-3 vh"><?= $element['info']; ?></i>
                        <?php endif; ?>
                    <?php elseif($element['type'] === \Framework\Html\TagType::BUTTON): ?>
                        <button><?= $element['content']; ?></button>
                    <?php elseif($element['type'] === \Framework\Html\TagType::TEXTAREA): ?>
                        <textarea><?= $element['content']; ?></textarea>
                    <?php elseif($element['type'] === \Framework\Html\TagType::SELECT): ?>
                        <select>
                            <?php foreach($element['options'] as $option): ?>
                                <option
                                    value="<?= $option['value']; ?>" <?= ($option['selected'] ? ' selected' : ''); ?>><?= $option['content']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif($element['type'] === \Framework\Html\TagType::LABEL): ?>
                        <label for="<?= $element['for']; ?>"><?= $element['content']; ?></label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</form>