<?php
/**
 * テーマ全般に関する関数や定義を設定
 * @package oguemon
 */

/**
 * Word Pressに関する初期設定
 */
function oguemon_setup() {
	// フィードリンクの有効化（headerで投稿・コメントのRSSリンクを生成）
	add_theme_support( 'automatic-feed-links' );
	//プラグイン・テーマによるタイトル管理を可能に
	add_theme_support( 'title-tag' );
	//投稿にサムネイルを適用可能
	add_theme_support( 'post-thumbnails' );
	//サムネイルの一般的なサイズ
	set_post_thumbnail_size( 800, 450, array( 'center', 'center' ) );
	//HTML5を用いた記述を、第2引数で与えた項目に対して許可
	add_theme_support( 'html5', array('search-form','comment-form','gallery','caption'));
	//編集画面の「見たままモード」に適用するスタイルのファイルを指定
	add_editor_style( 'css/editor-style.css' );
}
//上の関数を、テーマの初期化後に実行
add_action( 'after_setup_theme', 'oguemon_setup' );

// 固定ページにおいて要旨フィールドをサポートさせる
add_post_type_support( 'page', 'excerpt' );

/**
 * headタグ内の不要なタグを除去
 */
// タイトルタグ生成
//remove_action( 'wp_head', '_wp_render_title_tag', 1);
// スクリプト書き出し
//remove_action( 'wp_head', 'wp_enqueue_scripts', 1);
// リソースヒント(名前解決など)
remove_action( 'wp_head', 'wp_resource_hints', 2);
// フィードリンク
remove_action( 'wp_head', 'feed_links', 2);
remove_action( 'wp_head', 'feed_links_extra', 3);
// 外部記事投稿系
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
// 関連ページ(次ページなど)のタグ表示
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// ローカライズなスタイルシートの読み込み
//remove_action( 'wp_head', 'locale_stylesheet');
// no-index
//remove_action( 'wp_head', 'noindex', 1);
// 絵文字対応
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles', 'print_emoji_styles');
// スタイルの表示（wp_print_stylesアクションの実行）
//remove_action( 'wp_head', 'wp_print_styles', 8);
// ヘッダにスクリプトを表示（wp_print_head_scriptsアクションの実行）
//remove_action( 'wp_head', 'wp_print_head_scripts', 9);
// WordPressのバージョン
remove_action( 'wp_head', 'wp_generator');
// rel="canonical"の出力
remove_action( 'wp_head', 'rel_canonical');
// 短縮リンク
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
// カスタムCSSの出力
//remove_action( 'wp_head', 'wp_custom_css_cb', 101);
// faviconなどの出力
//remove_action( 'wp_head', 'wp_site_icon', 99);


// wp-embedのスタイルを表示しない
remove_action('embed_head', 'print_embed_styles');
// wp-embedのスタイルを設定する
function oguemon_embed_style() {
	wp_enqueue_style('wp-embed-template-org', get_stylesheet_directory_uri() . '/css/embed.css');
}
add_filter('embed_head', 'oguemon_embed_style');

/**
 * RSSフィードのリンクを生成
 */
add_action('wp_head', function() {
	printf('<link rel="alternate" type="application/rss+xml" title="%s" href="%s">%s', get_bloginfo('name'), get_bloginfo('rss2_url'), "\n");
});

/**
 * タイトルタグの最適化
 */
// 区切り文字の変更
function custom_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'custom_title_separator' );

//タイトルタグの形式変更
function custom_title_parts($title) {

	// トップページでなければサイト説明文要素を削除
	if ( !is_front_page() ) {
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
}
add_filter( 'document_title_parts', 'custom_title_parts' );

/**
 * 画像などのコンテンツの最大幅を指定
 */
function oguemon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'oguemon_content_width', 720 );
}
//上の関数を、テーマの初期化後に実行(第3引数は優先順位-小さい程大きい)
add_action( 'after_setup_theme', 'oguemon_content_width', 0 );

/**
 * 記事の要旨（excerpt）の最大文字数を設定
 */
function oguemon_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'oguemon_excerpt_length', 999 );

/**
 * CSSやスクリプトなどの読み込み
 */
