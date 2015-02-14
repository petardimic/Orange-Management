<?php
/**
 * @var \Web\Views\Form\FormView $this
 */
?>
<ul>
    <?php foreach($this->elements as $row): ?>
        <li>
        <?php foreach($row as $element): ?>
            <?php if($element['type'] === \Framework\Html\TagType::GENERIC): ?>
                <?= '<' . $element['tag'] . '>' . $element['content'] . '</' . $element['tag'] . '>'; ?>
            <?php elseif($element['type'] === \Framework\Html\TagType::INPUT): ?>
                <?php if(isset($element['label']) && $element['subtype'] !== 'checkbox'): ?>
                    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label><li>
                <?php endif; ?>
                <input name="<?= $element['name']; ?>" id="n-<?= $element['name']; ?>"
                       type="<?= $element['subtype']; ?>"
                       value="<?= (isset($element['value']) ? $element['value'] : ''); ?>"
                    <?= (isset($element['placeholder']) ? ' placeholder="' . $element['placeholder'] . '"' : ''); ?>
                    <?= (isset($element['regex']) ? ' data-validate="' . $element['regex'] . '"' : ''); ?>>
                <?php if(isset($element['label']) && $element['subtype'] === 'checkbox'): ?>
                    <label for="<?= $element['name']; ?>"><?= $element['label']; ?></label>
                <?php endif; ?>
                <?php if(isset($element['info'])): ?>
                    <i class="bt-1 b-3 vh"><?= $element['info']; ?></i>
                <?php endif; ?>
            <?php elseif($element['type'] === \Framework\Html\TagType::BUTTON): ?>
                <button><?= $element['content']; ?></button>
            <?php elseif($element['type'] === \Framework\Html\TagType::TEXTAREA): ?>
                <?php if(isset($element['label'])): ?>
                    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label><li>
                <?php endif; ?>
                <textarea name="<?= $element['name']; ?>"
                          id="n-<?= $element['name']; ?>"><?= (isset($element['content']) ? $element['content'] : ''); ?></textarea>
            <?php elseif($element['type'] === \Framework\Html\TagType::SELECT): ?>
                <?php if(isset($element['label'])): ?>
                    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label><li>
                <?php endif; ?>
                <select id="n-<?= $element['name']; ?>">
                    <?php foreach($element['options'] as $option): ?>
                        <option
                            value="<?= $option['value']; ?>"<?= ($element['selected'] == $option['value'] ? ' selected' : ''); ?>><?= $option['content']; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif($element['type'] === \Framework\Html\TagType::LABEL): ?>
                <label for="<?= $element['for']; ?>"><?= $element['content']; ?></label>
            <?php endif; ?>
        <?php endforeach; ?>
        </li>
    <?php endforeach; ?>
    <?php if ($this->hasSubmit): ?>
    <li class="submit"><input type="submit" value="<?= $this->getData('submit'); ?>">
        <?php endif; ?>
</ul>