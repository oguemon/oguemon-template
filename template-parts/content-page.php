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
		<h1 id="post-title" class="entry-title"><?= get_the_title() ?></h1>
		<div id="post-meta">
			<p id="posted-on">
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

	<div id="post-body" class="entry-content clearfix">
<?php
	//本文の表示
	the_content();
	//次のページ・前のページ
	wp_link_pages( array(
		'before'           => '<div class="page-links">',
		'after'            => '</div>',
		'previouspagelink' => '<div class="page-link-arrow prev">前のページ</div><div></div>',
		'nextpagelink'     => '<div class="page-link-arrow next">次のページ</div><div></div>',
		'next_or_number'   => 'next',
		'separator'        => ' ',
		'echo'             => 1
	) );
	//ページ番号
	wp_link_pages( array(
		'before'           => '<div class="page-links">',
		'after'            => '</div>',
		'link_before'      => '<span class="page-number">',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'echo'             => 1
	) );
?>
	</div><!-- id="post-body" -->

</article>
