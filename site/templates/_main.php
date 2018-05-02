<?php namespace ProcessWire;

/**
 * _main.php
 * Main markup file (multi-language)

 * MULTI-LANGUAGE NOTE: Please see the README.txt file
 *
 * This file contains all the main markup for the site and outputs the regions 
 * defined in the initialization (_init.php) file. These regions include: 
 * 
 *   $title: The page title/headline 
 *   $content: The markup that appears in the main content/body copy column
 *   $sidebar: The markup that appears in the sidebar column
 * 
 * Of course, you can add as many regions as you like, or choose not to use
 * them at all! This _init.php > [template].php > _main.php scheme is just
 * the methodology we chose to use in this particular site profile, and as you
 * dig deeper, you'll find many others ways to do the same thing. 
 * 
 * This file is automatically appended to all template files as a result of 
 * $config->appendTemplateFile = '_main.php'; in /site/config.php. 
 *
 * In any given template file, if you do not want this main markup file 
 * included, go in your admin to Setup > Templates > [some-template] > and 
 * click on the "Files" tab. Check the box to "Disable automatic append of
 * file _main.php". You would do this if you wanted to echo markup directly 
 * from your template file or if you were using a template file for some other
 * kind of output like an RSS feed or sitemap.xml, for example. 
 *
 * 
 */

if($config->ajax) return;

$footer_nextprevious = '';
$next_page = $page->next();
$prev_page = $page->prev();

if (($next_page->id) || ($prev_page->id)) {
  if ($next_page->id) $next_href = $next_page->url; else $next_disable = 'w3-disabled';
  if ($prev_page->id) $prev_href = $prev_page->url; else $prev_disable = 'w3-disabled';

  $prev_text = __("Previous");
  $next_text = __("Next");
  
  $footer_nextprevious .= "
    <a href = '$prev_href' class='w3-button w3-theme-d5 {$prev_disable} w3-padding-large w3-margin-bottom'>« {$prev_text}</a>
    <a href = '$next_href' class='w3-button w3-theme-d5 {$next_disable} w3-padding-large w3-margin-bottom'>{$next_text} »</a>
  ";
}

$cookie_consent = '';
if ($user->isGuest() || !$session->hasCookie()) {
	$cookie_consent .= "
<div class='w3-panel w3-theme w3-display-container'>
  <span onclick='this.parentElement.style.display=\"none\"'
  class='w3-button w3-theme w3-large w3-display-topright'>x</span>
  <h4>".__("Data Privacy Regulation.")."</h4>
  <p>".__("This website will store information on your computer which allows us to recognise you as an individual user. This information is stored in cookies and can be deleted by you at anytime from your browser.")."</p>
</div>
	";
};

$language_menu = "
	  <button class='w3-button w3-theme-d5'><i class='fa fa-language'></i> {$user->language->title}</button>
	  <div class='w3-dropdown-content w3-bar-block w3-border'>";
	foreach ($languages as $language) if ($language!=$user->language) {
		$language_menu .= "<a href='{$page->url($language)}' class='w3-bar-item w3-button'>{$language->title}</a>";
	}
$language_menu .= "
	  </div>
";

echo "
<!DOCTYPE html>
<html>
<title>{$page->title}</title>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='{$config->urls->templates}styles/w3.css'>
<link rel='stylesheet' href='{$config->urls->templates}styles/w3-theme-blue-grey.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<style>
body,h1,h2,h3,h4,h5 {font-family: 'Raleway', sans-serif}
</style>
<body class='w3-theme-l5'>
{$cookie_consent}
<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class='w3-content' style='max-width:1400px'>

<!-- Header -->
<!-- header_top -->
{$header_top}
<!-- End header_top -->
<header class='w3-container w3-center w3-padding w3-theme-l3 w3-bottombar'> 
  <div class='w3-left'>
    <!-- page_menu -->
    {$page_menu}
    <!-- End page_menu -->
  </div>
  <div class='w3-dropdown-hover w3-theme w3-right'>
    {$language_menu}
  </div>
  {$page_body}
</header>

<!-- content -->
<div class='w3-container w3-padding'> 
{$content}
</div>
<!-- End content -->

<!-- Footer -->
<footer class='w3-container w3-theme-l3 w3-padding-32 w3-margin-top'>
  {$footer_nextprevious}
  <p>Powered by <a href='https://www.w3schools.com/w3css/default.asp' target='_blank'>w3.css</a></p>
</footer>

<div id='imagegallerymodal' class='w3-modal' onclick='this.style.display=\"none\"'>
	<span class='w3-button w3-hover-red w3-xlarge w3-display-topright'>&times;</span>
    <div class='w3-modal-content w3-animate-zoom'>
      <img id='galleryimage' src='' style='width:100%'>
	</div>
</div>



<!-- END w3-content -->
</div>

</body>


<script>
function showimagegallerymodal(element) {
	frame = document.getElementById('imagegallerymodal');
	frame.style.display='block';
	img = document.getElementById('galleryimage');
	url = element.attr('imagegalleryurl');
	img.src = url;
}
</script>

</html>
";