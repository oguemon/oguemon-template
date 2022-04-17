<?php
/**
 * ページネーション出力
 * @package oguemon
 */

// 現在のページ
$pages = (int) $wp_query->max_num_pages;    //float型で渡ってくるので明示的に int型 へ
// 全ページ数
$paged = get_query_var('paged') ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように
// 最大いくつ表示するか
$range = 5;

// 1ページの場合は何も表示せず終了
if ($pages === 1) {
	return;
}

// 理想の左右数
$range_left  = (int) ($paged - (ceil($range / 2) - 1)); // 偶数なら半分-1
$range_right = (int) ($paged + floor($range / 2));

// 範囲がページ数以上(満タンor不足)
if ($range >= $pages) {
	// 問答無用で全件表示
	$range_left  = 1;
	$range_right = $pages;
// 適宜調整が必要な場合
} else {
	// 左の不足数(右向きスライド要因)
	$lack_left  = - min($range_left - 1, 0);
	// 右の不足数(左向きスライド要因)
	$lack_right = - min($pages - $range_right, 0);
	// 表示領域のスライド量
	$slide = $lack_left - $lack_right;
	// 不足数に基づく左右の調整
	$range_left  += $slide;
	$range_right += $slide;
}

// ページネーションを表示
echo '<div id="pagination">';
echo generatePrevParts($paged, '前へ');
for ($i = $range_left; $i <= $range_right; $i++) {
	echo generateCenterParts($paged, $i);
}
echo generateNextParts($paged, $pages, '次へ');
echo '</div>';

// 「前へ」を生成する
function generatePrevParts ($paged, $text_before) {
	if ($paged <= 1) {
		return '<div class="prev"><span class="oguemon">OGUEM</span></div>';
	}

	return '<a class="prev" href="' . get_pagenum_link($paged - 1) . '">'
		 .     '<div class="arrow">'
		 .         '<div class="prev-arrow"></div>'
		 .         '<div class="jp">' . $text_before . '</div>'
		 .     '</div>'
		 .     '<span class="oguemon">OGUEM</span>'
		 . '</a>';
}

// 中心部の1つの「O」を表示する
function generateCenterParts ($paged, $current_print_page) {
	// $paged +- $range 以内であればページ番号を出力
	if ($paged === $current_print_page) {
		return '<div class="pager current">'
			 . '<span class="oguemon">O</span>'
			 . '<span class="pagenum">' . $current_print_page . '</span>'
			 . '</div>';
	}

	return '<a class="pager" href="' . get_pagenum_link($current_print_page) . '">'
		 . '<span class="oguemon">O</span>'
		 . '<span class="pagenum">' . $current_print_page . '</span>'
		 . '</a>';
}

// 「次へ」 を表示する
function generateNextParts ($paged, $pages, $text_next) {
	if ($pages <= $paged) {
		return '<div class="next"><span class="oguemon">N</span></div>';
	}

	return '<a class="next" href="' . get_pagenum_link($paged + 1) . '">'
	     .     '<span class="oguemon">N</span>'
	     .     '<div class="arrow">'
	     .         '<div class="next-arrow"></div>'
	     .         '<div class="jp">' . $text_next . '</div>'
	     .     '</div>'
	     . '</a>';
}
