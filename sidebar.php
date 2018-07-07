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
		<div class="name">おぐえもん</div>
		<div class="bio">大学に通う情報系の大学生です。WebプログラミングやDTPに僅かな経験があるほか、渋谷系をはじめとする邦楽などに興味を持ってます。</div>
		<a class="contact twitter" href="https://twitter.com/oguemon_com" target="_blank"></a>
		<div class="contact mail"></div>

		<!-- ソーシャルボタン -->
<?php
//リンクの生成
$title = urlencode(get_bloginfo('name'));
$url   = urlencode(get_bloginfo('url'));
$link_twitter = 'http://twitter.com/share?url=' . $url . '&text=' . $title . '&related=oguemon_com';
$link_fb      = 'https://www.facebook.com/dialog/feed?app_id=1846956072250071&link='. $url;
$link_gplus   = 'https://plus.google.com/share?url=' . $url;
$link_hatena  = 'http://b.hatena.ne.jp/entry/' . $url;
$link_line    = 'http://line.me/R/msg/text/?'. $url;
$link_pocket  = 'http://getpocket.com/edit?url=' . $url . '&title=' . $title;
?>
		<div id="sns-btn-list-sidebar">
			<a href="<?= $link_twitter ?>" target="_blank" class="sns-btn-side sns-btn-twitter"></a>
			<a href="<?= $link_fb ?>"      target="_blank" class="sns-btn-side sns-btn-facebook"></a>
			<a href="<?= $link_gplus ?>"   target="_blank" class="sns-btn-side sns-btn-gplus"></a>
			<a href="<?= $link_hatena ?>"  target="_blank" class="sns-btn-side sns-btn-hatena"></a>
			<a href="<?= $link_line ?>"    target="_blank" class="sns-btn-side sns-btn-line"></a>
			<a href="<?= $link_pocket ?>"  target="_blank" class="sns-btn-side sns-btn-pocket"></a>
		</div>
	</div>

	<div class="title">メインコンテンツ</div>
	<div class="contents">
		<div class="side-banner"><a href="https://oguemon.com/topic/study/linear-algebra/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-study-linear-algebra.png"></a></div>
		<div class="side-banner"><a href="https://oguemon.com/topic/knowledge/trivia/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-knowledge-trivia.png"></a></div>
		<div class="side-banner"><a href="https://oguemon.com/topic/knowledge/is/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-knowledge-is.png"></a></div>
	</div>

	<div class="title">人気記事</div>
	<div class="contents">
		<?php
		//記事のPVをインクリメントする（function.php参照）
		setPostViews(get_the_ID());
		// ループ開始
		query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=5&order=DESC');
		$ranking = 0;
		while(have_posts()) {
			$ranking++;
			the_post();
		?>
		<!-- サムネイルの表示 -->
		<div class="view-ranking clearfix">
			<div class="view-ranking-num rank-<?= $ranking ?>"><?= $ranking ?></div>
			<div class="view-ranking-thum">
				<a href="<?= get_permalink() ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(array(80,60)); } ?></a>
			</div>
			<!-- タイトルの表示 -->
			<div class="view-ranking-title">
				<a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
			</div>
		</div>
		<?php
		}
		?>
	</div>
		
	<div class="ad-side-large">
		<!-- 【広告】サイドバー（PC） -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:600px"
		     data-ad-client="ca-pub-6941251424797111"
		     data-ad-slot="4920179380"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
	</div>
</aside><!-- #site-aside -->