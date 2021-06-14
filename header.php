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
	// 余因子展開のページかつテストページでない（ABテスト用コード）
	$url = parse_url($_SERVER["REQUEST_URI"]);
    if ($url["path"] == '/study/linear-algebra/cofactor-expansion/') {
        if (get_query_var('type') == 'beta') {
?>
			<link rel="canonical" href="https://oguemon.com/study/linear-algebra/cofactor-expansion/">
<?php
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
?>
	<script type="text/javascript">
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', 'UA-89114839-2', { 'cookieDomain': 'oguemon.com' } );
		ga('send', 'pageview');
	</script>
	<script async src="https://www.google-analytics.com/analytics.js"></script>
<?php
}

// ヘッダーの出力
wp_head();

/*
 *  SEOに関する処理
 */

// 検索ページならインデックス登録させない
if (is_search()) {
	echo '<meta name=”robots” content=”noindex”>';
}

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
		<a id="blog-title-sp" href="<?= get_bloginfo('url');?>"></a>
		<div id="sp-search-btn"></div>
		<div id="sp-menu-right-btn">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div id="sp-search-area">
		<div id="search-header">サイト内検索</div>
		<div id="search-body">
			<p>あらゆるワードの関連記事を検索できます！</p>
			<div class="search-box">
				<form method="get" action="<?= get_bloginfo('url');?>">
					<table>
						<tr>
							<td>
								<input class="search-input" type="text" name="s" value="<?= esc_html(get_search_query( false )) ?>">
							</td>
							<td>
								<button class="search-submit">
									<svg width="26" height="26" viewBox="0 0 13 13"><title>検索</title><path d="m4.8495 7.8226c0.82666 0 1.5262-0.29146 2.0985-0.87438 0.57232-0.58292 0.86378-1.2877 0.87438-2.1144 0.010599-0.82666-0.28086-1.5262-0.87438-2.0985-0.59352-0.57232-1.293-0.86378-2.0985-0.87438-0.8055-0.010599-1.5103 0.28086-2.1144 0.87438-0.60414 0.59352-0.8956 1.293-0.87438 2.0985 0.021197 0.8055 0.31266 1.5103 0.87438 2.1144 0.56172 0.60414 1.2665 0.8956 2.1144 0.87438zm4.4695 0.2115 3.681 3.6819-1.259 1.284-3.6817-3.7 0.0019784-0.69479-0.090043-0.098846c-0.87973 0.76087-1.92 1.1413-3.1207 1.1413-1.3553 0-2.5025-0.46363-3.4417-1.3909s-1.4088-2.0686-1.4088-3.4239c0-1.3553 0.4696-2.4966 1.4088-3.4239 0.9392-0.92727 2.0864-1.3969 3.4417-1.4088 1.3553-0.011889 2.4906 0.45771 3.406 1.4088 0.9154 0.95107 1.379 2.0924 1.3909 3.4239 0 1.2126-0.38043 2.2588-1.1413 3.1385l0.098834 0.090049z"></path></svg>
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>

	<div id="sp-right-menu-area">
		<div class="profile">
			<div class="icon">
				<img src="https://oguemon.com/wordpress/wp-content/themes/oguemon/img/profile.jpg">
			</div>
			<div class="name"><?=get_the_author_meta('nickname', 1)?></div>
			<div class="bio"><?=get_the_author_meta('description', 1)?></div>
			<a class="contact twitter" href="https://twitter.com/oguemon_com" target="_blank"></a>
			<a class="contact instagram" href="https://www.instagram.com/oguemon_com/" target="_blank"></a>
			<div class="contact mail"></div>
		</div>
		<?php
			$url = get_bloginfo('url');
		?>
		<div class="menu-list">
			<a class="menu-item" href="<?=$url?>">ホーム</a>
			<a class="menu-item" href="<?=$url?>/topic/study/linear-algebra/"><i class="category-icon study-icon"></i>線形代数入門</a>
			<a class="menu-item" href="<?=$url?>/topic/knowledge/trivia/"><i class="category-icon heart-icon"></i>豆知識</a>
			<a class="menu-item" href="<?=$url?>/topic/saikoku33/"><i class="category-icon hike-icon"></i>西国三十三ヶ所巡礼</a>
			<a class="menu-item" href="<?=$url?>/topic/web/"><i class="category-icon code-icon"></i>Web開発</a>
			<a class="menu-item" href="<?=$url?>/topic/blog/"><i class="category-icon dialy-icon"></i>おぐえもんの日記</a>
			<a class="menu-item" href="<?=$url?>/services/">提供サービス一覧</a>
			<a class="menu-item" href="<?=$url?>/about/">このサイトについて</a>
			<a class="menu-item" href="<?=$url?>/terms/">利用上の注意点</a>
		</div>
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
				<?php
					$url = get_bloginfo('url');
				?>
				<a id="blog-title" href="<?=$url?>"></a>
				<div id="menu-list">
					<a class="menu-item" href="<?=$url?>/about/">
						<div class="en">ABOUT</div>
						<div class="jp">おぐえもん.comとは</div>
					</a>
					<a class="menu-item" href="<?=$url?>">
						<div class="en">BLOG</div>
						<div class="jp">役立つ記事たち</div>
					</a>
					<a class="menu-item" href="<?=$url?>/services/">
						<div class="en">SERVICE</div>
						<div class="jp">便利な自作サービス</div>
					</a>
					<a class="menu-item" href="https://forms.gle/SDnHnzGLH5Y4ynzz6">
						<div class="en">CONTACT</div>
						<div class="jp">お問い合わせ</div>
					</a>
				</div>
			</div>
		</div>
	</header>
<?php
if(strpos($_SERVER["REQUEST_URI"], 'linear-algebra/') !== false){
?>
	<div class="pr-bar">
		<a href="/study/linear-algebra/textbook/"><span>めっちゃ分かる線形代数入門本を作りました！</span></a>
	</div>
<?php
}
