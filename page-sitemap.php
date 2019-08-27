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
			<h1 class="title">サイトマップ</h1>
			<div class="meta">
				<p class="excerpt">当サイトの記事一覧</p>
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
				<div id="sitemap">
					<h3>サイト記事</h3>
					<ul>
						<li><a href="">トップページ</a></li>
						<li><a href="../about/">このサイトについて</a></li>
						<li><a href="../profile/">プロフィール</a></li>
						<li><a href="../services/">自作サービス一覧</a></li>
						<li><a href="../sitemap/">サイトマップ</a></li>
						<li><a href="../terms/">ご利用上の注意点</a></li>
					</ul>

					<h3>自作サービス</h3>
					<ul>
						<li><a href="../tools/calc/mat-det-inv.html">行列式&逆行列式計算機</a></li>
						<li><a href="../tax-calc/">簡単！手取り給料計算機</a></li>
					</ul>


					<h3>ブログ記事</h3>
					<?php
					// カテゴリ一覧
					$category_list = array(
						'linear-algebra',
						'saikoku33',
						'trivia',
						'web',
						'is',
						'blog'
					);
					foreach ($category_list as $category) {
						query_posts('category_name=' . $category . '&posts_per_page=-1');
						echo '<h4>' . explode(':',get_the_archive_title(),2)[1] . '</h4>';
						if (have_posts()) {
								echo '<ol reversed>';
								while (have_posts()) {
										the_post();
										echo '<li class="in-category"><a href="' . get_permalink() . '">' . get_the_title() . '</a>（' . get_the_date() . '）</li>';
								}
								wp_reset_query();
								echo '</ol>';
						}
					}
					?>
				</div>
			</main><!-- #site-content -->
			<?php get_sidebar(); ?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
</div>
<?php
get_footer();
