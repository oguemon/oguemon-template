<?php
/**
 * サイドバー
 * @package oguemon
 */
?>
<aside id="site-aside" class="<?php if(is_home() && !is_paged()) echo 'front-page';?>" role="complementary">
	<div class="contents profile">
		<div class="icon">
			<img src="/wordpress/wp-content/themes/oguemon/img/profile.jpg">
		</div>
		<div class="name"><?=get_the_author_meta('nickname', 1)?></div>
		<div class="bio"><?=get_the_author_meta('description', 1)?></div>
		<a class="contact twitter" href="https://twitter.com/oguemon_com" target="_blank"></a>
		<a class="contact instagram" href="https://www.instagram.com/oguemon_com/" target="_blank"></a>
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
	<div class="category-list">
		<a href="/topic/study/linear-algebra/">
			<i class="icon study-icon"></i>
			<span>線形代数入門</span>
		</a>
		<a href="/topic/knowledge/trivia/">
			<i class="icon heart-icon"></i>
			<span>豆知識</span>
		</a>
		<a href="/topic/saikoku33/">
			<i class="icon hike-icon"></i>
			<span>西国三十三ヶ所巡礼</span>
		</a>
		<a href="/topic/web/">
			<i class="icon code-icon"></i>
			<span>Web開発</span>
		</a>
		<a href="/topic/blog/">
			<i class="icon dialy-icon"></i>
			<span>おぐえもんの日記</span>
		</a>
	</div>

	<div class="title"><i class="rank-icon"></i>人気記事</div>
	<div id="popular">
		<?php
		// ループ開始
		$ranking_slugs = json_decode(file_get_contents(__DIR__ . '/ranking.json'));
		foreach ($ranking_slugs as $ranking_slug) {
			$custom_loop = new WP_Query([
				'name' => $ranking_slug,
				'posts_per_page' => '1',
			]);
			while ($custom_loop->have_posts()) {
				$custom_loop->the_post();
		?>
				<!-- サムネイルの表示 -->
				<a class="view-popular" href="<?= get_permalink() ?>">
					<div class="view-popular-thum">
						<?php if (has_post_thumbnail()) { the_post_thumbnail(); } ?>
					</div>
					<!-- タイトルの表示 -->
					<div class="view-popular-title"><?= get_the_title() ?></div>
				</a>
		<?php
			}
			wp_reset_postdata();
		}
		?>
	</div>

	<div class="title"><i class="recent-icon"></i>最新記事</div>
		<?php
		// ループ開始
		$custom_loop = new WP_Query([
			'posts_per_page' => '8',
		]);
		while ($custom_loop->have_posts()) {
			$custom_loop->the_post();
		?>
			<!-- サムネイルの表示 -->
			<a class="view-recent" href="<?= get_permalink() ?>">
				<div class="view-recent-thum">
					<?php if (has_post_thumbnail()) { the_post_thumbnail(); } ?>
				</div>
				<div class="view-recent-info">
					<!-- タイトルの表示 -->
					<div class="view-recent-title"><?= get_the_title() ?></div>
					<!-- 日付の表示 -->
					<div class="view-recent-date"><?= get_the_date() ?></div>
				</div>
			</a>
		<?php
		}
		wp_reset_postdata();
		?>

	<!-- 【広告】サイドバー（PC） -->
	<ins class="adsbygoogle ad-s-item"
		style="display:block"
		data-ad-client="ca-pub-6941251424797111"
		data-ad-slot="4920179380"
		data-ad-format="auto"></ins>
	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</aside><!-- #site-aside -->