function oguemon_scripts() {
	//テーマのルート
	$theme_root = get_template_directory_uri();

	//CSSスタイルの追加
	wp_enqueue_style('oguemon-style', $theme_root . '/css/common.css', false, '3.0.180902.2', 'all');

	//デフォルトのJQuery読み込みを解除
	wp_deregister_script('jquery');
	//Google Adsenseの読み込み
	wp_enqueue_script('g-adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array(), false, false);
	//オリジナルのjavascriptの読み込み
	wp_enqueue_script('original', $theme_root . '/js/oguemon.js', array(), '3.0.200622.1', true);
}
add_action('wp_enqueue_scripts', 'oguemon_scripts' );

/**
 * スクリプトの非同期読み込みを実現
 */
function add_async_to_enqueue_script( $url ) {
	// JSファイルである
	if (strpos( $url, '.js' ))
	{
		//jqueryファイルでない
		if (strpos( $url, 'jquery.min.js' ) === false)
		{
			return $url . ' async charset="UTF-8"';
		}
	}
	// CSSファイルである
	else if (strpos( $url, '.css' ))
	{
		//return "$url' async charset='UTF-8";
	}

	return $url;
}
add_filter( 'clean_url', 'add_async_to_enqueue_script', 11, 1 );

/**
 *  記事ごとのアクセス数集計
 */
function setPostViews($postID) {
	if (is_single() && !is_admin_bar_showing()) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count == ''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}

/**
 * Quick Tagsの追加（投稿編集画面のタグボタン）
 */
function add_quicktags() {
?>
    <script type="text/javascript">
      QTags.addButton('h3','h3','<h3>','</h3>');
      QTags.addButton('h4','h4','<h4>','</h4>');
      QTags.addButton('u','u','<span style="text-decoration: underline;">','</span>');
      QTags.addButton('dl','dl','<dl>\n','\n</dl>');
      QTags.addButton('dt','dt','<dt>','</dt>');
      QTags.addButton('dd','dd','<dd>','</dd>');
      QTags.addButton('box','box','<div class="point-box">\n','\n</div>');
			QTags.addButton('bax-cap','bax cap','<div class="point-box-caption">','</div>');
			QTags.addButton('greet','greet','こんにちは、おぐえもん(<a href="https://twitter.com/oguemon_com" target="_blank">@oguemon_com</a>)です。');
    </script>
<?php
}
add_action( 'admin_print_footer_scripts', 'add_quicktags' );

/**
 * 画像にwidthとheightの属性を加えない
 */
function custom_attribute( $html ){
    // width height を削除する
    $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
    return $html;
}
add_filter( 'post_thumbnail_html', 'custom_attribute' );

/**
 * 画像をpタグで囲まない
 */
function remove_p_on_images($content){
    return preg_replace('/<p>(\s*)(<img .*>)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'remove_p_on_images');

/**
 * 記事本文の最初の見出しの前に目次と広告を適宜挟む
 */
function add_string_to_content($content) {

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
				$add_string .= <<< EOM
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="ca-pub-6941251424797111"
					 data-ad-slot="9452886211">
				</ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
EOM;
			}

			// 最初のhタグの前の位置を取得
			$pos = $matches[0][0][1];
			// 最初のhタグの前に指定した文字列を挟む
			$content = substr($content, 0, $pos) . $add_string . substr($content, $pos);
		}
	}

	return $content;
}
add_filter('the_content', 'add_string_to_content');

// GETパラメータとして使用できるnameを追加（ABテスト用）
/*
function add_query_vars_filter($vars) {
	$vars[] = 'type';
	$vars[] = 'utm_expid';
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );
*/

/**
* ページネーション出力関数
* $paged : 現在のページ
* $pages : 全ページ数
* $range : 最大いくつ表示するか
*/
function pagination( $pages, $paged, $range = 5) {

	$pages = (int) $pages;    //float型で渡ってくるので明示的に int型 へ
	$paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

	//表示テキスト
	$text_before  = "前へ";
	$text_next    = "次へ";

	// １ページの場合は何も表示せず終了
	if ($pages === 1) {
		return;
	}

	// 理想の左右数
	$range_left = (int) ($paged - (ceil($range / 2) - 1)); // 偶数なら半分-1
	$range_right = (int) ($paged + floor($range / 2));

	// 範囲がページ数以上(満タンor不足)
	if ($range >= $pages) {
		// 問答無用で全件表示
		$range_left = 1;
		$range_right = $pages;
	// 適宜調整が必要な場合
	} else {
		// 左の不足数(右向きスライド要因)
		$lack_left = - min($range_left - 1, 0);
		// 右の不足数(左向きスライド要因)
		$lack_right = - min($pages - $range_right, 0);
		// 表示領域のスライド量
		$slide = $lack_left - $lack_right;
		// 不足数に基づく左右の調整
		$range_left += $slide;
		$range_right += $slide;
	}

	echo '<div id="pagination">';

	// 「前へ」を表示する
	if ($paged > 1) {
		echo '<a class="prev" href="' . get_pagenum_link($paged - 1) . '">';
		echo     '<div class="arrow">';
		echo         '<div class="prev-arrow"></div>';
		echo         '<div class="jp">' . $text_before . '</div>';
		echo     '</div>';
		echo     '<span class="oguemon">OGUEM</span>';
		echo '</a>';
	} else {
		echo '<div class="prev">';
		echo     '<span class="oguemon">OGUEM</span>';
		echo '</div>';
	}

	// 中心部を表示する
	for ($i = $range_left; $i <= $range_right; $i++) {
		// $paged +- $range 以内であればページ番号を出力
		if ($paged === $i) {
			echo '<div class="pager current">';
			echo '<span class="oguemon">O</span>';
			echo '<span class="pagenum">' . $i . '</span>';
			echo '</div>';
		} else {
			echo '<a class="pager" href="' . get_pagenum_link($i) . '">';
			echo '<span class="oguemon">O</span>';
			echo '<span class="pagenum">' . $i . '</span>';
			echo '</a>';
		}
	}

	// 「次へ」 を表示する
	if ($paged < $pages) {
		echo '<a class="next" href="' . get_pagenum_link($paged + 1) . '">';
		echo     '<span class="oguemon">N</span>';
		echo     '<div class="arrow">';
		echo         '<div class="next-arrow"></div>';
		echo         '<div class="jp">' . $text_next . '</div>';
		echo     '</div>';
		echo '</a>';
	} else {
		echo '<div class="next">';
		echo     '<span class="oguemon">N</span>';
		echo '</div>';
	}

	echo '</div>';
}
