<?php
/**
 * テンプレの最も根幹を為す部分
 * @package oguemon
 */

get_header();
?>
	<div id="archive-header">
		<div class="wrapper wrapper-archive-header">
			<h1 class="title">サイト内検索</h1>
			<div class="meta">
				<p class="excerpt">あらゆるワードの関連記事を検索できます。</p>
			</div>
		</div>
	</div>

	<!-- サイトのメイン部分 -->
	<div id="site-main">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content">
				<!-- パンくずリスト
				<ul id="breadcrumb">
					<li><a href="<?= get_bloginfo('url') ?>"><?= get_bloginfo('name') ?></a></li>
					<li>></li>
					<li>サイト内検索</li>
				</ul>
				-->
				<!-- 検索窓 -->
				<div id="article-search-area">
					<div class="search-box">
						<form method="get" action="<?= get_bloginfo('url');?>">
							<table>
								<tr>
									<td>
										<input class="search-input" type="text" name="s" value="<?= esc_html(get_search_query( false )) ?>">
									</td>
									<td>
										<button class="search-submit">
											<svg width="26" height="26" viewBox="0 0 13 13"><title>検索</title><path d="m4.8495 7.8226c0.82666 0 1.5262-0.29146 2.0985-0.87438 0.57232-0.58292 0.86378-1.2877 0.87438-2.1144 0.010599-0.82666-0.28086-1.5262-0.87438-2.0985-0.59352-0.57232-1.293-0.86378-2.0985-0.87438-0.8055-0.010599-1.5103 0.28086-2.1144 0.87438-0.60414 0.59352-0.8956 1.293-0.87438 2.0985 0.021197 0.8055 0.31266 1.5103 0.87438 2.1144 0.56172 0.60414 1.2665 0.8956 2.1144 0.87438zm4.4695 0.2115 3.681 3.6819-1.259 1.284-3.6817-3.7 0.0019784-0.69479-0.090043-0.098846c-0.87973 0.76087-1.92 1.1413-3.1207 1.1413-1.3553 0-2.5025-0.46363-3.4417-1.3909s-1.4088-2.0686-1.4088-3.4239c0-1.3553 0.4696-2.4966 1.4088-3.4239 0.9392-0.92727 2.0864-1.3969 3.4417-1.4088 1.3553-0.011889 2.4906 0.45771 3.406 1.4088 0.9154 0.95107 1.379 2.0924 1.3909 3.4239 0 1.2126-0.38043 2.2588-1.1413 3.1385l0.098834 0.090049z"></path></svg>
										</button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
				<!-- 検索結果 -->
				<script>
					(function() {
						var cx = '007526837167341457552:r6fbpgyb66s';
						var gcse = document.createElement('script');
						gcse.type = 'text/javascript';
						gcse.async = true;
						gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(gcse, s);
					})();
				</script>
				<gcse:searchresults-only></gcse:searchresults-only>
			</main><!-- #site-content -->
			<?php
			get_sidebar();
			?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
<?php
get_footer();
