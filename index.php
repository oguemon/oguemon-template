<?php
/**
 * テンプレの最も根幹を為す部分
 * @package oguemon
 */

get_header();
?>
	<!-- サイトのメイン部分 -->
	<div id="site-main" class="content-home">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content" class="site-main" role="main">
				<div class="site-content-wrapper clearfix">
				<?php
				if ( have_posts() ) {
					if ( is_home() && ! is_front_page() ) { ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php
					}
					if ( is_home() && !is_paged() ) {
						get_template_part( 'template-parts/content', 'pickup' );
						echo '<p class="widget-title">最近の記事</p>';
					}
					echo '<ul id="recent-posts" class="post-list clearfix">';
					while (have_posts()) {
						the_post();
						get_template_part( 'template-parts/content');
					}
					echo '</ul>';

					$args['prev_text'] = '<span class="nav-link-label">←</span>古い記事';
					$args['next_text'] = '新しい記事<span class="nav-link-label">→</span>';
					the_posts_navigation($args);
				} else {
					get_template_part( 'template-parts/content' );
				}
				?>
				</div><!-- .site-content-wrapper .clearfix -->
			</main><!-- #site-content -->
			<?php 
			get_sidebar(); 
			?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
<?php
get_footer();
