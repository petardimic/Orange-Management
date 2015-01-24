<div class="b b-5 c7-1 c7" id="i7-1-1">
    <h1>
        <?= /** @var \Modules\News\Article $article */
        $article->getTitle(); ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <span><?= $article->getPublish()->format('Y-m-d H:i:s'); ?></span> <span><?= $article->getAuthor(); ?></span>
        <?= $article->getContent(); ?>
    </div>
</div>