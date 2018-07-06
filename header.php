<?php
/**
 * ページ上部
 * @package oguemon
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?= get_bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<?php wp_head(); ?>

<!--OGP設定  -->
<?php
//デフォルトサムネ画像のURLを入れよう！
$ogp_img = get_bloginfo('template_directory') . '/img/ogp.png';
//ページの種別で条件分岐
if (is_single()){
	while(have_posts()){
		the_post();
		$ogp_title = get_the_title();
		$ogp_description = mb_substr(get_the_excerpt(), 0, 100);
		$ogp_url = get_permalink();
		$ogp_type = 'article';
		//サムネイル
		if (has_post_thumbnail()){
			//アイキャッチ画像を使用
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src( $image_id, 'full');
			$ogp_img = $image[0];
		} else if ( preg_match( '/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl )){
			//一番上の画像を使用
			$ogp_img = $imgurl[2];
		}
	}
} else if(is_category()){
		$ogp_title = single_cat_title('', false);
		$ogp_description = mb_substr( strip_tags(get_the_archive_description()), 0, 100);
		$ogp_url = get_category_link(get_query_var('cat'));
		$ogp_type = 'article';
} else {
		$ogp_title = get_bloginfo('name');
		$ogp_description = get_bloginfo('description');
		$ogp_url = get_bloginfo('url');
		$ogp_type = 'website';
}
?>
	<meta property="og:title" content="<?= $ogp_title ?>">
	<meta property="og:type" content="<?= $ogp_type ?>">
	<meta property="og:url" content="<?= $ogp_url ?>">
	<meta property="og:image" content="<?= $ogp_img ?>">
	<meta property="og:site_name" content="<?= get_bloginfo('name') ?>">
	<meta property="og:description" content="<?= $ogp_description ?>">
	<meta property="fb:app_id" content="1846956072250071">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@oguemon_com">
</head>

<body>
	<!-- スマホ用ヘッドバー -->
	<div id="sp-header">
		<a href="<?= get_bloginfo('url');?>"><div id="blog-title-sp"></div></a>
		<div id="sp-menu-right-btn"></div>
	</div>
	<div id="sp-right-menu-area">
		<div class="profile">
			<div class="icon">
				<img src="https://oguemon.com/wordpress/wp-content/themes/oguemon/img/profile.jpg">
			</div>
			<div class="name">おぐえもん</div>
		<div class="bio">大学に通う情報系の大学生です。WebプログラミングやDTPに僅かな経験があるほか、渋谷系をはじめとする邦楽などに興味を持ってます。</div>
			<a class="contact twitter" href="https://twitter.com/oguemon_com" target="_blank"></a>
			<div class="contact mail"></div>
		</div>
		<?php
		// スマホ用メニュー
		wp_nav_menu( array(
			'menu'            => '',
			'menu_class'      => 'menu',
			'menu_id'         => 'sp-right-menu',
			'container'       => '',
			'container_class' => '',
			'container_id'    => '',
			'theme_location'  => 'sp-right',
			'items_wrap'      => '<ul>%3$s</ul>'
		)); 
		?>
	</div>

<!-- スマホメニュー開放中のみ有効化 -->
<div id="transparent" style="display: none;"></div>

<!-- 以下、PC・スマホ共通コンテンツ -->
<div id="container">
	<!-- ヘッダー -->
	<header class="clearfix">
		<!-- ロゴとか -->
		<div class="wrapper clearfix">
			<?php
			if ( has_nav_menu( 'secondary' ) ) {
				// 右上メニュー
				echo '<nav id="menu-secondary" role="navigation" aria-label="Secondary Navigation">';
				wp_nav_menu( array(
					'container' => '', 
					'container_class' => '', 
					'menu_class' => '', 
					'menu_id' => 'menu-main-secondary', 
					'sort_column' => 'menu_order', 
					'theme_location' => 'secondary', 
					'link_after' => '', 
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' ));
				echo '</nav>';
			}
			?>
			<div id="blog-info">
				<div id="blog-title"><a href="<?= get_bloginfo('url')?>"><?= get_bloginfo('name')?></a></div>
				<div id="blog-description">たぶん今すぐ使えるテクニックから、きっと全く使えない豆知識まで。</div>
			</div>
		</div>

		<!-- メインメニュー -->
		<nav id="menu-main">
			<div class="wrapper clearfix">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'container' => '', 
					'container_class' => '',
					'menu_id' => 'menu-main-list', 
					'sort_column' => 'menu_order', 
					'theme_location' => 'primary', 
					'link_after' => '', 
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' ));
			}
			?>
			</div>
		</nav>
	</header>
