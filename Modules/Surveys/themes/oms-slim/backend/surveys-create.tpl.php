<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1000801001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b b-2 c8-2 c8" id="i8-2-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[8]['Survey']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
	    <ul class="l-1">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[8]['Title']; ?></label>
	    	<li>
	    		<input type="text">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[8]['Receiver']; ?></label>
	    	<li>
	    		<input type="text"> <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[8]['Result']; ?></label>
	    	<li>
	    		<input type="text"> <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    	<li>
	    </ul>
    </div>
</div>

<div class="b b-2 c8-2 c8" id="i8-2-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[8]['Question']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    	<ul class="l-1">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[8]['Type']; ?></label>
	    	<li>
	    		<select>
	    			<option><?= \Framework\Localization\Localization::$lang[8]['Question']; ?>
	    			<option><?= \Framework\Localization\Localization::$lang[8]['Answer']; ?>
	    			<option><?= \Framework\Localization\Localization::$lang[8]['Section']; ?>
	    		</select>
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[8]['Text']; ?></label>
	    	<li>
	    		<input type="text">
	    	<li>
	    		<button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    </ul>
    </div>
</div>

<div class="b b-5 c8-2 c8" id="i8-2-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[8]['Survey']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="c-bar rT">
    <button><?= \Framework\Localization\Localization::$lang[0]['Create']; ?></button>
    <button><?= \Framework\Localization\Localization::$lang[0]['Cancel']; ?></button>
</div>
