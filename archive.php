<?php
/**
 * アーカイブページ
 * @package oguemon
 */

get_header();
?>

<div class="category-<?= get_query_var('category_name'); ?>">
	<div id="archive-header">
		<div class="wrapper wrapper-archive-header">
			<h1 class="title"><?= explode(':',get_the_archive_title(),2)[1] ?></h1><!-- 「カテゴリー：」は抜いてる -->
			<div class="meta">
				<p class="excerpt"><?= strip_tags( get_the_archive_description() ) ?></p>
			</div>
		</div>
	</div>

	<!-- サイトのメイン部分 -->
	<div id="site-main" class="bg-blue-shallow">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content">
				<?php
				//パンくずリスト
				//get_template_part( 'template-parts/content', 'breadcrumb' );
				?>
				<?php
				if ( have_posts() ) {
					echo '<div id="recent-posts" class="clearfix">';
					$article_count = 0;
					while ( have_posts() ){
						$article_count++;
						the_post();
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

					/* ページネーションの表示 */
					if (function_exists('pagination')) {
						pagination($wp_query->max_num_pages, get_query_var('paged'));
					}
				}
				?>
			</main><!-- #site-content -->
			<?php get_sidebar(); ?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
</div>
<?php
get_footer();
