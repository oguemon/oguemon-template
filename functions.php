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
	set_post_thumbnail_size( 640, 480, true );
	//画像サイズの定義（トップページのピックアップ用サムネ）
	//add_image_size( 'oguemon-large-thumbnail', 660, 320, true );//余剰分は切取
	//add_image_size( 'oguemon-small-thumbnail', 230, 170, true );//余剰分は切取
	//メニュー（wp_nav_menu()）とその説明を登録する
	register_nav_menus( array(
		'primary'	=> 'メインメニュー',
		'footer'	=> 'フッターメニュー',
		'sp-right'  => 'スマホ右メニュー'
	) );
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
	wp_enqueue_style('oguemon-style', $theme_root . '/css/common.css', false, '1.0.180710', 'all');

	//デフォルトのJQuery読み込みを解除
	wp_deregister_script('jquery');
	//最新のJQueryを読み込み
	wp_enqueue_script('jquery-alt', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), '2.2.4', true);
	//Anime.jsの読み込み
	wp_enqueue_script('animejs', $theme_root . '/js/anime.min.js', array(), false, true);
	//toc.js(目次生成)の読み込み
	wp_enqueue_script('tocjs', $theme_root . '/js/toc.min.js', array(), false, true);
	//Google Adsenseの読み込み
	wp_enqueue_script('g-adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array(), false, false);
	//オリジナルのjavascriptの読み込み
	wp_enqueue_script('original', $theme_root . '/js/oguemon.js', array('jquery-alt'), '1.0.180709', true);
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
			return "$url' async charset='UTF-8";
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
    </script>
<?php
}
add_action( 'admin_print_footer_scripts', 'add_quicktags' );

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
				<div id="toc-box-caption">目次<span class="description">（クリックで該当箇所へ移動）</span></div>
				<div id="toc"></div>
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