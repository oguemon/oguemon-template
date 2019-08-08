<?php
/**
 * おすすめ記事
 * @package oguemon
 */

// おすすめ記事を探す
$custom_loop = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 5,
	'order'          => 'DESC',
	'orderby'        => 'date',
	'tag' 		 	 => 'pickup'
));

if ( $custom_loop->have_posts() ) {
	$i = 0;
	$m = 0;
?>
<div id="pickup-posts" class="post-list clearfix">
<?php
	// 1列目記事
	//$custom_loop->the_post();
?>
<!--
		<div class="post-pickup-main clearfix">
			<article>
				<?php if ( has_post_thumbnail() ){ ?>
				<div class="post-cover">
					<a href="<?= get_permalink() ?>"><?= get_the_post_thumbnail() ?></a>
				</div>
				<?php } ?>
				<div class="post-preview">
					<h2 class="title-post"><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h2>
					<?php the_category();?>
					<p class="post-meta">
						<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
					</p>
				</div>
			</article>
		</div>
	-->
	<div class="post-pickup-sub-list" class="post-list clearfix">
<?php
	// 2列目記事
	while ( $custom_loop->have_posts() ){
		$custom_loop->the_post();
?>
		<div class="post-puckup-sub-wrapper <?php if($i >= 2) echo 'second-line';?>">
			<a class="post-pickup-sub" href="<?= get_permalink(); ?>">
				<div class="post-cover">
				<?php
				if ( has_post_thumbnail() ){
					echo get_the_post_thumbnail();
				}
				?>
				</div>
				<div class="post-preview">
					<h2 class="title-post <?php if($i >= 2) echo 'second-line';?>"><?= get_the_title() ?></h2>
					<p class="post-meta">
						<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
					</p>
				</div>
			</a>
		</div>
<?php
		$i++;
	}
	wp_reset_postdata();
?>
	</div>
</div>
<?php
}else{
	if ( current_user_can( 'publish_posts' ) && is_customize_preview() ) {
?>
		<div id="error-posts">
			<div class="page-intro">
				<h1 class="title-page">おすすめ記事がありません！！</h1>
				<div class="taxonomy-description">
					<p>これはあなたの「pickup」記事が表示される場所です。</p>
				</div>
			</div>
		</div>
<?php
	}
}
