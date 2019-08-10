<?php
/**
 * Contains the post embed base template
 *
 * When a post is embedded in an iframe, this file is used to create the output
 * if the active theme does not include an embed.php template.
 *
 * @package WordPress
 * @subpackage oEmbed
 * @since 4.4.0
 */

if ( ! headers_sent() ) {
	header( 'X-WP-embed: true' );
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
	/**
	 * Prints scripts or data in the embed template <head> tag.
	 *
	 * @since 4.4.0
	 */
	do_action( 'embed_head' );
	?>
</head>
<body>
<?php
// 流し込む文字列
$item_url = '';
$title = '';
$thum_tag = '';

// 404チェック
if (!have_posts()) {
	$item_url = get_bloginfo('url');
	$title = '申し訳ございません。<br>当該ページは見つかりませんでした。';
	$thum_tag = '<img src="' . get_template_directory_uri() . '/img/404.svg">';
} else {
	// 記事情報を取得
	the_post();

	$item_url = get_permalink();
	$title = get_the_title();

	// サムネの有無に応じた処理分け
	if (has_post_thumbnail()) {
		$thum_tag = get_the_post_thumbnail();
	} else {
		$thum_tag = '<img src="' . get_template_directory_uri() . '/img/ogp.svg">';
	}
}
?>
<a href="<?= $item_url ?>" target="_top" class="embed-item">
	<div class="thumbnail"><?= $thum_tag ?></div>
	<div class="title"><?= $title ?></div>
	<div class="blogname"><?= get_bloginfo('name'); ?></div>
</a>
</body>
</html>
