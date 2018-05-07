<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$cardstyle = 'w3-panel w3-card';

	$subpages = $page->find('template=presentation');

	$main = null;
	$first = $subpages->first();
	if ($first) {
		$main .= "
		<div class='{$cardstyle}'>
			<div class='w3-large w3-theme' style='height:50px'>
				{$first->title}
			</div>
			<div class=''>
				{$first->body}
			</div>
		</div>
		";	
	}

	$menu = "<div class='w3-row-padding'>";
	foreach ($subpages as $sp) {
		$menu .= "
		<div class='w3-col l2 m3 s6' style='height:140px'>
			<div class='{$cardstyle}'>
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
	<div class='w3-container'>
	{$main}
	</div>
	{$menu}
	";
} else { // ELSE if ($user->isLoggedin())



}; // END if ($user->isLoggedin())
