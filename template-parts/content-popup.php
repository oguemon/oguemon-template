<?php
/**
 * ポップアップでオススメコンテンツを表示！
 * @package oguemon
 */
?>

<script>
    // スクロールを測定する要素
    var documentElement = null;
    // スクロール位置を測定する要素を設定
    if (navigator.userAgent.toLowerCase().match(/webkit|msie 5/)) {
        // Webkit系（Safari, Chrome, iOS）判定
        if(navigator.userAgent.indexOf('Chrome') != -1){
            // Chromeはhtml要素
            documentElement = document.documentElement;
        } else {
            // Chrome以外はbody要素
            documentElement = document.body;
        }
    } else {
    // IE（6以上）、Firefox、Operaはhtml要素
    documentElement = document.documentElement;
    }

	//既に出したかどうかのフラグ
    var popup_flg = false;
    //スクロールする度に呼び出す
    window.onscroll = function() {
		//一定以上のスクロールandまだポップアップしてない
        if (documentElement.scrollTop > 500 && popup_flg == false)
        {
    	    //イベント送信（表示）
    	    ga('send','event','popup-box','show',location.href, 1,{'nonInteraction':1});
    	    //ひょっこり表示する
            popup_flg = true;
            var ele = document.querySelector('#popup-box');
            var cssSelector = anime({
                targets: ele,
                translateY: -200,
                duration: 800
            });
        }
    }

	//「開く」ボタンを押す
    function openPopup ()
    {
    	//イベント送信（ページ遷移）
    	ga('send','event','popup-box','open',location.href, 1,{'nonInteraction':1});
    	//指定したリンクへ飛ぶ
        location.href = "https://oguemon.com/tools/calc/mat-det-inv.html";
    }

    //「閉じる」ボタンを押す
    function closePopup ()
    {
    	//イベント送信（閉じる）
    	ga('send','event','popup-box','close',location.href, 1,{'nonInteraction':1});
    	//ボックスを下に引っ込める
        var ele = document.querySelector('#popup-box');
        var cssSelector = anime({
            targets: ele,
            translateY: 200,
            duration: 1000
        });
    }
</script>

<div id="popup-box">
    <div class="wrapper">
        <div class="title">行列式＆逆行列の自動計算サイトを公開！</div>
        <div class="description">
        	線形代数のレポート＆試験対策の伴侶が登場！<br>
        	演習に役立つ計算ドリル機能も搭載！
        </div>
    </div>
    <table>
        <tr>
            <td><div id="open" onclick="openPopup()">記事を開く</div></td>
            <td><div id="close" onclick="closePopup()">閉じる</div></td>
        </tr>
    </table>
</div>