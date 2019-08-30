<?php
/**
 * 固定ページ
 * @package oguemon
 */

get_header();
?>
<!-- サイトのメイン部分 -->
<div id="site-main">
	<div class="wrapper wrapper-main clearfix">
		<main id="site-content">
			<?php
			//記事を表示
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			} // End of the loop.
			?>
		</main><!-- #site-content -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper .wrapper-main -->
</div><!-- #site-main -->
<?php
//パンくずリスト
get_template_part( 'template-parts/content', 'breadcrumb' );

get_footer();
