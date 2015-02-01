<?php
/** @var \Web\Views\Lists\PaginationView $this */
$allowedPages = ($this->maxPages - 3) / 2; ?>
<ul>
    <li>1<!-- how many pages are allowed between now and 1 >= how many pages are between now and 1 -->
        <?php if ($allowedPages < $this->page - 2): ?>
    <li>...
        <?php endif; ?>
        <?php for ($i = $this->page - $allowedPages;
        $i < $this->page && $i > 1;
        $i++): ?>
    <li><?= $i; ?>
        <?php endfor; ?>
    <li>NOW
        <?php for ($i = $this->page + 1;
        $i <= $this->page + $allowedPages && $i < $this->pages;
        $i++): ?>
    <li><?= $i; ?>
        <?php endfor; ?>
        <!-- (symmetrie => same as top) >= how many pages are between now and last -->
        <?php if ($allowedPages < $this->pages - $this->page - 1): ?>
    <li>...
        <?php endif; ?>
    <li><?= $this->pages; ?>
</ul>