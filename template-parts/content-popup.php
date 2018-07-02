<?php
/**
 * ポップアップでオススメコンテンツを表示！
 * @package oguemon
 */
?>

<style>
#popup-box{
    margin: 10px;
    bottom: -200px;
    position: fixed;
    border-radius: 5px;
    box-shadow: 1px 1px 1px rgba(0,0,0,0.1);
}
#popup-box #wrapper {
    padding: 10px;
    background: #ffffff;
    border-top:   3px solid #ff8888;
    border-right: 3px solid #ff8888;
    border-left:  3px solid #ff8888;
    border-radius: 5px 5px 0 0;
}
#popup-box #wrapper #title{
    font-size: 120%;
    font-weight: bold;
    color: #ff8888;
}
#popup-box #wrapper #description{
    margin: 5px 0 0 0;
    color: #333333;
}
#popup-box table {
    width: 100%;
    margin: 0;
    padding: 0;
    border-collapse: collapse;
    border-width: 0px;
}
#popup-box table td{
    width: 50%;
    margin: 0;
    padding: 0;
    border-width: 0px;
}
#popup-box #open {
    padding: 10px 0;
    text-align: center;
    background: #ff8888;
    color: #ffffff;
    font-weight: bold;
    border-radius: 0 0 0 5px;
}
#popup-box #open:hover {
    background: #ffcccc;
}
#popup-box #close {
    padding: 10px 0;
    text-align: center;
    background: #888888;
    color: #ffffff;
    font-weight: bold;
    border-radius: 0 0 5px 0;
}
#popup-box #close:hover {
    background: #bbbbbb;
}

@media screen and (min-width: 640px){
    #popup-box{
        width: 420px;
        right: 10px;
    }
}
</style>

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
    <div id="wrapper">
        <div id="title">行列式＆逆行列の自動計算サイトを公開！</div>
        <div id="description">
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