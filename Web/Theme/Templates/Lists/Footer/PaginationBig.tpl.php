<?php
/** @var \Web\Views\Lists\PaginationView $this */
$allowedPages = ($this->maxPages - 3) / 2;
$left         = ($this->page > $allowedPages ? $allowedPages : $this->page - 1);
$right        = ($this->page < $this->pages - $allowedPages ? $allowedPages : $this->pages - $this->page) + $allowedPages - $left;
$left += ($allowedPages - $right > 0 ? $allowedPages - $right + 1 : 0);
$right += ($left < $allowedPages ? 1 : 0);
?>
<ul>
    <?php if ($this->page !== 1): ?>
    <li>1<!-- how many pages are allowed between now and 1 >= how many pages are between now and 1 -->
        <?php endif; ?>
        <?php if ($allowedPages < $this->page - 2): ?>
    <li>...
        <?php endif; ?>
        <?php for ($i = $this->page - $left;
        $i < $this->page && $i > 1;
        $i++): ?>
    <li><?= $i; ?>
        <?php endfor; ?>
    <li>NOW
        <?php for ($c = $this->page + 1;
        $c <= $this->page + $right && $c < $this->pages;
        $c++): ?>
    <li><?= $c; ?>
        <?php endfor; ?>
        <!-- (symmetrie => same as top) >= how many pages are between now and last -->
        <?php if ($allowedPages < $this->pages - $this->page - 1): ?>
    <li>...
        <?php endif; ?>
        <?php if ($this->page !== $this->pages): ?>
    <li><?= $this->pages; ?>
        <?php endif; ?>
</ul>