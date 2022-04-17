<?php
/**
 * katexショートコードに対してスクリプトを読み込む
 */
add_shortcode('katex', function() {
	$base_url = 'https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/';
	wp_enqueue_script('katex-core', $base_url . 'katex.min.js', [], '0.12.0', true);
	wp_enqueue_script('katex-render', $base_url . 'contrib/auto-render.min.js', ['katex-core'], '0.12.0', true);

	$css_output = "<link rel='stylesheet' href='" . $base_url . "katex.min.css?v=0.12.0' media='print' onload='this.media=\"all\"' />";

	return $css_output;
});

// サイト内広告
add_shortcode('ad', function () {
	return <<< EOM
	<ins class="adsbygoogle"
		 style="display:block; text-align:center;"
		 data-ad-layout="in-article"
		 data-ad-format="fluid"
		 data-ad-client="ca-pub-6941251424797111"
		 data-ad-slot="9452886211">
	</ins>
	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
EOM;
});

// セリフ
add_shortcode('serif', function ($atts, $content = '') {
    extract(shortcode_atts([
        'imgurl' => get_template_directory_uri() . '/img/profile.jpg',
        'name' => '',
	], $atts));

	$output  = '<div class="testimony">';
	$output .=     '<div class="testimony_icon"><img src="' . $imgurl . '" /></div>';
	$output .= 	   '<div class="testimony_text">';
	$output .= 		   '<div class="testimony_content">';
	$output .= ($name !== '')? '<div class="name">' . $name . '</div>' : '';
	$output .= 			    $content;
	$output .=         '</div>';
	$output .=     '</div>';
	$output .= '</div>';

	return $output;
});

// 強調用のボックス
add_shortcode('box', function ($atts, $content = '') {
    extract(shortcode_atts([
        'title' => '',
	], $atts));

	$output  = '<div class="point-box">';
	$output .= $title? '<div class="point-box-caption">' . $title . '</div>' : '';
	$output .= $content;
	$output .= '</div>';

	return $output;
});

// 教科書の紹介リンク
add_shortcode('textbook', function () {
	return <<<EOM
	<div class="affiliate-box">
		<div class="thum">
			<img src="//ws-fe.amazon-adsystem.com/widgets/q?_encoding=UTF8&ASIN=4903814149&Format=_SL250_&ID=AsinImage&MarketPlace=JP&ServiceVersion=20070822&WS=1&tag=oguemon-22&language=ja_JP">
		</div>
		<div class="text">
			<div class="copy">＼ おぐえもん.comの分かりやすさを凝縮 ／</div>
			<div class="title">大学1年生もバッチリ分かる線形代数入門</div>
			<div class="publisher">プレアデス出版</div>
			<div class="size">A5サイズ・236ページ</div>
			<div class="debut">販売中！（2021.06.18 発売）</div>
			<div class="link-box">
				<a class="link-button amazon" href="https://amzn.to/3hR2dgV" target="_blank"  data-linktype="入門書（Amazon）">Amazon</a>
				<a class="link-button rakuten" href="https://a.r10.to/hD4Mmj" target="_blank" data-linktype="入門書（Rakuten）">楽天</a>
				<a class="link-button honto" href="https://honto.jp/netstore/pd-book_31012808.html" target="_blank" data-linktype="入門書（Honto）">丸善・ジュンク堂</a>
				<a class="link-button kinokuniya" href="https://www.kinokuniya.co.jp/f/dsg-01-9784903814148" target="_blank" data-linktype="入門書（紀伊國屋）">紀伊國屋</a>
			</div>
		</div>
	</div>
EOM;
});

// Amazonの紹介リンク
include_once(get_template_directory() . '/func/AwsV4.php');

add_shortcode('amzn', function ($atts) {
    extract(shortcode_atts([
        'asin' => '',
	], $atts));

	try {
		$product  = json_decode(get_amazon_product_info($asin));
		$url      = $product->ItemsResult->Items[0]->DetailPageURL;
		$imgurl   = $product->ItemsResult->Items[0]->Images->Primary->Large->URL;
		$title    = $product->ItemsResult->Items[0]->ItemInfo->Title->DisplayValue;
		$price    = number_format($product->ItemsResult->Items[0]->Offers->Listings[0]->Price->Amount);
		$get_date = date('Y.m.d');
	} catch (Exception $e) {
		$url      = '';
		$imgurl   = '';
		$title    = '取得に失敗しました';
		$price    = '0';
		$get_date = date('Y.m.d');
	}

	return <<<EOM
	<a class="amzn-box" href="$url" target="_blank">
		<div class="img-info">
			<img src="$imgurl" >
		</div>
		<div class="text-info">
			<div class="product-title">$title</div>
			<div class="product-price"><span class="price">$price</span><span class="unit">円</span><span class="description">（$get_date 現在）</span></div>
			<div class="product-link">Amazonで購入する</div>
		</div>
	</a>
EOM;
});

function get_amazon_product_info ($item_id) {

    $serviceName = "ProductAdvertisingAPI";
    $region      = "us-west-2";
    $accessKey   = "AKIAIFFJBJKEUTMVS52Q";
    $secretKey   = "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";
    $payload = '{'
            . ' "ItemIds": ["' . $item_id . '"],'
            . ' "Resources": ['
            . '  "Images.Primary.Large",'
            . '  "ItemInfo.Title",'
            . '  "Offers.Listings.Price"'
            . ' ],'
            . ' "PartnerTag": "oguemon-22",'
            . ' "PartnerType": "Associates",'
            . ' "Marketplace": "www.amazon.co.jp"'
            . '}';
    $host="webservices.amazon.co.jp";
    $uriPath="/paapi5/getitems";
    $awsv4 = new AwsV4 ($accessKey, $secretKey);
    $awsv4->setRegionName($region);
    $awsv4->setServiceName($serviceName);
    $awsv4->setPath ($uriPath);
    $awsv4->setPayload ($payload);
    $awsv4->setRequestMethod ("POST");
    $awsv4->addHeader ('content-encoding', 'amz-1.0');
    $awsv4->addHeader ('content-type', 'application/json; charset=utf-8');
    $awsv4->addHeader ('host', $host);
    $awsv4->addHeader ('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.GetItems');
    $headers = $awsv4->getHeaders ();
    $headerString = "";
    foreach ( $headers as $key => $value ) {
        $headerString .= $key . ': ' . $value . "\r\n";
    }
    $params = array (
            'http' => array (
                'header' => $headerString,
                'method' => 'POST',
                'content' => $payload
            )
        );
    $stream = stream_context_create ( $params );

    $fp = @fopen ('https://'.$host.$uriPath, 'rb', false, $stream );

    if (! $fp) {
        throw new Exception ( "Exception Occured" );
    }
    $response = @stream_get_contents ( $fp );
    if ($response === false) {
        throw new Exception ( "Exception Occured" );
    }
    return $response;
}