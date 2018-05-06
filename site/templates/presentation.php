<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$content .= "
	<!-- Main content -->
	<div class='w3-container'>
		{$page->body}

	</div>
	";
} else { // ELSE if ($user->isLoggedin())



}; // END if ($user->isLoggedin())
