<?php
/**
 * アーカイブページ
 * @package oguemon
 */

get_header();
?>

<div class="category-<?= get_query_var('category_name'); ?>">
	<div id="header-404">
		<div class="wrapper wrapper-404-header">
      <div class="error-code">404</div>
      <div class="error-msg">NOT FOUND</div>
		</div>
	</div>

	<!-- サイトのメイン部分 -->
	<div id="site-main" class="bg-blue-shallow">
		<div class="wrapper wrapper-main clearfix">
        <div id="title-404">お探しのページは見つかりませんでした。</div>
        <div id="description-404">
          URLの入力を誤っているか、記事が移転または削除された可能性があります。<br>
          お手数ですが、URLを今一度ご確認の上で再度アクセスしていただき、それでもアクセスできなかった場合は、トップページより記事をお探しください。
        </div>
        <a class="button" href="<?= get_bloginfo('url') ?>">トップページへ戻る</a>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
</div>
<?php
get_footer();
