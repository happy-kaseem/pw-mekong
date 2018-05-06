<?php namespace ProcessWire;

if ($user->isLoggedin()) {


	$subpages = $page->find('template=presentation');

	$menu = null;
	foreach ($subpages as $sp) {
		$menu .= "<div class='w3-card'>{$sp->title}</div>";
	}


	$content .= "
	<!-- Main content -->
	<div class='w3-container'>
		{$menu}

	</div>
	";
} else { // ELSE if ($user->isLoggedin())



}; // END if ($user->isLoggedin())
