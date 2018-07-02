<?php
/**
 * サイドバー
 * @package oguemon
 */
?>
<aside id="site-aside" role="complementary">
	<div class="widget-title">メインコンテンツ</div>
	<div class="widget-contents">
		<div class="side-banner"><a href="https://oguemon.com/topic/study/linear-algebra/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-study-linear-algebra.png"></a></div>
		<div class="side-banner"><a href="https://oguemon.com/topic/knowledge/trivia/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-knowledge-trivia.png"></a></div>
		<div class="side-banner"><a href="https://oguemon.com/topic/knowledge/is/"><img src="<?= get_bloginfo('template_directory') ?>/img/side-knowledge-is.png"></a></div>
	</div>

	<div class="widget-title">プロフィール</div>
	<div class="widget-contents widget-profile">
		<img src="https://oguemon.com/wordpress/wp-content/uploads/2017/02/profile.png" width="160px">
		<p><strong>著者：おぐえもん</strong></p>
		<p>大学に通っていながらJKの肩書きを持つ情報系（=JK）大学生。</p>
		<p>Web開発やDTPに僅かな経験があるほか、渋谷系をはじめとする邦楽などに興味を持ってるよ。</p>
		<p><a href="https://twitter.com/intent/follow?screen_name=oguemon_com" target="_blank">
			<img src="<?= get_bloginfo('template_directory') ?>/img/twitter.png" width="240px" style="border-radius: 8px;">
		</a></p>
		【お問い合わせ】<br>
		<img src="https://oguemon.com/wordpress/wp-content/uploads/2017/02/mail.png" width="160px">
		
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
		<div class="sns-btn-list-sidebar">
			<a href="<?= $link_twitter ?>" target="_blank"><div class="sns-btn-side sns-btn-twitter-side"></div></a>
			<a href="<?= $link_fb ?>" target="_blank"><div class="sns-btn-side sns-btn-facebook-side"></div></a>
			<a href="<?= $link_gplus ?>" target="_blank"><div class="sns-btn-side sns-btn-gplus-side"></div></a>
			<a href="<?= $link_hatena ?>" target="_blank"><div class="sns-btn-side sns-btn-hatena-side"></div></a>
			<a href="<?= $link_line ?>" target="_blank"><div class="sns-btn-side sns-btn-line-side"></div></a>
			<a href="<?= $link_pocket ?>" target="_blank"><div class="sns-btn-side sns-btn-pocket-side"></div></a>
		</div>
	</div>
	
	<div class="widget-title">人気記事</div>
	<div class="widget-contents">
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