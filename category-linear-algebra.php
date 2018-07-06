<?php
/**
 * アーカイブページ
* @package oguemon
*/

get_header();
?>

<!-- サイトのメイン部分 -->
<div id="site-main" class="content-home">
	<div class="wrapper wrapper-main clearfix">
		<main id="site-content" class="site-main" role="main">
			<div class="site-content-wrapper clearfix">
				<?php
				//パンくずリスト
				get_template_part( 'template-parts/content', 'breadcrumb' );
				?>
				<div id="post-header">
					<h1 id="post-title"><?= explode(':',get_the_archive_title(),2)[1] ?></h1><!-- 「カテゴリー：」は抜いてる -->
					<div id="post-meta">
						<p id="post-excerpt"><?= strip_tags( get_the_archive_description() ) ?></p>
					</div>
				</div>
<style>
#post-header {
    margin: 0 0 10px;
    padding: 20px;
    overflow: hidden;
    background: #00A5DE;
	color: #fff;
}
#post-header h1#post-title {
    margin: 0 0 10px;
    padding: 0 0 5px;
    font-size: 200%;
    border-bottom: 3px solid #fff;
}
#post-header p#post-excerpt {
    margin: 10px 0　0;
    color: #fff;
}

/*
 *  記事ヘッダー
 */
h3 {
	margin: 10px 0 0;
	padding: 8px 10px;
	color: #fff;
	font-size: 150%;
	background: #00A5DE;
}
.description {
	margin: 10px;
	color: #333;
	font-size: 100%;
    line-height: 1.8em;
}
.description a {
	color: #00A5DE;
}
.description a:hover {
	text-decoration: underline;
}
.description ul {
	margin: 5px 0 5px 20px;
	padding: 0;
}
.description li {
	margin: 5px 0;
	list-style-type: disc;
	list-style-position: outside;
}
.description .point-box {
    margin: 10px 0;
    padding: 10px 15px;
    background: #fffff0;
    border: 1px solid #00A5DE;
}
.description .point-box-caption {
    margin: -11px -16px 10px;
    padding: 2px 10px;
    background: #00A5DE;
    color: #fff;
    font-weight: bold;
}

/*
 *  記事一覧
 */
.article_list{
	margin: 0 0 10px;
}
.article_list a{
	padding: 8px 15px;
	color: #333;
    border-bottom: 1px solid #cccccc;
	display: block;
}
.article_list a:first-child{
    border-top: 1px solid #cccccc;
}
.article_list a dt{
	margin: 0 0 5px;
	color: #00A5DE;
	font-size: 120%;
	font-weight: bold;
}
.article_list a dd{
	color: #555;
	font-size: 90%;
}

@media (max-width: 640px){
	#post-header {
		margin: 0 0px 10px;
	}
}
</style>

<div class="description">
まだまだコンテンツを追加・更新中！！以下に並ぶタイトルをクリックすると該当記事へジャンプします。

	<div class="point-box" style="max-width: 220px;">
		<div class="point-box-caption">目次</div>
		<ul>
			<li><a href="#section-basic">基本編</a></li>
			<li><a href="#section-simultaneous">連立方程式編</a></li>
			<li><a href="#section-det">行列式編</a></li>
			<li><a href="#section-space-vector">空間ベクトル編</a></li>
			<li><a href="#section-linear-space">ベクトル空間編</a></li>
		</ul>
	</div>
</div>

<h3>行列式・逆行列 計算機</h3>
<div class="description">
	計算が超面倒な「行列式」と「逆行列」を瞬時に求めてくれるWebアプリを開発しました！<br>
	問題演習に役立つ計算ドリル機能も搭載！レポートや試験の対策にどうぞ！<br>
	<div class="point-box">
		<a href="https://oguemon.com/tools/calc/mat-det-inv.html" target="_blank">https://oguemon.com/tools/calc/mat-det-inv.html</a>
	</div>
</div>

