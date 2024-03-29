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
			class: 'book',
			url: '/study/linear-algebra/textbook/',
		},
		{
			class: 'salary',
			url: '/tax-calc/',
		},
		{
			class: 'calc',
			url: '/tools/calc/mat-det-inv.html',
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

	// アフィリエイトリンクを押すとイベント発生
	$('.link-button').on('click', e => {
		ga('send', 'event', {
			eventCategory: 'Link',
			eventAction: 'Click',
			eventLabel: $(e.target).data('linktype'),
			eventValue: 1,
			nonInteraction: true,
		})
	});
});

// HTMLのみならず画像を含む全コンテンツが読まれたら実行
$(window).on('load', () => {
	/*
	 *  ポップアップメッセージ
	 */
	// メッセージの一覧
	const popup_contents = [
		{
			'eventlabel': 'オープンチャット',
			'img' : '/wordpress/wp-content/themes/oguemon/img/oguemon-choice/thum-openchat.png',
			'title': 'みんなで線形代数を勉強しよう',
			'description': '500人を突破した線形代数のLINEオープンチャット！匿名OK！疑問や発見を語り合い理解を深めよう。',
			'link': 'https://line.me/ti/g2/7Iv3QJFuUGfmd-karjBg_g',
			'white_list': [
				'linear-algebra', // 線形代数カテゴリ全部
			],
		},
		{
			'eventlabel': '入門書A',
			'img' : '/wordpress/wp-content/themes/oguemon/img/oguemon-choice/thum-book.png',
			'title': '授業より分かるおぐえもんの線形代数が書籍化！',
			'description': 'やさしい・見やすい・読みやすいが揃った入門書が登場！Amazon・楽天で発売中！',
			'link': '/study/linear-algebra/textbook/',
			'white_list': [
				'linear-algebra', // 線形代数カテゴリ全部
			],
		},
		{
			'eventlabel': '入門書B',
			'img' : '/wordpress/wp-content/themes/oguemon/img/oguemon-choice/thum-book2.png',
			'title': '線形代数がよく分かる入門書を作りました',
			'description': '授業や教科書の内容が分からない、独学をはじめようとしているあなたのための一冊が好評発売中！',
			'link': '/study/linear-algebra/textbook/',
			'white_list': [
				'linear-algebra', // 線形代数カテゴリ全部
			],
		},
		{
			'eventlabel': '入門書-大学図書館',
			'img' : '/wordpress/wp-content/themes/oguemon/img/oguemon-choice/thum-book2.png',
			'title': '京大図書館にもあります！おぐえもんの線形代数本',
			'description': '当サイトが書籍化！好評につき40以上の大学図書館に納入されました。Amazonでも発売中！',
			'link': '/study/linear-algebra/textbook/',
			'white_list': [
				'linear-algebra', // 線形代数カテゴリ全部
			],
		},
	];
	// UNIX時間 % メッセージパターン数で出すメッセージを決める
	const pattern = (new Date()).getTime() % popup_contents.length;
	const popup_content = popup_contents[pattern];

	// ポップアップのIDを取得
	// これはGoogle Analyticsのイベントにしよう
	const eventlabel = popup_content.eventlabel;

	// メッセージのセット
	const $popup_box = $('#popup-box');
	$popup_box.find('.thumnail').attr('src', popup_content.img);
	$popup_box.find('.title').text(popup_content.title);
	$popup_box.find('.description').html(popup_content.description);
	$popup_box.find('#popup-open').attr('href', popup_content.link);

	// 既に出したかどうかのフラグ
	let popup_flg = false;
	// クッキーを取得
	const cookie_key = eventlabel;
	const cookie_closed = $.cookie(cookie_key);
	console.log('cookie: ' + cookie_closed);
	// ホワイトリストに入るページ＆クッキーが存在しないなら
	if (checkWhiteList(popup_content.white_list) && !cookie_closed) {
		// スクロールされる度に実行
		$(window).on('scroll', e => {
            const scroll_top = $(e.target).scrollTop();
            if (scroll_top == undefined) {
                return;
            }
			// まだポップアップしてないand一定以上のスクロール
			if (popup_flg == false && scroll_top > 500) {
				// イベント送信（表示）
				ga('send', 'event', {
					eventCategory: 'PopupBox',
					eventAction: 'Show',
					eventLabel: eventlabel,
					eventValue: 1,
					nonInteraction: true,
				})
				// ひょっこり表示
				$('#popup-box').css('transform', 'translateY(-200px)');
				popup_flg = true;
			}
		});
	}
	// ポップアップの開くボタンをクリック
	$('#popup-open').on('click', () => {
		// イベント送信（ページ遷移）
		ga('send', 'event', {
			eventCategory: 'PopupBox',
			eventAction: 'Click',
			eventLabel: eventlabel,
			eventValue: 1,
			nonInteraction: true,
		})
		// クッキーに閉じた旨を保存
		$.cookie(cookie_key, 'closed', {expires: 7});
	});
	// ポップアップを閉じるボタンをクリック
	$('#popup-close').on('click', () => {
		// イベント送信（閉じる）
		ga('send', 'event', {
			eventCategory: 'PopupBox',
			eventAction: 'Close',
			eventLabel: eventlabel,
			eventValue: 1,
			nonInteraction: true,
		})
		// クッキーに閉じた旨を保存
		$.cookie(cookie_key, 'closed', {expires: 7});
		// ボックスを下に引っ込める
		$('#popup-box').css('transform', 'translateY(200px)');
	});

	// 表示を許すページであるかどうかをチェック
	function checkWhiteList(white_list: string[]) {
		// 空配列なら表示
		if(white_list.length == 0) {
			return true;
		}

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
