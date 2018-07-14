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
<?php
/*
 *  Google Analytics（ログイン中でなければ表示）
 */
if (!is_user_logged_in()) {
?>
	<script type="text/javascript" >
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', 'UA-89114839-2', { 'cookieDomain': 'oguemon.com' } );
		ga('send', 'pageview');
	</script>
	<script async src="https://www.google-analytics.com/analytics.js"></script>
<?php
	// 余因子展開のページかつテストページでない（ABテスト用コード）
    if ($_SERVER["REQUEST_URI"] == '/study/linear-algebra/cofactor-expansion/') {
        if (get_query_var('type') == 'beta') {
			echo '<link rel="canonical" href="https://oguemon.com/study/linear-algebra/cofactor-expansion/">';
        } else {
?>
			<!-- Google Analytics Content Experiment code -->
			<script>function utmx_section(){}function utmx(){}(function(){var
			k='136223162-0',d=document,l=d.location,c=d.cookie;
			if(l.search.indexOf('utm_expid='+k)>0)return;
			function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
			indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
			length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
			'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
			'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
			'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
			valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
			'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
			</script><script>utmx('url','A/B');</script>
			<!-- End of Google Analytics Content Experiment code -->
<?php
		}
    }
}

// ヘッダーの出力
wp_head();

/*
 *  SEOに関する処理
 */
//デフォルトサムネ画像のURLを入れよう！
$ogp_img = get_bloginfo('template_directory') . '/img/ogp.png';

// 一般的な記事なら
if (is_single() || is_page())
{
	while(have_posts())
	{
		the_post();
		
		$description = mb_substr(get_the_excerpt(), 0, 100);

		$ogp_title = get_the_title();
		$ogp_description = $description;
		$ogp_url = get_permalink();
		$ogp_type = 'article';

		//サムネイル
		if (is_single())
		{
			if (has_post_thumbnail())
			{
				//アイキャッチ画像を使用
				$image_id = get_post_thumbnail_id();
				$image = wp_get_attachment_image_src( $image_id, 'full');
				$ogp_img = $image[0];
			}
			else if ( preg_match( '/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl ))
			{
				//一番上の画像を使用
				$ogp_img = $imgurl[2];
			}
		}
	}
}
// カテゴリートップなら
else if(is_category())
{
		$description = mb_substr( strip_tags(get_the_archive_description()), 0, 100);

		$ogp_title = single_cat_title('', false);
		$ogp_description = $description;
		$ogp_url = get_category_link(get_query_var('cat'));
		$ogp_type = 'article';
}
// それ以外（基本は固定ページ）なら
else
{
		$description = 'JKの肩書きを持つ大学生が、地味に役立つ情報から、誰得な実験的コンテンツまで幅広く扱う最強のWebサイトがここに。';
		
		$ogp_title = get_bloginfo('name');
		$ogp_description = get_bloginfo('description');
		$ogp_url = get_bloginfo('url');
		$ogp_type = 'website';
}
?>

	<meta name="description"  content="<?= $description ?>">

	<!-- OGP設定 -->
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

<body ontouchstart="">
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
			<div class="name"><?=get_the_author_meta('nickname', 1)?></div>
			<div class="bio"><?=get_the_author_meta('description', 1)?></div>
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
