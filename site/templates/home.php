<?php

include_once('./blog_tools.php');

$image = $page->images->first();
if ($image) {
  $thumb = $image->size(1200, 300, 'center');
  $header_top .= "<div class='w3-card w3-margin'><img src='{$thumb->url}' alt='{$thumb->description}' style='width:100%'>";
  if ($image->description!='') $header_top .= "
      <div class='w3-container w3-center'>$thumb->description</div>
    ";
  $header_top .= "
    </div>
  ";
}

$content .= $page->body;

if ($user->isLoggedin()) {

  $updated_text = __('Updated');

  $content .= "
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
  ";

  $blog_html = renderBlog();
  $content .= $blog_html; 

  $content .= "
  <!-- END Grid -->
  </div>
  ";

}; // END if ($user->isLoggedin())
