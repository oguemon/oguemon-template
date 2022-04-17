<?php
/**
 * パンくずリスト
 * @package oguemon
 */
?>
<!--パンくずリスト-->
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement":
  [
    {
      "@type": "ListItem",
      "position": 1,
      "item":
      {
        "@id": "<?= get_bloginfo('url') ?>",
        "name": "<?= get_bloginfo('name') ?>"
      }
    },
    <?php
		$content_num = 2;
		if(is_category()){//カテゴリーページ
			$id    = get_categories('include='.get_query_var('cat'))[0]->parent;
			$title = get_categories('include='.get_query_var('cat'))[0]->name;
			$url   = get_category_link(get_categories('include='.get_query_var('cat'))[0]);
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
			$cat_list = [];
			while(!empty($id)){
				array_push($cat_list, [
					'url'  => get_category_link($id),
					'name' => get_the_category_by_ID($id),
				]);
				$id = get_categories('include='.$id)[0]->parent;
			}
			foreach (array_reverse($cat_list) as $cat){
		?>
    {
      "@type": "ListItem",
      "position": <?= $content_num?>,
      "item":
      {
        "@id": "<?= $cat['url'] ?>",
        "name": "<?= $cat['name'] ?>"
      }
    },
		<?php
				$content_num++;
			}
		}
		?>
    {
      "@type": "ListItem",
      "position": <?= $content_num ?>,
      "item":
      {
        "@id": "<?= $url ?>",
        "name": "<?= $title ?>"
      }
    }
  ]
}
</script>
