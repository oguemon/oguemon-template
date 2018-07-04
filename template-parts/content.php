<?php
/**
 * 投稿を表示するためのテンプレパーツ
 * @package oguemon
 */
?>
<li class="post-item clearfix">
	<article>
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-cover">
			<a href="<?= get_permalink() ?>"><?php the_post_thumbnail(); ?></a>
		</div><!-- .post-cover-wrapper -->
		<?php } ?>
		<div class="post-preview">
			<?php the_category();?>
			<h2 class="title-post"><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h2>
			<p class="post-excerpt"><?= get_the_excerpt() ?></p>
			<p class="post-meta">
			<span class="posted-on"><span class="icon-published"></span><time><?= get_the_date() ?></time></span>
			</p>
		</div>
	</article>
</li>
