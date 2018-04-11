<?php

	$blog = $page;

	$content = '';
 	$page_body = '';

    $image_html = '';
    $external_html = '';
    
    $blog_image = $blog->images->first();
    if ($blog_image) {
      $image_html .= "<img src='{$blog_image->url}' alt='{$blog_image->description}' style='width:100%'>";
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
            <p><a href='$homepage->url' class='w3-button w3-padding-large w3-white w3-border'><b>RETURN »</b></a></p>
          </div>
          <div class='w3-col m4 w3-hide-small'>
            <p><span class='w3-padding-large w3-right'><b>Comments  </b> <span class='w3-tag'>0</span></span></p>
          </div>
        </div>
        <div class='w3-margin-bottom'>{$tags_text}</div>
      </div>
    </div>
  ";

