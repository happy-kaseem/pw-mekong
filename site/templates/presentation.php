<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$subpages = $page->children('template=presentation');

	$main = null;
	$first = $subpages->first();
	if ($first) {
		$imagehtml = null;
		$image = $first->images->first();
		if ($image) {
			$tumb = $image->size(60,180);
			$imagehtml = "<img src='{$tumb->url}' class='w3-image'>";
		}
		$main .= "
		<div class='w3-container w3-animate-left'>
			{$imagehtml}
			<div class='w3-container w3-large w3-theme' style='height:50px'>
				{$first->title}
			</div>
			<div class='w3-container'>
				{$first->body}
			</div>
		</div>
		";	
	}

	$menu = "<div class='w3-row'>";
	foreach ($subpages as $sp) {
		// height 172px = 50+90+2*16 (margins and padding)
		$menu .= "
		<div class='w3-container w3-col l2 m3 s6' style='height: 172px;'>
			<div class='w3-theme-l4'>
				<div class='w3-container w3-theme' style='height:50px'>
					{$sp->title}
				</div>
				<div class='w3-container w3-small' style='height:90px;overflow:auto'>
					{$sp->about}
				</div>
			</div>
		</div>";
	}
	$menu .= "</div>";

	$content .= "
	<!-- Main content -->
	{$main}
	{$menu}
	";
} else { // ELSE if ($user->isLoggedin())



}; // END if ($user->isLoggedin())
