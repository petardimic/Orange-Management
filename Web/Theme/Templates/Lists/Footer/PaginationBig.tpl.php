<?php if($this->results > 0): ?>
<select class="rf onChange" data-request="groups-list-length" data-bind='{"::limit": 25}' data-requesttype="GET" data-src="<?php
$url = \phpOMS\Uri\Http::routify(\phpOMS\Uri\Http::getCurrent());
echo \phpOMS\Uri\UriFactory::build($url['route'], ['limit' => '::limit']+$url['query']); ?>">
    <option value="10">10
    <option value="25" selected>25
    <option value="50">50
    <option value="100">100
    <option value="250">250
    <option value="500">500
</select>
<label class="lf"><?= $this->l11n->lang[0]['Results']; ?>: <?= $this->results; ?></label>
<?php endif; ?>
<?php
if($this->pages > 1):
    /** @var \Web\Views\Lists\PaginationView $this */
    $allowedPages = ($this->maxPages - 3) / 2;
    $left         = ($this->page > $allowedPages ? $allowedPages : $this->page - 1);
    $right        = ($this->page < $this->pages - $allowedPages ? $allowedPages : $this->pages - $this->page) + $allowedPages - $left;
    $left += ($allowedPages - $right > 0 ? $allowedPages - $right + 1 : 0);
    $right += ($left < $allowedPages ? 1 : 0);
    ?>
    <!-- @formatter:off -->
<ul>
        <?php if ($this->page !== 1): ?>
    <li><a href="#">1</a><!-- how many pages are allowed between now and 1 >= how many pages are between now and 1 -->
        <?php endif; ?>
        <?php if ($allowedPages < $this->page - 2): ?>
    <li>...
        <?php endif; ?>
        <?php for ($i = $this->page - $left;
        $i < $this->page && $i > 1;
        $i++): ?>
    <li><a href="#"><?= $i; ?></a>
        <?php endfor; ?>
    <li><a class="a" href="#"><?= $this->page; ?></a>
        <?php for ($c = $this->page + 1;
        $c <= $this->page + $right && $c < $this->pages;
        $c++): ?>
    <li><a href="#"><?= $c; ?></a>
        <?php endfor; ?>
        <!-- (symmetrie => same as top) >= how many pages are between now and last -->
        <?php if ($allowedPages < $this->pages - $this->page - 1): ?>
    <li>...
        <?php endif; ?>
        <?php if ($this->page !== $this->pages): ?>
    <li><a href="#"><?= $this->pages; ?></a>
        <?php endif; ?>
</ul>
<!-- @formatter:on -->
<?php endif; ?>