<h3 id="section-basic">基本編</h3>
<div class="description">線形代数を語る上で必要不可欠な「行列」と呼ばれる概念や、その使い方について扱います。「線形代数って何？」って感じの方はここから読み進めましょう！</div>
<div class="article_list">
	<a href="https://oguemon.com/study/linear-algebra/hello-world/">
		<dt>線形代数って何？</dt>
		<dd>大学1年生から再履修のアホまでをターゲットに絞った線形代数の入門記事。そもそも線形代数って何？</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/mat-def/">
		<dt>行列の定義・用語<st>
		<dd>行列やベクトル周りの定義や用語について説明します！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/matrix-op/">
		<dt>行列の演算</dt>
		<dd>行列の演算方法について扱います。難関である行列同士の掛け算についてもしっかり説明します！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/matrix-regular/">
		<dt>正則行列と逆行列</dt>
		<dd>掛け合わせることで割り算のような効果をもたらす行列「逆行列」について扱います。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/matrix-notice/">
		<dt>注意すべき行列の性質</dt>
		<dd>掛け算の入れ替え禁止をはじめ、今までの数（スカラー）とルールが大きく異なる行列。そんな行列特有の性質についてもっと迫ります。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/matrix-block/">
		<dt>行列のブロック分割</dt>
		<dd>行列について考える上で、行列をカッティングして分割すると便利な時があります。ここでは行列の分割と、そのときの計算について扱います。</dd>
	</a>
</div>

<h3 id="section-simultaneous">連立方程式編</h3>
<div class="description">行列などを用いて連立方程式の解き方や、解の性質について紐解いていきます。「基本編」を十分理解してから読むべし（多分訳わからなくなるので^^;）</div>
<dl class="article_list">
<a href="https://oguemon.com/study/linear-algebra/elimination/">
	<dt>消去法と階段行列</dt>
		<dd>連立方程式の解き方の鉄板である「消去法」をおさらいした上で、それを行列で考えます。</dd></a>
		<a href="https://oguemon.com/study/linear-algebra/solution/"><dt>解の条件</dt>
	<dd>階段行列や階数を利用しながら、連立1次方程式が解を持つ条件について考えます。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/simultaneous-regular/">
		<dt>連立方程式と正則行列の関係</dt>
		<dd>正則行列の性質と、連立方程式の解との関連などについて扱います。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/linearly-independent/">
		<dt>1次独立と1次従属</dt>
		<dd>1次独立と1次従属の違いについて説明した上で、両者と階数rankAの関連について調べます。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/all-solution/">
		<dt>解を網羅する（基本解や特殊解）</dt>
		<dd>連立1次方程式の解は無数に生じることが多々あります。今回は、そんな場合も含めて解を網羅する方法について説明します。</dd>
	</a>
</dl>

<h3 id="section-det">行列式編</h3>
<div class="description">行列の性質を表す重要な指標である「行列式」について、その求め方や性質をみていきます。新しい概念が次々に現れますがめげないで！</div>
<dl class="article_list">
	<a href="https://oguemon.com/study/linear-algebra/det-what/">
		<dt>行列式って何？</dt>
		<dd>線形代数において重要な役割を果たす「行列式」について、その簡単な説明と、2×2行列・3×3行列に対する行列式の定義を扱います。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/permutation/">
		<dt>置換と巡回置換</dt>
		<dd>行列式の定義に必要な「置換」という概念についてねっとり説明していきます！！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/transposition/">
		<dt>互換の求め方と置換の符号</dt>
		<dd>置換の一つである「互換」というものを扱い、「置換の符号」の求め方に迫ります！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/det-definition/">
		<dt>行列式の定義</dt>
		<dd>全ての正方行列に当てはまる行列式の定義について扱います。具体的な例も示しました！</dd
	></a>
	<a href="https://oguemon.com/study/linear-algebra/det-feature/">
		<dt>行列式の性質</dt>
		<dd>行列式の定義を踏まえて、行列式の主な性質について見ていきます！！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/cofactor-expansion/">
		<dt>余因子と余因子展開</dt>
		<dd>逆行列の求め方の一つに「余因子」というものを活用する方法があります。今回は、「余因子」とは何なのかと、「余因子展開」の性質について扱っていきます。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/inverse-matrix/">
		<dt>逆行列の求め方を画像付きで解説！</dt>
		<dd>余因子を利用して逆行列を求めてみます！行列式と逆行列の間に潜む興味深い関係についても扱います。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/cramers-rule/">
		<dt>「クラメルの公式」で連立方程式を行列式で表す！</dt>
		<dd>連立方程式の解を行列式の割り算で表すことができるスタイリッシュな公式「クラメルの公式」について扱います。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/sol-rank-det/">
		<dt>連立方程式の解と行列式</dt>
		<dd>連立方程式の解について、行列式の値などと紐付けながら考えていきます。行列式編は今回がラスト！</dd>
	</a>
