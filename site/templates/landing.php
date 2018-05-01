<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$content .= "
	<!-- Main content -->
	<div class='w3-container'>

	</div>
	";
} else { // ELSE if ($user->isLoggedin())

	$urlsegment = $input->urlSegment(1);
	$content .= "
	<!-- Main content -->
	<div class='w3-container'>
		<p>Welcome back</p>
		<p>{$urlsegment}</p>
	 </div>
  	";
}; // END if ($user->isLoggedin())
