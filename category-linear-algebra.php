<?php
/**
 * アーカイブページ
* @package oguemon
*/

get_header();
?>

<div class="category-linear-algebra">
	<div id="archive-header">
		<div class="wrapper">
			<div class="thum"><img src="<?= get_template_directory_uri() ?>/img/topic-linear-algebra.svg"></div>
			<h1 class="title"><span><?= explode(':',get_the_archive_title(),2)[1] ?></span></h1><!-- 「カテゴリー：」は抜いてる -->
			<div class="meta">
				<p class="excerpt"><?= strip_tags( get_the_archive_description() ) ?></p>
			</div>
			<div class="junle-list">
				<a href="#section-basic">#基本編</a>
				<a href="#section-simultaneous">#連立方程式編</a>
				<a href="#section-det">#行列式編</a>
				<a href="#section-space-vector">#空間ベクトル編</a>
				<a href="#section-linear-space">#ベクトル空間編</a>
				<a href="#section-eigenvalue">#固有値編</a>
			</div>
		</div>
	</div>

	<!-- サイトのメイン部分 -->
	<div id="site-main">
		<div class="wrapper wrapper-main clearfix">
			<main id="site-content">
	<h3><span>当サイトの本が出ます！</span></h3>
	<div class="description">
		「やさしい・見やすい・読みやすい」が特徴の線形代数入門書を書きました！<br>
		授業が分かるようになる。独学がはかどる。そんな一冊です！
	</div>
	<?= do_shortcode('[textbook]') ?>
	<a href="/study/linear-algebra/textbook/" target="_blank" class="button">本書のポイントをまとめました</a>
	<p class="center-link"><a href="http://www.pleiades-publishing.co.jp/download/" target="_blank" class="text-link">正誤表はこちら</a></p>

	<h3><span>行列式・逆行列 計算機</span></h3>
	<div class="description">
		計算が超面倒な「行列式」と「逆行列」を瞬時に求めてくれるWebアプリを開発しました！<br>
		問題演習に役立つ計算ドリル機能も搭載！レポートや試験の対策にどうぞ！<br>
		<a href="/tools/calc/mat-det-inv.html" target="_blank" class="button">便利な計算機を使ってみる</a>
	</div>

	<h3 id="section-basic"><span>試験対策用まとめ</span></h3>
	<div class="description">線形代数の講義をロクに受けず遊びまくってたあなたのために、テスト問題を解くために最低限欲しい知識をギュッとまとめました。</div>
	<div class="article_list">
		<a href="/study/linear-algebra/overview-1/">
			<dt>30分で分かる1年生の前期授業の要点</dt>
			<dd>行列とは何かから、行列式や逆行列の話まで、前期授業の期末試験範囲に合わせた要点のまとめ。</dd>
		</a>
	</div>

	<h3 id="section-basic"><span>基本編</span></h3>
	<div class="description">線形代数を語る上で必要不可欠な「行列」の概念や、その使い方について扱います。「線形代数って何？」って感じの方はとりあえずここから読み進めよう！</div>
	<div class="article_list">
		<a href="/study/linear-algebra/hello-world/">
			<dt>線形代数って何？</dt>
			<dd>大学1年生はもちろん、再履のアホでも分かる入門記事。そもそも線形代数って何？</dd>
		</a>
		<a href="/study/linear-algebra/mat-def/">
			<dt>行列の定義・用語<dt>
			<dd>行列やベクトル周りの定義や用語について説明します！</dd>
		</a>
		<a href="/study/linear-algebra/matrix-op/">
			<dt>行列の演算</dt>
			<dd>行列の足し算やスカラー倍などの演算を扱います。みんなが苦手な行列同士の掛け算も丁寧に解説！</dd>
		</a>
		<a href="/study/linear-algebra/matrix-regular/">
			<dt>正則行列と逆行列</dt>
			<dd>掛け合わせることで割り算のような効果をもたらす行列「逆行列」について解説。</dd>
		</a>
		<a href="/study/linear-algebra/matrix-notice/">
			<dt>注意すべき行列の性質</dt>
			<dd>「掛け算の入れ替え禁止」など、行列には不思議なルールがたくさん。そんな行列特有の性質に迫ります。</dd>
		</a>
		<a href="/study/linear-algebra/matrix-block/">
			<dt>行列のブロック分割</dt>
			<dd>行列の縦横を切って分割すると便利な時があります。行列の分割と、分割時の計算方法を解説。</dd>
		</a>
	</div>

	<h3 id="section-simultaneous"><span>連立方程式編</span></h3>
	<div class="description">行列を用いて連立方程式を解く方法や、連立方程式の解の性質について紐解きます。「基本編」を十分理解してから読むべし！（訳がわからなくなるので^^;）</div>
	<dl class="article_list">
	<a href="/study/linear-algebra/elimination/">
		<dt>消去法と階段行列</dt>
			<dd>連立方程式の解き方の鉄板である「消去法」をおさらいした上で、行列を使って再び考えます。</dd></a>
		<a href="/study/linear-algebra/solution/">
			<dt>解の条件</dt>
			<dd>階段行列や階数を利用しながら、連立1次方程式が解を持つ条件を考えます。</dd>
		</a>
		<a href="/study/linear-algebra/simultaneous-regular/">
			<dt>連立方程式と正則行列の関係</dt>
			<dd>正則行列の性質と、連立方程式の解との関連などについて解説。</dd>
		</a>
		<a href="/study/linear-algebra/linearly-independent/">
			<dt>1次独立と1次従属</dt>
			<dd>1次独立と1次従属の違いを説明した上で、両者と階数(rank)の関連を見てみます。</dd>
		</a>
		<a href="/study/linear-algebra/all-solution/">
			<dt>解を網羅する（基本解や特殊解）</dt>
			<dd>連立1次方程式の解を網羅する方法を解説。もちろん解が無数に生じる場合にも対応。</dd>
		</a>
	</dl>

	<h3 id="section-det"><span>行列式編</span></h3>
	<div class="description">行列の性質を表す重要な指標である「行列式」について、その求め方や性質を見ていきます。新しい概念が次々に現れますがめげないで！</div>
	<dl class="article_list">
		<a href="/study/linear-algebra/det-what/">
			<dt>行列式って何？</dt>
			<dd>線形代数の中で重要な役割を果たす行列式。その概要と、2×2行列＆3×3行列における行列式の定義を教授。</dd>
		</a>
		<a href="/study/linear-algebra/permutation/">
			<dt>置換と巡回置換</dt>
			<dd>行列式の定義に必要な「置換」という概念をねっとりと解説。</dd>
		</a>
		<a href="/study/linear-algebra/transposition/">
			<dt>互換の求め方と置換の符号</dt>
			<dd>置換の一種である「互換」を扱い、これを用いて「置換の符号」の求め方に迫ります。</dd>
		</a>
		<a href="/study/linear-algebra/det-definition/">
			<dt>行列式の定義</dt>
			<dd>「全ての」正方行列に使える行列式の定義を扱います。これで行列式求め放題！</dd
		></a>
		<a href="/study/linear-algebra/det-feature/">
			<dt>行列式の性質</dt>
			<dd>行列式の定義を踏まえて、行列式の重要な性質を見ていきます。</dd>
		</a>
		<a href="/study/linear-algebra/cofactor-expansion/">
			<dt>余因子と余因子展開</dt>
			<dd>「余因子」を使うことで逆行列が求められます。余因子とは何なのか、「余因子展開」の性質を解説。</dd>
		</a>
		<a href="/study/linear-algebra/inverse-matrix/">
			<dt>逆行列の求め方</dt>
			<dd>余因子を用いた逆行列の求め方を解説。行列式と逆行列の間に潜む興味深い関係も教えます。</dd>
		</a>
		<a href="/study/linear-algebra/cramers-rule/">
			<dt>クラメルの公式</dt>
			<dd>行列式の割り算を使って連立方程式の解を表すことができるスゴい公式「クラメルの公式」を解説。</dd>
		</a>
		<a href="/study/linear-algebra/sol-rank-det/">
			<dt>連立方程式の解と行列式</dt>
			<dd>連立方程式の解について、行列式の値などと紐付けながら考えます。行列式編、涙の最終回！</dd>
		</a>
	</dl>

	<h3 id="section-space-vector"><span>空間ベクトル編</span></h3>
	<div class="description">「数字の並び」としてのベクトルを空間や平面の世界に連れて行くと、ベクトルの性質を直感的に理解できます。要は高校時代のベクトルを振り返るリバイバル企画です（笑）</div>
	<dl class="article_list">
		<a href="/study/linear-algebra/highschool-vector/">
			<dt>高校のベクトルを基礎から復習！＋α</dt>
			<dd>高校までの「向きと大きさ」で定義されるベクトルの基本や計算方法を復習。</dd>
		</a>
		<a href="/study/linear-algebra/inner-and-cross-product/">
			<dt>内積と外積</dt>
			<dd>高校で習ったベクトルの「内積」を復習。大学で新しく登場する「外積」という概念にも触れます！</dd>
		</a>
		<a href="/study/linear-algebra/coordinate-system/">
			<dt>3次元空間と位置ベクトルと座標系</dt>
			<dd>「座標×ベクトル」をテーマに掲げ、ベクトルを使って馴染み深い3次元座標を作る方法を解説。</dd>
		</a>
		<a href="/study/linear-algebra/vector-figure/">
			<dt>ベクトルで色々な図形やサイズを表現</dt>
			<dd>ベクトルを使って、直線や平面、そしてベクトルが作る図形の面積や体積を表現する方法を解説。</dd>
		</a>
		<a href="/study/linear-algebra/inner-cross-element/">
			<dt>内積と外積を成分で導く</dt>
			<dd>ベクトルの内積と外積をベクトルの成分を用いて求めます。</dd>
		</a>
	</dl>

	<h3 id="section-linear-space"><span>線形空間(ベクトル空間)編</span></h3>
	<div class="description">「数字の並び」としてのベクトルの性質と共通するものを「線形空間(ベクトル空間)」というカテゴリで括って、その性質を抽象的に考えます。</div>
	<dl class="article_list">
		<a href="/study/linear-algebra/whats-linear-space/">
			<dt>ベクトル空間って何？</dt>
			<dd>線形空間（ベクトル空間）の定義や例を徹底解説。なんと無関係だと思ってたあるものがベクトルに。</dd>
		</a>
		<a href="/study/linear-algebra/basis-dimension/">
			<dt>基底と次元と成分</dt>
			<dd>「基底」って何？基底をなすベクトルの数「次元」や、基底の係数をまとめた「成分」とは何かを解説。</dd>
		</a>
		<a href="/study/linear-algebra/change-of-basis/">
			<dt>基底を変換する</dt>
			<dd>行列を使ってある基底から別の基底を作る方法、基底を変換した時の成分同士の関係性を解説。</dd>
		</a>
		<a href="/study/linear-algebra/linear-subspace/">
			<dt>部分空間と生成系</dt>
			<dd>ある線形空間の中にある小さな線形空間「部分空間」の解説をします。</dd>
		</a>
		<a href="/study/linear-algebra/orthogonal/">
			<dt>ベクトルの内積と直交</dt>
			<dd>線形空間におけるベクトルの内積、大きさ、なす角を解説。どの定義も高校までと大違い。</dd>
		</a>
		<a href="/study/linear-algebra/orthonormal-basis/">
			<dt>正規直交基底と直交行列</dt>
			<dd>正規直交基底とは何か、どうやって作るのかを解説。正規直交基底の変換に使う行列の性質も考えます。</dd>
		</a>
		<a href="/study/linear-algebra/gram-schmidt/">
			<dt>シュミットの直交化法</dt>
			<dd>複雑な数式が並ぶ「シュミットの直交化法」について、空間ベクトルを例にしてその方法を図解。</dd>
		</a>
	</dl>

	<h3 id="section-eigenvalue"><span>固有値編</span></h3>
	<div class="description">線形代数の応用の中でも特に重要な位置に立つ固有値と固有ベクトルを扱います。</div>
	<dl class="article_list">
		<a href="/study/linear-algebra/eigenvalue/">
			<dt>固有値と固有ベクトルって何？</dt>
			<dd>固有値や固有ベクトルとは何なのか。その意味や利用事例、簡単な行列を用いた具体例をまとめました。</dd>
		</a>
		<a href="/study/linear-algebra/characteristic-equation/">
			<dt>固有方程式で固有値問題を解く</dt>
			<dd>固有値と固有ベクトルを手っ取り早く求める方法を、簡単な具体例を添えて解説。</dd>
		</a>
		<a href="/study/linear-algebra/trace/">
			<dt>対角和の意味と固有値との関係</dt>
			<dd>対角和（トレース）と呼ばれる指標を扱うとともに、固有多項式というものを用いて、その驚きの性質を明らかに。</dd>
		</a>
		<a href="/study/linear-algebra/diagonalization/">
			<dt>行列の対角化と具体的な計算例</dt>
			<dd>行列の対角化って何？どこで便利？具体的な方法は？対角化の基本について1から解説。</dd>
		</a>
		<a href="/study/linear-algebra/diagonalization-symmetric-mat/">
			<dt>対称行列の対角化</dt>
			<dd>対称行列は絶対に対角化できます。対称行列の対角化に焦点を当て、その理由と性質を見ます。</dd>
		</a>
		<a href="/study/linear-algebra/triangularization/">
			<dt>行列の三角化</dt>
			<dd>正方行列の三角化について、その性質や方法などを具体例を用いて解説。</dd>
		</a>
		<a href="/study/linear-algebra/cayley-hamilton-theorem/">
			<dt>ケーリー・ハミルトンの定理</dt>
			<dd>昔の高校生がお世話になったこの定理。みんなが勘違いするポイントがあるので注意しよう。</dd>
		</a>
		<a href="/study/linear-algebra/frobenius-theorem/">
			<dt>フロベニウスの定理</dt>
			<dd>多項式関数を通した行列が持つ固有値の性質を述べたこの定理を具体的な計算例込みで解説。</dd>
		</a>
	</dl>
			</main><!-- #site-content -->
			<?php get_sidebar(); ?>
		</div><!-- .wrapper .wrapper-main -->
	</div><!-- #site-main -->
</div><!-- .linear-algebra -->
<?php
//パンくずリスト
get_template_part( 'template-parts/content', 'breadcrumb' );

get_footer();
