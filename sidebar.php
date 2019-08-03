<?php
/**
 * サイドバー
 * @package oguemon
 */
?>
<aside id="site-aside" role="complementary">
	<div class="title">プロフィール</div>
	<div class="contents profile">
		<div class="icon">
			<img src="https://oguemon.com/wordpress/wp-content/themes/oguemon/img/profile.jpg">
		</div>
		<div class="name"><?=get_the_author_meta('nickname', 1)?></div>
		<div class="bio"><?=get_the_author_meta('description', 1)?></div>
		<a class="contact twitter" href="https://twitter.com/oguemon_com" target="_blank"></a>
		<div class="contact mail"></div>

		<!-- ソーシャルボタン -->
<?php
//リンクの生成
$title = urlencode(get_bloginfo('name'));
$url   = urlencode(get_bloginfo('url'));
$link_twitter = 'http://twitter.com/share?url=' . $url . '&text=' . $title . '&related=oguemon_com';
$link_fb      = 'https://www.facebook.com/dialog/feed?app_id=1846956072250071&link='. $url;
$link_hatena  = 'http://b.hatena.ne.jp/entry/' . $url;
$link_line    = 'http://line.me/R/msg/text/?'. $url;
$link_pocket  = 'http://getpocket.com/edit?url=' . $url . '&title=' . $title;
?>
		<div id="sns-btn-list">
			<a href="<?= $link_twitter ?>" target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-twitter"></span></a>
			<a href="<?= $link_fb ?>"      target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-facebook"></span></a>
			<a href="<?= $link_hatena ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-hatena"></span></a>
			<a href="<?= $link_line ?>"    target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-line"></span></a>
			<a href="<?= $link_pocket ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-pocket"></span></a>
		</div>
	</div>

	<div class="title"><i class="category-icon"></i>カテゴリー</div>
	<?php
		$url = get_bloginfo('url');
	?>
	<ul id="category-list">
		<li><i class="category-icon study-icon"></i><a href="<?=$url?>/topic/study/linear-algebra/">線形代数入門</a></li>
		<li><i class="category-icon heart-icon"></i><a href="<?=$url?>/topic/knowledge/trivia/">豆知識</a></li>
		<li><i class="category-icon hike-icon"></i><a href="<?=$url?>/topic/saikoku33/">西国三十三ヶ所巡礼</a></li>
		<li><i class="category-icon code-icon"></i><a href="<?=$url?>/topic/web/">Web開発</a></li>
		<li><i class="category-icon dialy-icon"></i><a href="<?=$url?>/topic/blog/">おぐえもんの日記</a></li>
	</ul>

	<div class="title"><i class="rank-icon"></i>人気記事</div>
	<div id="popular">
		<?php
		//記事のPVをインクリメントする（function.php参照）
		setPostViews(get_the_ID());
		// ループ開始
		$rank_posts = get_posts(array(
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'posts_per_page' => 5,
			'order' => 'DESC'
		));
		$ranking = 0;
		foreach ( $rank_posts as $post ) {
			$ranking++;
			setup_postdata($post);
		?>
		<!-- サムネイルの表示 -->
		<a class="view-popular" href="<?= get_permalink() ?>">
			<div class="view-popular-thum">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail(array(80,60)); } ?>
			</div>
			<!-- タイトルの表示 -->
			<div class="view-popular-title"><?= get_the_title() ?></div>
		</a>
		<?php
		}
		wp_reset_postdata();
		?>
	</div>

	<!-- 【広告】サイドバー（PC） -->
	<ins class="adsbygoogle ad-s-item"
		 style="width: 300px; height: 600px;"
		 data-ad-client="ca-pub-6941251424797111"
		 data-ad-slot="4920179380"></ins>
	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</aside><!-- #site-aside -->
