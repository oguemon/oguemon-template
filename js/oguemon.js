jQuery(document).ready(function ($) {
	'use strict';

	//起動時
	$(window).load(function () {
		$('#sp-right-menu-area').css('display', 'none');
		$('#transparent').css('display', 'none');
	});

	$(function () {
		/*
		 * スマホの右上ボタンを押すとスライド
		 */
		var $btn = $('#sp-menu-right-btn');
		var $sp = $('#sp-right-menu-area');
		var $tr = $('#transparent');
		var $container = $('#container');
		$btn.on('click', function () {
			$container.toggleClass('side-open');
			if ($container.hasClass('side-open')) { //横に開いていたら
				$sp.css('display', 'block');
				$tr.css('display', 'block');
				$btn.css('transform', 'rotate(180deg)');
			} else {
				$tr.css('display', 'none');
				$btn.css('transform', 'rotate(0)');
				setTimeout(function () {
					$sp.css('display', 'none');
				}, 300);
			}
		});
		$tr.on('click', function () {
			$btn.css('transform', 'rotate(0)');
			$container.toggleClass('side-open');
			setTimeout(function () {
				$sp.css('display', 'none');
			}, 300);
			$tr.css('display', 'none');
		});

		/*
		 * #で始まるアンカーをクリックした場合にスクロールを実施処理
		 */
		$('a[href^="#"]').click(function () {
			var speed = 400; // ミリ秒
			var href = $(this).attr("href");
			var target = $(href == "#" || href == "" ? 'html' : href);
			var position = target.offset().top - 10; //ゆとりを持たせる
			$('body,html').animate({ scrollTop: position }, speed, 'swing');
			return false;
		});

		/*
		 *  目次生成(toc.js)
		 */
		$('#toc').toc({
			'selectors': 'h3, h4', //目次として表示する要素のCSSセレクターを指定
			'container': '#post-body',
			'anchorName': function (i, heading, prefix) { //アンカーネームのカスタマイズ
				return prefix + i;
			}
		});

		/*
		 *  ポップアップメッセージ
		 */
		//既に出したかどうかのフラグ
		var popup_flg = false;
		$(window).scroll(function () {
			//一定以上のスクロールandまだポップアップしてないand表示ページである
			if ($(this).scrollTop() > 500 && popup_flg == false && checkWhiteList()) {
				//イベント送信（表示）
				ga('send', 'event', 'popup-box', 'show', location.pathname, 1, { 'nonInteraction': 1 });
				//ひょっこり表示する
				anime({
					targets: '#popup-box',
					translateY: -200,
					duration: 800
				});
				popup_flg = true;
			}
		});
		// ポップアップを開く
		$('#popup-open').click(function () {
			//イベント送信（ページ遷移）
			ga('send', 'event', 'popup-box', 'open', location.pathname, 1, { 'nonInteraction': 1 });
			//指定したリンクへ飛ぶ
			location.href = "https://oguemon.com/tools/calc/mat-det-inv.html";
		});
		// ポップアップを閉じる
		$('#popup-close').click(function () {
			//イベント送信（閉じる）
			ga('send', 'event', 'popup-box', 'close', location.pathname, 1, { 'nonInteraction': 1 });
			//ボックスを下に引っ込める
			anime({
				targets: '#popup-box',
				translateY: 200,
				duration: 1000
			});
		});

		// 表示を許すページであるかどうかをチェック
		function checkWhiteList() {
			// 表示を許すページ
			var white_list = Array(
				'elimination',
				'simultaneous-regular',
				'cramers-rule',
				'solution',
				'cofactor-expansion',
				'det-feature',
				'hello-world',
				'inverse-matrix',
				'inner-and-cross-product'
			);

			// 正規表現作り
			var re_str = '';
			for (var i = 0; i < white_list.length; i++) {
				re_str += white_list[i] + '|';
			}
			re_str = re_str.slice(0, -1);
			var re = new RegExp(re_str);

			// 文字列を検索
			return re.test(location.pathname);
		}

	});
});
