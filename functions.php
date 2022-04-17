<?php
/**
 * テーマ全般に関する関数や定義を設定
 * @package oguemon
 */

// 定数
include_once(get_template_directory() . '/constants.php');

// シェアリンクURL生成
include_once(get_template_directory() . '/func/ShareLinkGenerator.php');

// ショートコード
include_once(get_template_directory() . '/func/shortcode.php');

/**
 * Word Pressに関する初期設定
 */
//上の関数を、テーマの初期化後に実行
add_action('after_setup_theme', function () {
	// フィードリンクの有効化（headerで投稿・コメントのRSSリンクを生成）
	add_theme_support('automatic-feed-links');
	//プラグイン・テーマによるタイトル管理を可能に
	add_theme_support('title-tag');
	//投稿にサムネイルを適用可能
	add_theme_support('post-thumbnails');
	//サムネイルの一般的なサイズ
	set_post_thumbnail_size(800, 450, ['center', 'center']);
	//HTML5を用いた記述を、第2引数で与えた項目に対して許可
	add_theme_support('html5', ['search-form','comment-form','gallery','caption']);
	//編集画面の「見たままモード」に適用するスタイルのファイルを指定
	add_editor_style('css/editor-style.css');
});

// 固定ページにおいて要旨フィールドをサポートさせる
add_post_type_support('page', 'excerpt');

/**
 * headタグ内の不要なタグを除去
 */
// タイトルタグ生成
//remove_action('wp_head', '_wp_render_title_tag', 1);
// スクリプト書き出し
//remove_action('wp_head', 'wp_enqueue_scripts', 1);
// リソースヒント(名前解決など)
remove_action('wp_head', 'wp_resource_hints', 2);
// フィードリンク
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
// 外部記事投稿系
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
// 関連ページ(次ページなど)のタグ表示
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// ローカライズなスタイルシートの読み込み
//remove_action('wp_head', 'locale_stylesheet');
// no-index
//remove_action('wp_head', 'noindex', 1);
// 絵文字対応
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// スタイルの表示（wp_print_stylesアクションの実行）
//remove_action('wp_head', 'wp_print_styles', 8);
// ヘッダにスクリプトを表示（wp_print_head_scriptsアクションの実行）
//remove_action('wp_head', 'wp_print_head_scripts', 9);
// WordPressのバージョン
remove_action('wp_head', 'wp_generator');
// rel="canonical"の出力
remove_action('wp_head', 'rel_canonical');
// 短縮リンク
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// カスタムCSSの出力
//remove_action('wp_head', 'wp_custom_css_cb', 101);
// faviconなどの出力
//remove_action('wp_head', 'wp_site_icon', 99);


// wp-embedのスタイルを表示しない
remove_action('embed_head', 'print_embed_styles');
// wp-embedのスタイルを設定する
add_filter('embed_head', function () {
	wp_enqueue_style('wp-embed-template-org', get_stylesheet_directory_uri() . '/css/embed.css');
});

// Google Analytics
add_action('wp_head', function () {
	echo '<!-- Google Analytics -->'
	   . '<script type="text/javascript">'
	   . 	'window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;'
	   . 	'ga("create", "'. GOOGLE_ANALYTICS_TRACKING_ID . '", {"cookieDomain": "'. GOOGLE_ANALYTICS_COOKIE_DOMAIN . '"});'
	   . 	'ga("send", "pageview");'
	   . '</script>'
	   . "\n";
}, 0);

/**
 * RSSフィードのリンクを生成
 */
add_action('wp_head', function () {
	printf('<link rel="alternate" type="application/rss+xml" title="%s" href="%s">%s', get_bloginfo('name'), get_bloginfo('rss2_url'), "\n");
});

/**
 * RSSフィードの本文を生成
 */
