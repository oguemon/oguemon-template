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
<?
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'embed', 'content' );
	endwhile;
else :
	get_template_part( 'embed', '404' );
endif;
?>
</body>
</html>
