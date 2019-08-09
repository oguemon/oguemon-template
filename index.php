<?php
/**
 * テンプレの最も根幹を為す部分
 * @package oguemon
 */

get_header();
?>
	<!-- サイトのトップ画像 -->
	<div id="top-img">

	</div>
	<!-- サイトのメイン部分 -->
	<div id="site-main" class="bg-blue-shallow">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content">
				<?php
				// 記事があるなら(基本ある笑)
				if ( have_posts() ) {
					// ホームページだけど、フロントページでない
					if ( is_home() && ! is_front_page() ) {
						echo '<header>';
						echo '<h1 class="page-title screen-reader-text">';
						single_post_title();
						echo '</h1>';
						echo '</header>';
					}
					// フロントページだけど
					if ( is_home() && !is_paged() ) {
						get_template_part( 'template-parts/content', 'pickup' );
						echo '<div id="latest-posts-header">最近の記事</div>';
					}
					echo '<div id="recent-posts" class="clearfix">';
					$article_count = 0;
					while (have_posts()) {
						the_post();
						$article_count++;
					?>
						<a class="post-item <?php if($article_count == 1) echo 'first-article'; ?> clearfix" href="<?= get_permalink() ?>">
							<div class="post-cover">
							<?php if ( has_post_thumbnail() ) { ?>
								<img src="<?= get_the_post_thumbnail_url(); ?>">
							<?php } ?>
							</div><!-- .post-cover-wrapper -->
							<div class="post-preview">
								<h2 class="title-post"><?= get_the_title() ?></h2>
								<p class="post-meta">
									<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
								</p>
							</div>
						</a>
				<?php
					}
					echo '</div>';

					$args['prev_text'] = '←古い記事';
					$args['next_text'] = '新しい記事→';
					the_posts_navigation($args);
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