function my_content_feeds($content) {
	global $post, $more;
	$more = false;
	$content = apply_filters('the_content', get_the_content(''));
	$content = str_replace(']]>', ']]&gt;', $content);
	// 元記事へのリンク追加--ここから
	$content = $content . '<p><a href="' . get_permalink($post->ID) . '">「 ' . get_the_title($post->ID) . ' 」の続きを読む</a></p>';
	// 元記事へのリンク追加--ここまで
	return $content;
}
add_filter('the_excerpt_rss', 'my_content_feeds');
add_filter('the_content_feed', 'my_content_feeds');

/**
 * タイトルタグの最適化
 */
// 区切り文字の変更
add_filter('document_title_separator', function () {
	return '|';
});

//タイトルタグの形式変更
add_filter('document_title_parts', function ($title) {

	// トップページでなければサイト説明文要素を削除
	if (!is_front_page()) {
		unset($title['tagline']);
	}

	// ページ数があるならタイトル直後に「（xページ目）」と追記
	if (isset($title['page'])) {
		$pageinfo = explode(" ", $title['page']);
		$title['title'] .= '（' . $pageinfo[1] . 'ページ目）';
		// 元のページ数要素を削除
		unset($title['page']);
	}

	// 一般的な記事なら
	if (is_single()) {
		while(have_posts()) {
			the_post();

			// カテゴリがあるなら
			if(has_category()){
				$category = get_the_category()[0];
				$title['tagline'] = $category->name;
				unset($title['site']);
			}
		}
	// カテゴリートップなら
	} else if(is_category()) {
		unset($title['site']);
	}

	return $title;
});

/**
 * 画像などのコンテンツの最大幅を指定
 */
//上の関数を、テーマの初期化後に実行(第3引数は優先順位-小さい程大きい)
add_action('after_setup_theme', function () {
	$GLOBALS['content_width'] = apply_filters('oguemon_content_width', 720);
}, 0);

/**
 * 記事の要旨（excerpt）の最大文字数を設定
 */
add_filter('excerpt_length', function ($length) {
	return 30;
}, 999);

/**
 * CSSやスクリプトなどの読み込み
 */
