<?php

$image = $page->images->first();
if ($image) {
  $thumb = $image->size(1200, 300, 'center');
  $header_top = "<div class='w3-card w3-margin'><img src='{$thumb->url}' alt='{$thumb->description}' style='width:100%'>";
  if ($image->description!='') $header_top .= "
      <div class='w3-container w3-center'>$thumb->description</div>
    ";
  $header_top .= "
    </div>
  ";
}

if ($user->isLoggedin()) {

$updated_text = __('Updated');


$content = "
<!-- Grid -->
<div class='w3-row'>

<div class='w3-col l3 s12'>
  <!-- About Card -->
  <div class='w3-card w3-margin w3-margin-top'>
  <!-- img src='/w3images/avatar_g.jpg' style='width:100%' -->
    <div class='w3-container w3-theme-l5'>
      {$page->about}
    </div>
  </div><hr>
</div>

<!-- Blog entries -->
<div class='w3-col l9'>
";

$taglist = array();
foreach($user->roles as $userrole) {
  foreach($userrole->tags as $tag) {
    $taglist += array($tag->id => 1);
  }
}

$tagsearch = 'id='.implode('|', array_keys($taglist));
//$content .= "<p>Page:{$tagsearch}, {$count}</p>";
$tagsearch = $pages->find($tagsearch, 'include=all');

$log->save('messages',"Tags: {$tagsearch}");
//$tagsearch = '1027';
//$p = $pages->get($tagsearch);
$count = count($tagsearch);
//$content .= "<p>Page:{$tagsearch}, {$count}</p>";
$tagsearch = '1029';

$tags_field = $fields->get('tags');
$tags_field_table = $tags_field->getTable();
$blog_template = $templates->get('blog');

$statements = array();
foreach($taglist as $tag => $key) {
  $statements[] = $tags_field_table.'.data='.$tag;
}

$orsqlstat = implode(' OR ', $statements);

// SELECT * FROM mk_mekong.field_tags JOIN mk_mekong.pages ON mk_mekong.field_tags.pages_id=mk_mekong.pages.id WHERE (mk_mekong.field_tags.data=1027 OR mk_mekong.field_tags.data=1028) AND mk_mekong.pages.templates_id=44;
$sql = "SELECT * FROM {$tags_field_table} JOIN pages ON {$tags_field_table}.pages_id=pages.id WHERE ({$orsqlstat}) AND pages.templates_id={$blog_template->id}";
wire('log')->save('messages', 'SQL:'.$sql);

$pDOS = $database->prepare($sql);
if ($pDOS->execute()) {
  while ($row = $pDOS->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
    $blog = $pages->get($row['pages_id']);

  	$image_html = '';
    $external_html = '';
    
  	$blog_image = $blog->images->first();
  	if ($blog_image) {
  		$thumb = $blog_image->size(600, 150, 'center');
  		$image_html .= "<img src='{$thumb->url}' alt='{$thumb->description}' style='width:100%'>";
  	}
    if ($blog->external_url != '') {
      $external_html = "<div class='w3-responsive'><iframe class='w3-mobile' src='{$blog->external_url}' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
    }
  	$blog_description = '';
  	if ($blog->description) $blog_description = $blog->description.', ';
    $tags_text = '';
    foreach($blog->tags as $tag) {
      $tags_text .= "<span class='w3-tag'>{$tag->title}</span>";
    }

  	$content .= "	
    <div class='w3-card-4 w3-margin w3-theme-l5'>
    	{$image_html}
      {$external_html}
      <div class='w3-container'>
        <h3><b>{$blog->title}</b></h3>
        <h5>{$blog_description}<span class='w3-opacity'>{$datetime->date('F d, Y', $blog->published)} ({$updated_text} {$datetime->relativeTimeStr($blog->modified)})</span></h5>
      </div>

      <div class='w3-container'>
      	<div style='max-height:120pt;overflow:scroll'>{$blog->body}</div>
        <div class='w3-row'>
          <div class='w3-col m8 s12'>
            <p><a href='$blog->url' class='w3-button w3-padding-large w3-theme-l5 w3-border'><b>READ MORE »</b></a></p>
          </div>
          <div class='w3-col m4 w3-hide-small'>
            <p><span class='w3-padding-large w3-right'><b>Comments  </b> <span class='w3-tag'>0</span></span></p>
          </div>
        </div>
        <div class='w3-margin-bottom'>{$tags_text}</div>
      </div>
    </div>
    <hr>
    ";
  }
}

$content .= "
<!-- END Blog entries -->
</div>

<!-- END Grid -->
</div>
";

}; // END if ($user->isLoggedin())
