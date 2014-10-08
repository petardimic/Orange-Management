<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1001701001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b b-2 c17-2 c17" id="i17-2-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[17]['ProjectManagement']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
	    <ul class="l-1">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[17]['Title']; ?></label>
	    	<li>
	    		<input type="text">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[17]['Receiver']; ?></label>
	    	<li>
	    		<input type="text"> <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[17]['Manager']; ?></label>
	    	<li>
	    		<input type="text"> <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    	<li>
	    </ul>
    </div>
</div>

<div class="b b-2 c17-2 c17" id="i17-2-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[17]['Elements']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    	<ul class="l-1">
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[17]['Type']; ?></label>
	    	<li>
	    		<select>
	    			<option><?= \Framework\Localization\Localization::$lang[17]['Milestone']; ?>
	    			<option><?= \Framework\Localization\Localization::$lang[17]['Answer']; ?>
	    			<option><?= \Framework\Localization\Localization::$lang[17]['Section']; ?>
	    		</select>
	    	<li>
	    		<label><?= \Framework\Localization\Localization::$lang[17]['Text']; ?></label>
	    	<li>
	    		<input type="text">
	    	<li>
	    		<button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
	    </ul>
    </div>
</div>

<div class="b b-5 c17-2 c17" id="i17-2-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[17]['Survey']; ?>
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
