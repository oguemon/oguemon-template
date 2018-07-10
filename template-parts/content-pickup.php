<?php
/**
 * おすすめ記事
 * @package oguemon
 */

// おすすめ記事を探す
$custom_loop = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 4,
	'order'          => 'DESC',
	'orderby'        => 'date',
	'tag' 		 	 => 'pickup'
));

if ( $custom_loop->have_posts() ) { 
	$i = 0;
	$m = 0;
?>
<ul id="pickup-posts" class="post-list clearfix">
<?php
while ( $custom_loop->have_posts() ){
	$custom_loop->the_post(); $i++;
	if ($i === 1) { 
?>
		<li class="post-pickup-main clearfix">
			<article>
				<?php if ( has_post_thumbnail() ){ ?>
				<div class="post-cover">
					<a href="<?= get_permalink() ?>"><?= get_the_post_thumbnail() ?></a>
				</div><!-- .post-cover-wrapper -->
				<?php } ?>
				<div class="post-preview">
					<h2 class="title-post"><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h2>
					<p class="post-excerpt"><?= get_the_excerpt() ?></p>
					<?php the_category();?>
					<p class="post-meta">
						<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
					</p>
				</div>
			</article>
		</li>
<?php
	} else {
		$m++;
?>
		<li class="post-pickup-sub">
			<article>
				<div class="post-cover">
				<?php
				if ( has_post_thumbnail() ){
					echo '<a href="' . get_the_permalink() . '">' . get_the_post_thumbnail() . '</a>';
				}
				?>
				</div>
				<div class="post-preview">
					<h2 class="title-post"><a href="<?= get_permalink(); ?>"><?= get_the_title() ?></a></h2>
					<p class="post-excerpt"><?= get_the_excerpt(); ?></p>
					<p class="post-meta">
						<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
					</p>
				</div>
			</article>
		</li>
<?php
	}
}
	wp_reset_postdata();
?>
</ul>
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
