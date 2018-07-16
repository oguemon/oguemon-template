<?php
/**
 * アーカイブページ
 * @package oguemon
 */

get_header();
?>

<!-- サイトのメイン部分 -->
<div id="site-main">
	<div class="wrapper wrapper-main clearfix">
		<main id="site-content">
			<?php
			//パンくずリスト
			get_template_part( 'template-parts/content', 'breadcrumb' );
			?>
			<div id="archive-header">
				<h1 class="title"><?= explode(':',get_the_archive_title(),2)[1] ?></h1><!-- 「カテゴリー：」は抜いてる -->
				<div class="meta">
					<p class="excerpt"><?= strip_tags( get_the_archive_description() ) ?></p>
				</div>
			</div>
			<?php
			if ( have_posts() ) {
				echo '<ul id="recent-posts" class="clearfix">';
				while ( have_posts() ){
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				}
				echo '</ul>';

				$args['prev_text'] = '<span class="nav-link-label">←</span>古い記事';
				$args['next_text'] = '新しい記事<span class="nav-link-label">→</span>';
				the_posts_navigation($args);
			}else{
				get_template_part( 'template-parts/content' ); 
			}
			?>
		</main><!-- #site-content -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper .wrapper-main -->
</div><!-- #site-main -->
<?php
get_footer();
