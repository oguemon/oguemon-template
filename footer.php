<?php
/**
 * ページ下部
 * @package oguemon
 */

// リンクのベースとなるURLを格納
$site_root_url = get_bloginfo('url');

// ソーシャルリンクの生成
$slg = new ShareLinkGenerator(get_bloginfo('url'), get_bloginfo('name'));
?>
	<a id="go-to-top" href="#">▲ トップへ戻る</a>
	<footer class="site-footer" role="contentinfo">
		<div class="wrapper wrapper-footer ">
			<div id="wrapper-footer-contents-list">
				<div class="footer-contents-list">
					<a id="footer-logo" href="<?=$site_root_url?>"></a>
					<div id="sns-btn-list">
						<a href="<?= $slg->getShareLinkTwitter() ?>"  target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-twitter"></span></a>
						<a href="<?= $slg->getShareLinkFacebook() ?>" target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-facebook"></span></a>
						<a href="<?= $slg->getShareLinkHatena() ?>"   target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-hatena"></span></a>
						<a href="<?= $slg->getShareLinkLine() ?>"     target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-line"></span></a>
						<a href="<?= $slg->getShareLinkPocket() ?>"   target="_blank" class="sns-btn-bg"><span class="sns-btn sns-btn-pocket"></span></a>
					</div>
				</div>
				<div class="footer-contents-list">
					<div class="title">ABOUT</div>
					<ul class="items">
						<li><a href="<?=$site_root_url?>/about/">このサイトについて</a></li>
						<!--<li><a href="<?=$site_root_url?>/profile/">プロフィール</a></li>-->
					</ul>
				</div>
				<div class="footer-contents-list">
					<div class="title">BLOG</div>
					<ul class="items">
						<li><a href="<?=$site_root_url?>/topic/study/linear-algebra/">線形代数入門</a></li>
						<li><a href="<?=$site_root_url?>/topic/knowledge/trivia/">豆知識</a></li>
						<li><a href="<?=$site_root_url?>/topic/saikoku33/">西国三十三ヶ所巡礼</a></li>
						<li><a href="<?=$site_root_url?>/topic/web/">Web開発</a></li>
						<li><a href="<?=$site_root_url?>/topic/blog/">おぐえもんの日記</a></li>
					</ul>
				</div>
				<div class="footer-contents-list">
					<div class="title">SERVICE</div>
					<ul class="items">
						<li><a href="<?=$site_root_url?>/tools/calc/mat-det-inv.html">行列式&逆行列式計算機</a></li>
						<li><a href="<?=$site_root_url?>/tax-calc/">簡単！手取り給料計算機</a></li>
						<li><a href="<?=$site_root_url?>/atashinchi/">タチバナ研｜あたしンち情報</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-contents-other-list">
				<a href="https://forms.gle/SDnHnzGLH5Y4ynzz6">お問い合わせ</a>
				・
				<a href="<?=$site_root_url?>/sitemap/">サイトマップ</a>
				・
				<a href="<?=$site_root_url?>/terms/">利用上の注意点</a>
			</div>
		</div><!-- .wrapper .wrapper-footer -->
		<div id="copyright">Copyright © 2016-2020 おぐえもん All Rights Reserved.</div>
	</footer><!-- .site-footer -->
</div><!-- end #container -->

<?php
wp_footer();
?>
</body>
</html>
