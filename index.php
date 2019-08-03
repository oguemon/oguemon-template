<?php
/**
 * テンプレの最も根幹を為す部分
 * @package oguemon
 */

get_header();
?>
	<!-- サイトのメイン部分 -->
	<div id="site-main">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content">
				<?php
				// 記事があるなら(基本ある笑)
				if ( have_posts() ) {
					if ( is_home() && ! is_front_page() ) { ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php
					}
					if ( is_home() && !is_paged() ) {
						get_template_part( 'template-parts/content', 'pickup' );
						echo '<div id="latest-posts-header">最近の記事</div>';
					}
					echo '<ul id="recent-posts" class="clearfix">';
					while (have_posts()) {
						the_post();
						get_template_part( 'template-parts/content');
					}
					echo '</ul>';

					$args['prev_text'] = '←古い記事';
					$args['next_text'] = '新しい記事→';
					the_posts_navigation($args);
				} else {
					get_template_part( 'template-parts/content' );
				}
				?>
			</main><!-- #site-content -->
			<?php
			get_sidebar();
			?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
<?php
get_footer();
