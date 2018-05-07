<?php namespace ProcessWire;

if ($user->isLoggedin()) {


	$subpages = $page->find('template=presentation');

	$menu = "<div class='w3-row-padding'>";
	foreach ($subpages as $sp) {
		$menu .= "
		<div class='w3-col l2 m3 s6' style='height:120px'>
			<div class='w3-card'>
				<div class='w3-container w3-theme' style='height:30px'>
					{$sp->title}
				</div>
				<div class='w3-container' style='height:90px'>
					{$sp->about}
				</div>
			</div>
		</div>";
	}
	$menu .= "</div>";

	$content .= "
	<!-- Main content -->
	<div class='w3-container'>
	</div>
	{$menu}
	";
} else { // ELSE if ($user->isLoggedin())



}; // END if ($user->isLoggedin())
