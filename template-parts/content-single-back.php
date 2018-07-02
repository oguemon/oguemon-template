<?php
/**
 * 個別投稿用
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
		<p id="post-category"><?php the_category(' '); ?></p>
		<h1 id="post-title" class="entry-title"><?= get_the_title() ?></h1>
		<div id="post-meta">
			<p id="post-excerpt" class="entry-summary"><?= get_the_excerpt() ?></p>
			<p id="posted-on">
				<span class="genericon genericon-time" aria-hidden="true"></span> <time class="published" datetime="<?= get_the_date('c') ?>"><?= get_the_date() ?></time>
				(<time class="updated" datetime="<?= get_the_modified_date('c') ?>"><?= get_the_modified_date() ?></time>更新)
				<span class="genericon genericon-user" aria-hidden="true"></span> <span class="vcard author"><span class="fn">おぐえもん</span></span>
			</p>
		</div>
	</div>
<?php
	if(has_category()){
		$category = get_the_category()[0];
?>
	<div class="category-detail">
		<span id="icon">本カテゴリ</span>
		<div id="title" rel="tag"><?= $category->name ?></div>
		<div id="description"><?= $category->description ?></div>
		<div id="link">
			<a href="<?= get_category_link($category->cat_ID) ?>">＞＞このカテゴリの記事一覧（<?= $category->count ?>件）を見る</a>
		</div>
	</div>
<?php
	}
?>
	<!-- ソーシャルボタン -->
<?php
//リンクの生成
$title = urlencode(get_the_title());
$url   = urlencode(get_permalink());
$link_twitter = 'http://twitter.com/share?url=' . $url . '&text=' . $title . '&related=oguemon_com';
$link_fb      = 'https://www.facebook.com/dialog/feed?app_id=1846956072250071&link='. $url;
$link_gplus   = 'https://plus.google.com/share?url=' . $url;
$link_hatena  = 'http://b.hatena.ne.jp/entry/' . $url;
$link_line    = 'http://line.me/R/msg/text/?'. $url;
$link_pocket  = 'http://getpocket.com/edit?url=' . $url . '&title=' . $title;
?>
	<div class="sns-btn-list-header">
		<a href="<?= $link_twitter ?>" target="_blank"><div class="sns-btn sns-btn-twitter"></div></a>
		<a href="<?= $link_fb ?>" target="_blank"><div class="sns-btn sns-btn-facebook"></div></a>
		<a href="<?= $link_gplus ?>" target="_blank"><div class="sns-btn sns-btn-gplus"></div></a>
		<a href="<?= $link_hatena ?>" target="_blank"><div class="sns-btn sns-btn-hatena"></div></a>
		<a href="<?= $link_line ?>" target="_blank"><div class="sns-btn sns-btn-line"></div></a>
		<a href="<?= $link_pocket ?>" target="_blank"><div class="sns-btn sns-btn-pocket"></div></a>
	</div>
		
	<div id="post-body" class="entry-content clearfix">
<?php
	//本文の表示
	the_content();
	//次のページ・前のページ
	wp_link_pages( array(
		'before'           => '<div class="page-links">',
		'after'            => '</div>',
		'previouspagelink' => '<div id="previous-page-link-before"></div><div id="previous-page-link">前のページ</div>',
		'nextpagelink'     => '<div id="next-page-link-before"></div><div id="next-page-link">次のページ</div>',
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
		<!-- ソーシャルボタン（記事上部にもあり） -->
		<div class="sns-btn-list-footer">
			<a href="<?= $link_twitter ?>" target="_blank"><div class="sns-btn sns-btn-twitter"></div></a>
			<a href="<?= $link_fb ?>" target="_blank"><div class="sns-btn sns-btn-facebook"></div></a>
			<a href="<?= $link_gplus ?>" target="_blank"><div class="sns-btn sns-btn-gplus"></div></a>
			<a href="<?= $link_hatena ?>" target="_blank"><div class="sns-btn sns-btn-hatena"></div></a>
			<a href="<?= $link_line ?>" target="_blank"><div class="sns-btn sns-btn-line"></div></a>
			<a href="<?= $link_pocket ?>" target="_blank"><div class="sns-btn sns-btn-pocket"></div></a>
		</div>

	</div><!-- id="post-body" -->
	<div class="ad-article-footer">
		<style type="text/css">
		.ad-f-item{width: 300px; height: 250px;}
		@media (max-width: 640px) {
			.ad-f-item{width: 320px; height: 100px;}
		}
		</style>
		<!-- 【広告】サイト下部1 -->
		<ins class="adsbygoogle ad-f-item"
		     style="display:block"
		     data-ad-client="ca-pub-6941251424797111"
		     data-ad-slot="2627690984"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
		<!-- 【広告】サイト下部2 -->
		<ins class="adsbygoogle ad-f-item"
		     style="display:block"
		     data-ad-client="ca-pub-6941251424797111"
		     data-ad-slot="7057890583"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
	</div>
<?php
	if(has_category()){
		/* 同じカテゴリの記事一覧 */
?>
		<div id="same-category">
			<div id="header">このカテゴリーの最新記事</div>
<?php
		$this_article_ID = get_the_ID();
		query_posts('cat='.$category->cat_ID.'&showposts=5');
		while(have_posts()){
			the_post();//記事情報の取得
			$end_div = '';
			if(get_the_ID() == $this_article_ID){
				echo '<div id="same-article">';
				echo '<div id="same-article-header">この記事です！</div>';
				$end_div = '</div>';
			}
?>
			<a href="<?=get_permalink()?>">
			<div class="article clearfix">
				<div class="thumbnail"><?= get_the_post_thumbnail() ?></div>
				<div class="info">
					<div class="date"><?= get_the_date() ?></div>
					<div class="title"><?= get_the_title() ?></div>
					<div class="detail"><?= get_the_excerpt() ?></div>
				</div>
			</div>
			</a>
<?php
			echo $end_div;
		}
		wp_reset_query();
?>
			<div class="category-detail">
				<a href="<?= get_category_link($category->cat_ID) ?>">このカテゴリの全ての記事（<?= $category->count ?>件）を見る</a>
			</div>
		</div>
<?php
	}
?>
</article>
