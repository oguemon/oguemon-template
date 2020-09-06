<?php
/**
 * 個別投稿用
 * @package oguemon
 */
?>

<!-- 記事の構造化データ -->
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Article",
  "image": [
    "<?php
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail_url();
			} else {
        echo "https://oguemon.com/wordpress/wp-content/themes/oguemon/img/ogp.png";
      }
		?>"
  ],
  "author": {
    "@type": "Person",
    "name": "おぐえもん"
  },
  "datePublished": "<?= get_the_date('c') ?>",
  "dateModified": "<?= get_the_modified_date('c') ?>",
  "headline": "<?= get_the_title() ?>",
  "publisher": {
    "@type": "Organization",
    "name": "おぐえもん.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://oguemon.com/wordpress/wp-content/themes/oguemon/img/ogp.png"
    }
  },
  "mainEntityOfPage": "<?= get_permalink() ?>"
}
</script>

<!-- 記事開始 -->
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

	<!-- ソーシャルボタン -->
<?php
//リンクの生成
$title = urlencode(get_the_title());
$url   = urlencode(get_permalink());
$link_twitter = 'http://twitter.com/share?url=' . $url . '&text=' . $title . '&related=oguemon_com';
$link_fb      = 'https://www.facebook.com/dialog/feed?app_id=1846956072250071&link='. $url;
$link_hatena  = 'http://b.hatena.ne.jp/entry/' . $url;
$link_line    = 'http://line.me/R/msg/text/?'. $url;
$link_pocket  = 'http://getpocket.com/edit?url=' . $url . '&title=' . $title;
?>
	<div id="sns-btn-list">
		<a href="<?= $link_twitter ?>" target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-twitter"></span></a>
		<a href="<?= $link_fb ?>"      target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-facebook"></span></a>
		<a href="<?= $link_hatena ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-hatena"></span></a>
		<a href="<?= $link_line ?>"    target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-line"></span></a>
		<a href="<?= $link_pocket ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-pocket"></span></a>
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

	<!-- ソーシャルボタン -->
	<div id="sns-btn-list">
		<a href="<?= $link_twitter ?>" target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-twitter"></span></a>
		<a href="<?= $link_fb ?>"      target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-facebook"></span></a>
		<a href="<?= $link_hatena ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-hatena"></span></a>
		<a href="<?= $link_line ?>"    target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-line"></span></a>
		<a href="<?= $link_pocket ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-pocket"></span></a>
	</div>

	<div class="ad-article-footer">
		<style type="text/css">
		.ad-f-item{width: 300px; height: 250px;}
		</style>
		<!-- 【広告】サイト下部1(スマホは全幅表示) -->
		<ins class="adsbygoogle ad-f-item ad-f-item1"
			 data-full-width-responsive="true"
		     data-ad-client="ca-pub-6941251424797111"
		     data-ad-slot="2627690984"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
		<!-- 【広告】サイト下部2(スマホは非表示) -->
		<ins class="adsbygoogle ad-f-item ad-f-item2"
			 data-full-width-responsive="false"
		     data-ad-client="ca-pub-6941251424797111"
		     data-ad-slot="7057890583"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
	</div>

<?php
	// コメント表示
	comments_template();

	if(has_category()):
		/* 関連記事 */
?>
		<div id="relative-article">
			<div id="relative-article-header"><i class="relative-icon"></i>関連記事</div>
			<div id="relative-article-list">
<?php
		$category = get_the_category()[0];
		query_posts('cat='.$category->cat_ID.'&showposts=5');
		while(have_posts()):
			the_post();//記事情報の取得
			$end_div = '';
?>
			<a href="<?=get_permalink()?>" class="relative-article-item">
				<div class="thumbnail"><?= get_the_post_thumbnail() ?></div>
				<div class="info">
					<div class="title"><?= get_the_title() ?></div>
				</div>
				<div class="date"><?= get_the_date() ?></div>
			</a>
<?php
		endwhile;
		wp_reset_query();
?>
			</div>
			<a id="same-category" href="<?= get_category_link($category->cat_ID) ?>">このカテゴリの全ての記事（<?= $category->count ?>件）を見る</a>
		</div>
<?php
	endif;
?>
</article>
