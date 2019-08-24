'use strict';

// HTMLが読まれたら実行
$(function () {
	/*
	 * スマホの右上のメニューボタンを押した時の処理
	 */
	// 変数宣言
	const btn_menu = $('#sp-menu-right-btn');
	const transparent = $('#transparent');
	const menu_area = $('#sp-right-menu-area');
	const container = $('#container');
	// 初期化）メニューを非表示
	menu_area.css('display', 'none');
	// 初期化）透明レイヤー（右上メニュー押下時に現れる戻るトリガー用）を非表示
	transparent.css('display', 'none');
	// ボタンがクリックされたら
	btn_menu.on('click', function () {
		// スライドを実行
		container.toggleClass('side-open');
		//横に開いていたら
		if (container.hasClass('side-open')) {
			btn_menu.css('transform', 'rotate(180deg)');
			transparent.css('display', 'block');
			menu_area.css('display', 'block');
		} else {
			btn_menu.css('transform', 'rotate(0)');
			transparent.css('display', 'none');
			setTimeout(function () {
				menu_area.css('display', 'none');
			}, 300);
		}
	});
	// 透明レイヤーがクリックされたら
	transparent.on('click', function () {
		// スライドを実行（戻る方向に）
		container.removeClass('side-open');
		btn_menu.css('transform', 'rotate(0)');
		transparent.css('display', 'none');
		setTimeout(function () {
			menu_area.css('display', 'none');
		}, 300);
	});

	/*
	 * スマホの右上の検索ボタンを押すとスライド
	 */
	// 変数宣言
	const btn_search = $('#sp-search-btn');
	const popup_search = $('#sp-search-area');
	// ボタンがクリックされたら
	btn_search.on('click', function () {
		// スライドを実行
		popup_search.toggleClass('open');
		// 検索窓が出ていたら
		if (popup_search.hasClass('open')) {
			btn_search.css('transform', 'rotate(180deg)');
		} else {
			btn_search.css('transform', 'rotate(0)');
		}
	});

	/*
	 * #で始まるアンカーをクリックした場合にスムーズスクロール
	 */
	// リンクがクリックされたら
	 $('a[href^="#"]').click(function () {
		const speed = 400; // ミリ秒
		const href = $(this).attr("href");
		const target = $((href == "#" || href == "")? 'html' : href);
		const position = target.offset().top - 10; //ゆとりを持たせる
		// スクロールを実行
		$('body,html').animate({ scrollTop: position }, speed, 'swing');
	});

	/*
	 *  トップ画像を時間おきに変える
	 */
	// 変数宣言
	const toggleTopImgInterval = 5000; // ミリ秒
	const topImgClassList = [
		{
			class: 'calc',
			url: './tools/calc/mat-det-inv.html',
		},
		{
			class: 'salary',
			url: './tax-calc/',
		},
	];
	const top_img = $('#top-img');
	let topImgCurrentClassNo = 0;
	// 指定時間おきに実行する処理
	setInterval(function () {
		// 次の表示番号を導出
		topImgCurrentClassNo++;
		topImgCurrentClassNo %= topImgClassList.length;
		// クラスとリンク先を切り替え
		top_img.removeClass();
		top_img.addClass(topImgClassList[topImgCurrentClassNo].class);
		top_img.attr('href', topImgClassList[topImgCurrentClassNo].url);
	}, toggleTopImgInterval);

});

// HTMLのみならず画像を含む全コンテンツが読まれたら実行
$(window).load(function () {
	/*
	 *  目次生成
	 *  （toc.jsを使用）
	 */
	$('#toc').toc({
		selectors: 'h3, h4', // 目次として表示する要素のCSSセレクターを指定
		container: '#post-body',
		anchorName: function (i, heading, prefix) { // アンカーネームのカスタマイズ
			return prefix + i;
		}
	});

	/*
	 *  ポップアップメッセージ
	 *  （anime.jsを使用）
	 */
	// 既に出したかどうかのフラグ
	let popup_flg = false;
	// ホワイトリストに入るページなら
	if (checkWhiteList()) {
		// スクロールされる度に実行
		$(window).scroll(function () {
			// まだポップアップしてないand一定以上のスクロール
			if (popup_flg == false && $(this).scrollTop() > 500) {
				// イベント送信（表示）
				ga('send', 'event', 'popup-box', 'show', location.pathname, 1, { 'nonInteraction': 1 });
				// ひょっこり表示
				anime({
					targets: '#popup-box',
					translateY: -200,
					duration: 800
				});
				popup_flg = true;
			}
		});
	}
	// ポップアップの開くボタンをクリック
	$('#popup-open').click(function () {
		// イベント送信（ページ遷移）
		ga('send', 'event', 'popup-box', 'open', location.pathname, 1, { 'nonInteraction': 1 });
		// 指定したリンクへ飛ぶ
		location.href = "https://oguemon.com/tools/calc/mat-det-inv.html";
	});
	// ポップアップを閉じるボタンをクリック
	$('#popup-close').click(function () {
		//  イベント送信（閉じる）
		ga('send', 'event', 'popup-box', 'close', location.pathname, 1, { 'nonInteraction': 1 });
		// ボックスを下に引っ込める
		anime({
			targets: '#popup-box',
			translateY: 200,
			duration: 1000
		});
	});

	// 表示を許すページであるかどうかをチェック
	function checkWhiteList() {
		// 表示を許すページ
		const white_list = [
			'elimination',
			'simultaneous-regular',
			'cramers-rule',
			'solution',
			'cofactor-expansion',
			'det-feature',
			'hello-world',
			'inverse-matrix',
			'inner-and-cross-product'
		];
		// 正規表現作り
		let re_str = '';
		for (let i = 0; i < white_list.length; i++) {
			re_str += white_list[i] + '|';
		}
		re_str = re_str.slice(0, -1);
		const re = new RegExp(re_str);
		// 文字列を検索
		return re.test(location.pathname);
	}
});
