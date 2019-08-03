<?php
/**
 * 固定ページの表示用
 * @package oguemon
 */

?>
<article class="hentry">
<?php
	if ( has_post_thumbnail() ){
?>
		<div id="post-thumbnail"><?= get_the_post_thumbnail() ?></div>
<?php
	}
?>
	<div id="post-header">
		<p class="category"><?php the_category(' '); ?></p>
		<h1 class="title entry-title"><?= get_the_title() ?></h1>
		<div class="meta">
			<p class="posted-on">
				<i class="icon-updated"></i><time class="updated" datetime="<?= get_the_modified_date('c') ?>"><?= get_the_modified_date() ?></time>
			</p>
		</div>
	</div>

	<div id="post-body" class="entry-content clearfix">
<?php
	//本文の表示
	the_content();
?>
	</div><!-- id="post-body" -->

</article>
