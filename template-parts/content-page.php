<?php
/**
 * 固定ページの表示用
 * @package oguemon
 */

?>
<article class="hentry">
<?php
	//.thumbnail-post-intro
	if ( has_post_thumbnail() ){
?>
		<div id="post-thumbnail"><?= get_the_post_thumbnail() ?></div>
<?php
	}
?>
	<div id="post-header">
		<h1 class="title"><?= get_the_title() ?></h1>
		<div class="meta">
			<p class="excerpt"><?= get_the_excerpt() ?></p>
			<p class="posted-on">
<?php if ( get_the_date() == get_the_modified_date() ){ ?>
				<span class="icon-published"></span><time class="published updated" datetime="<?= get_the_date('c') ?>"><?= get_the_date() ?></time>
<?php } else { ?>
				<span class="icon-published"></span><time class="published" datetime="<?= get_the_date('c') ?>"><?= get_the_date() ?></time>
				<span class="icon-updated"></span><time class="updated" datetime="<?= get_the_modified_date('c') ?>"><?= get_the_modified_date() ?></time>
<?php } ?>
				<span class="icon-author"></span><span class="vcard author"><span class="fn">おぐえもん</span></span>
			</p>
		</div>
	</div>

	<div id="post-body" class="clearfix">
<?php
	//本文の表示
	the_content();
?>
	</div><!-- id="post-body" -->

</article>
