<?php

$image = $page->images->first();
if ($image) {
  $header_top = "<div class='w3-card w3-margin'><img src='{$image->url}' alt='{$image->description}' style='width:100%'>";
  if ($image->description!='') $header_top .= "
      <div class='w3-container w3-center'>$image->description</div>
    ";
  $header_top .= "
    </div>
  ";
}

$updated_text = __('Updated');
$content = "
<!-- Grid -->
<div class='w3-row'>

<!-- Blog entries -->
<div class='w3-col l8 s12'>
";

foreach($page->children('template=blog, sort=-modified') as $blog) {
	$image_html = '';
	$blog_image = $blog->images->first();
	if ($blog_image) {
		$thumb = $blog_image->size(600, 150, 'center');
		$image_html .= "<img src='{$thumb->url}' alt='{$thumb->description}' style='width:100%'>";
	}
	$blog_description = '';
	if ($blog->description) $blog_description = $blog->description.', ';
	$content .= "	
  <div class='w3-card-4 w3-margin w3-theme-l5'>
  	{$image_html}
    <div class='w3-container'>
      <h3><b>{$blog->title}</b></h3>
      <h5>{$blog_description}<span class='w3-opacity'>{$datetime->date('F d, Y', $blog->published)} ({$updated_text} {$datetime->relativeTimeStr($blog->modified)})</span></h5>
    </div>

    <div class='w3-container'>
    	{$blog->body}
      <div class='w3-row'>
        <div class='w3-col m8 s12'>
          <p><a href='$blog->url' class='w3-button w3-padding-large w3-theme-l5 w3-border'><b>READ MORE »</b></a></p>
        </div>
        <div class='w3-col m4 w3-hide-small'>
          <p><span class='w3-padding-large w3-right'><b>Comments  </b> <span class='w3-tag'>0</span></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
  ";
}

$content .= "
<!-- END Blog entries -->
</div>

<div class='w3-col l4'>
  <!-- About Card -->
  <div class='w3-card w3-margin w3-margin-top'>
	<!-- img src='/w3images/avatar_g.jpg' style='width:100%' -->
    <div class='w3-container w3-theme-l5'>
      <h4><b>My Name</b></h4>
      <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and a interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.</p>
    </div>
  </div><hr>
</div>

<!-- END Grid -->
</div>
";
