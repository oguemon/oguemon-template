'use strict';

import $ from 'jquery';
import 'jquery.cookie';
import '@firstandthird/toc'; // 目次生成

// HTMLが読まれたら実行
$(() => {

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
	btn_menu.on('click', () => {
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
			setTimeout(() => {
				menu_area.css('display', 'none');
			}, 300);
		}
	});
	// 透明レイヤーがクリックされたら
	transparent.on('click', () => {
		// スライドを実行（戻る方向に）
		container.removeClass('side-open');
		btn_menu.css('transform', 'rotate(0)');
		transparent.css('display', 'none');
		setTimeout(() => {
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
	btn_search.on('click', () => {
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
	 $('a[href^="#"]').on('click', e => {
		const speed = 400; // ミリ秒
        const href = $(e.target).attr('href');
        if (href == undefined) {
            return;
        }
        const target = $((href == '#' || href == '')? 'html' : href);
        if (target == undefined) {
            return;
        }
        const target_offset = target.offset();
        if (target_offset == undefined) {
            return;
        }
		const position = target_offset.top - 10; //ゆとりを持たせる
		// スクロールを実行
		$('body,html').animate({ scrollTop: position }, speed, 'swing');
	});

	/*
	 * コメント関連
	 */
	// コメントが入力されたら
	$('#comment-input').on('input', e => {
		const $e             = $(e.target);
		const lines          = 1 + (String($e.val()).match(/\n/g) || []).length;
		const line_height    = 20;
		const padding_top    = parseInt($e.css('padding-top').replace(/px/, ''));
		const padding_bottom = parseInt($e.css('padding-bottom').replace(/px/, ''));
		const border_width   = 1;
		const set_height     = lines * line_height + padding_top + padding_bottom + border_width;
		$e.css('height', set_height + 'px');
	});

	// コメントの一覧を開閉する
	$('#comment-toggle').on('click', () => {
		$('#comment-list').slideToggle(200);
	});

	/*
	 *  トップ画像を時間おきに変える
	 */
	// 変数宣言
	const toggleTopImgInterval = 5000; // ミリ秒
	const topImgClassList = [
		{
			class: 'clubhouse',
			url: './clubhouse-gen/',
		},
		{
			class: 'salary',
			url: './tax-calc/',
		},
		{
			class: 'calc',
			url: './tools/calc/mat-det-inv.html',
		},
	];
	let topImgCurrentClassNo = 0;
	// クラスとリンク先を切り替え（初期設定）
	toggleTopImgAttr(topImgCurrentClassNo);
	// 指定時間おきに実行する処理
	setInterval(() => {
		// 次の表示番号を導出
		topImgCurrentClassNo++;
		topImgCurrentClassNo %= topImgClassList.length;
		// クラスとリンク先を切り替え
		toggleTopImgAttr(topImgCurrentClassNo);
	}, toggleTopImgInterval);

	// クラスとリンク先を切り替える関数
	function toggleTopImgAttr (topImgCurrentClassNo: number) {
		const top_img = $('#top-img');
		top_img.removeClass();
		top_img.addClass(topImgClassList[topImgCurrentClassNo].class);
		top_img.attr('href', topImgClassList[topImgCurrentClassNo].url);
	}
});

// HTMLのみならず画像を含む全コンテンツが読まれたら実行
$(window).on('load', () => {
	/*
	 *  ポップアップメッセージ
	 */
	// 既に出したかどうかのフラグ
	let popup_flg = false;
	// クッキーを取得
	const cookie_key = 'popup-openchat';
	const cookie_closed = $.cookie(cookie_key);
	console.log('cookie: ' + cookie_closed);
	// ホワイトリストに入るページ＆クッキーが存在しないなら
	if (true) { // if (checkWhiteList() && !cookie_closed) {
		// スクロールされる度に実行
		$(window).on('scroll', e => {
            const scroll_top = $(e.target).scrollTop();
            if (scroll_top == undefined) {
                return;
            }
			// まだポップアップしてないand一定以上のスクロール
			if (popup_flg == false && scroll_top > 500) {
				// イベント送信（表示）
				ga('send', 'event', 'popup-box', 'show', location.pathname, 1, { 'nonInteraction': 1 });
				// ひょっこり表示
				$('#popup-box').css('transform', 'translateY(-200px)');
				popup_flg = true;
			}
		});
	}
	// ポップアップの開くボタンをクリック
	$('#popup-open').on('click', () => {
		// イベント送信（ページ遷移）
		ga('send', 'event', 'popup-box', 'open', location.pathname, 1, { 'nonInteraction': 1 });
		// クッキーに閉じた旨を保存
		$.cookie(cookie_key, 'closed', {expires: 7});
		// 指定したリンクへ飛ぶ
		location.href = 'https://oguemon.com/clubhouse-gen/';
	});
	// ポップアップを閉じるボタンをクリック
	$('#popup-close').on('click', () => {
		//  イベント送信（閉じる）
		ga('send', 'event', 'popup-box', 'close', location.pathname, 1, { 'nonInteraction': 1 });
		// クッキーに閉じた旨を保存
		$.cookie(cookie_key, 'closed', {expires: 7});
		// ボックスを下に引っ込める
		$('#popup-box').css('transform', 'translateY(200px)');
	});

	// 表示を許すページであるかどうかをチェック
	function checkWhiteList() {
		// 表示を許すページ
		const white_list = [
			'linear-algebra', // 線形代数カテゴリ全部
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
