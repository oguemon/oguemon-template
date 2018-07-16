<?php
/**
 * 個別ベージ用
 * @package oguemon
 */

get_header();
?>

<!-- サイトのメイン部分 -->
<div id="site-main">
	<div class="wrapper wrapper-main clearfix">	
		<main id="site-content">
			<?php
			// ABテスト用の条件文（beta版は広告非表示）
			if (get_query_var('type') != 'beta') {
			?>
				<!-- 【広告】スマホページ上部 -->
				<style type="text/css">
				@media (max-width: 640px) {
					.ad-h-item{width: 320px; height: 50px;}
				}
				</style>
				<ins class="adsbygoogle ad-h-item"
					data-full-width-responsive="false"
					data-ad-client="ca-pub-6941251424797111"
					data-ad-slot="7244203783"></ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			<?php
			}

			//パンくずリスト
			get_template_part( 'template-parts/content', 'breadcrumb' );
			//記事を表示
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'single' );
			} // End of the loop.
			?>
		</main><!-- #site-content -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper .wrapper-main -->
</div><!-- #site-main -->
<?php
include_once('template-parts/content-popup.php');
get_footer();
