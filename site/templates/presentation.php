<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$subpages = $page->children('template=presentation');

	$main = null;
	$first = $subpages->first();
	if ($first) {
		$main .= "
		<div class='{$cardstyle} w3-animate-left'>
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
		<div class='w3-col l2 m3 s6' style='height: 172px;'>
			<div class='w3-style-l5'>
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