</dl>

<h3 id="section-space-vector">空間ベクトル編</h3>
<div class="description">「数字の並び」としてのベクトルを空間や平面の世界に連れて行くと、その性質を直感的に理解できます。要は高校時代のベクトルを振り返ろうというリバイバル企画です（笑）</div>
<dl class="article_list">
	<a href="https://oguemon.com/study/linear-algebra/highschool-vector/">
		<dt>高校のベクトルを基礎から復習！＋α</dt>
		<dd>高校までの「向きと大きさ」で定義されるベクトルの基本や計算方法を復習。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/inner-and-cross-product/">
		<dt>内積と外積を徹底解説！</dt>
		<dd>高校で習ったベクトルの「内積」を復習し、さらに大学で新しく登場する「外積」という概念にも触れます！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/coordinate-system/">
		<dt>3次元空間と位置ベクトルと座標系</dt>
		<dd>「座標×ベクトル」をテーマに掲げて、馴染み深い3次元座標をベクトルを使って作る方法について解説します。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/vector-figure/">
		<dt>ベクトルで色々な図形を表現する</dt>
		<dd>ベクトルを使って、直線や平面、そしてベクトルが作る図形の面積や体積を表現する方法について解説します。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/inner-cross-element/">
		<dt>内積と外積を成分で導く</dt>
		<dd>ベクトルの内積と外積をベクトルの成分を用いて求めます。</dd>
	</a>
</dl>

<h3 id="section-linear-space">線形空間(ベクトル空間)編</h3>
<div class="description">「数字の並び」としてのベクトルの性質と共通するものを「線形空間(ベクトル空間)」というカテゴリで括って、その性質を手っ取り早く考えます。</div>
<dl class="article_list">
	<a href="https://oguemon.com/study/linear-algebra/whats-linear-space/">
		<dt>ベクトル空間って何？</dt>
		<dd>線形空間（ベクトル空間）の定義や例について徹底解説！こんなものがベクトルとして扱えるなんて…</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/basis-dimension/">
		<dt>基底と次元と成分</dt>
		<dd>「基底」って何？基底をなすベクトルの数「次元」や基底の係数をまとめた「成分」についても学習。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/change-of-basis/">
		<dt>基底を変換する</dt>
		<dd>行列を使ってある基底から別の基底を作る方法、基底を変換した時の成分同士の関係性について。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/linear-subspace/">
		<dt>部分空間と生成系</dt>
		<dd>ある線形空間の中にある小さな線形空間（部分空間）の解説をします。</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/orthogonal/">
		<dt>ベクトルの内積と直交</dt>
		<dd>線形空間におけるベクトルの内積、大きさ、なす角の話をします。どれも高校までのベクトルとはその定義が大きく異なるので注意しましょう！</dd>
	</a>
	<a href="https://oguemon.com/study/linear-algebra/orthonormal-basis/">
		<dt>正規直交基底と直交行列</dt>
		<dd>正規直交基底とは何なのか、そしてその作り方などについて解説。正規直交基底の変換に使う行列の性質についても扱います。</dd>
	</a>
</dl>
			</div><!-- .site-content-wrapper .clearfix -->
			
		</main><!-- #site-content -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper .wrapper-main -->
</div><!-- #site-main -->
<?php
get_footer();