add_action('wp_enqueue_scripts', function () {
	//テーマのルート
	$theme_root = get_template_directory_uri();

	//CSSスタイルの追加
	wp_enqueue_style('oguemon-style', $theme_root . '/css/common.css', false, '3.0.180902.2', 'all');

	//デフォルトのJQuery読み込みを解除
	wp_deregister_script('jquery');
	//Google Adsenseの読み込み
	wp_enqueue_script('g-adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array(), false, false);
	//Google Analyticsの読み込み
	wp_enqueue_script('g-analytics', '//www.google-analytics.com/analytics.js', [], false, false);
	//オリジナルのjavascriptの読み込み
	wp_enqueue_script('original', $theme_root . '/js/oguemon.js', array(), '3.0.200622.1', true);
});

/**
 * スクリプトの非同期読み込みを実現
 */
add_filter('clean_url', function ($url) {
	// JSファイルである
    if (strpos($url, '.js') !== false) {
        // katexのコアjsファイルである
        if (strpos($url, 'katex.min.js') !== false) {
            $url .= '\' defer onload=\'';
        } elseif // katexのauto-renderである
        (strpos($url, 'auto-render.min.js') !== false) {
            $url .= '\' defer onload=\'renderMathInElement(document.getElementById("post-body"));';
        } elseif // その他、非同期に表示されるjsファイル
        (strpos($url, 'adsbygoogle.js') !== false ||
         strpos($url, 'analytics.js') !== false ||
         strpos($url, 'smush-lazy-load.min.js') !== false ||
         strpos($url, 'oguemon.js') !== false ||
         strpos($url, 'wp-embed.min.js') !== false) {
            // その他のjsファイル
            $url .= '\' async charset=\'UTF-8';
        }
    }
	// CSSファイルである
	/*
	else if (strpos( $url, '.css' ))
	{
		return "$url' async charset='UTF-8";
	}
	*/

	return $url;
}, 11, 1);

/**
 * Quick Tagsの追加（投稿編集画面のタグボタン）
 */
add_action('admin_print_footer_scripts', function () {
?>
	<script type="text/javascript">
	QTags.addButton('h3','h3','<h3>','</h3>');
	QTags.addButton('h4','h4','<h4>','</h4>');
	QTags.addButton('u','u','<span style="text-decoration: underline;">','</span>');
	QTags.addButton('dl','dl','<dl>\n','\n</dl>');
	QTags.addButton('dt','dt','<dt>','</dt>');
	QTags.addButton('dd','dd','<dd>','</dd>');
	QTags.addButton('box','box','[box title=""]','[/box]');
	QTags.addButton('serif','serif','[serif imgurl="" name=""]','[/serif]');
	QTags.addButton('greet','greet','こんにちは、おぐえもん(<a href="https://twitter.com/oguemon_com" target="_blank">@oguemon_com</a>)です。');
	</script>
<?php
});

/**
 * 画像にwidthとheightの属性を加えない
 */
add_filter('post_thumbnail_html', function ($html) {
    // width height を削除する
    $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
    return $html;
});

/**
 * 画像をpタグで囲まない
 */
add_filter('the_content', function ($content) {
    return preg_replace('/<p>(\s*)(<img .*>)(\s*)<\/p>/iU', '\2', $content);
});

/**
 * Latex記述の内側はbrタグを含めない
 */
// 検索ワードに囲まれた範囲内にある改行コードを削除
function trim_br_between_search_words($regs, $content) {
	// ヒットしなければ終了
	if (preg_match_all($regs, $content, $matches, PREG_OFFSET_CAPTURE) === false) {
		return $content;
	}
	// 2以上の偶数個ヒットしなければ終了
	$match_count = count($matches[0]);
	if ($match_count < 2 && $match_count % 2 !== 0) {
		return $content;
	}
	// 後ろから順にやる
	for ($i = $match_count - 1; $i > 0; $i = $i - 2) {
		// 最初の$$の前の位置を取得
		$pos_1 = $matches[0][$i - 1][1];
		$pos_2 = $matches[0][$i][1];

		// 最初のhタグの前に指定した文字列を挟む
		$target = substr($content, $pos_1, $pos_2 - $pos_1);
		$before_chars = strlen($target);

		// 改行を消す
		$target = preg_replace('/<br\s*\/?>/', '', $target);
		$after_chars = strlen($target);

		// 文字数に変化があれば加える
		if ($before_chars !== $after_chars) {
			$content = substr($content, 0, $pos_1) . $target . substr($content, $pos_2);
		}
	}
	return $content;
}
add_filter('the_content', function ($content) {
	// $$の検索と、\(と\)の検索
	$content = trim_br_between_search_words('/\$\$/', $content);
	$content = trim_br_between_search_words('/\\(|\\)/', $content);
	return $content;
});

/**
 * 記事本文の最初の見出しの前に目次と広告を適宜挟む
 */
add_filter('the_content', function ($content) {

    if (!is_single() && !is_page()) {
        // 記事ページと固定ページ以外に目次を表示させない
        return $content;
    }

	// 大見出し<h3>があるなら
	if (preg_match_all('/<h3>/', $content, $matches, PREG_OFFSET_CAPTURE) !== false) {

		// 2個以上あるなら
		if (count($matches[0]) > 1) {
			// 目次を入れる
			$add_string = <<< EOM
			<div id="toc-box">
				<div id="toc-box-caption"><i class="toc-icon"></i>目次<span class="description">（クリックで該当箇所へ移動）</span></div>
				<div id="toc" data-toc="h3, h4" data-toc-container="#post-body"></div>
			</div>
EOM;
			// 記事ページなら
			if (is_single()) {
				// 広告を追記
				$add_string .= '[ad]';
			}

			// 最初のhタグの前の位置を取得
			$pos = $matches[0][0][1];
			// 最初のhタグの前に指定した文字列を挟む
			$content = substr($content, 0, $pos) . $add_string . substr($content, $pos);
		}
	}

	return $content;
});

// GETパラメータとして使用できるnameを追加（ABテスト用）
/*
add_filter('query_vars', function ($vars) {
	$vars[] = 'type';
	$vars[] = 'utm_expid';
	return $vars;
});
*/
