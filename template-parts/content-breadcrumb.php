<?php
/**
 * パンくずリスト
 * @package oguemon
 */
?>
<!--パンくずリスト-->
<ul id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	<a href="<?= get_bloginfo('url') ?>" itemprop="item"><span itemprop="name"><?= get_bloginfo('name') ?></span></a>
	<meta itemprop="position" content="1" />
</li>
<?php
$content_num = 2;
if(is_category()){//カテゴリーページ
	$id    = get_categories('include='.get_query_var('cat'))[0]->parent;
	$title = get_categories('include='.get_query_var('cat'))[0]->name;
	$url   = get_categories('include='.get_query_var('cat'))[0]->url;
}elseif(has_category()){//カテゴリー「を持つ」ページ
	$id    = get_the_category()[0]->cat_ID;
	$title = get_the_title();
	$url   = get_permalink();
}else{
	$id = '';
	$title = get_the_title();
	$url   = get_permalink();
}

if(!empty($id)){
	$cat_list = array();
	while(!empty($id)){
		array_push($cat_list, array(
			'url'  => get_category_link($id),
			'name' => get_the_category_by_ID($id)
		));
		$id = get_categories('include='.$id)[0]->parent;
	}
	foreach (array_reverse($cat_list) as $cat){
?>
		<li>></li>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a href="<?= $cat['url'] ?>" itemprop="item"><span itemprop="name"><?= $cat['name'] ?></span></a>
			<meta itemprop="position" content="<?= $content_num?>" />
		</li>
<?php
		$content_num++;
	}
}
?>
<li>></li>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	<span itemprop="name"><?= $title ?></span>
	<meta itemprop="position" content="<?= $content_num ?>" />
</li>
</ul>
