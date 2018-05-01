<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$content .= "
	<!-- Main content -->
	<div class='w3-container'>

	</div>
	";
} else { // ELSE if ($user->isLoggedin())

	$comment = 'no comment';
	$urlsegment = $input->urlSegment(1);
	$selector = "name={$urlsegment}";
	$token = $pages->get('/processwire/landing-tokens/')->find($urlsegment);
	if ((count($token)==1) and ($token->token_expiration>=now())) {
		$comment = 'valid token!';
	}
	$content .= "
	<!-- Main content -->
	<div class='w3-container'>
		<p>Welcome back</p>
		<p>{$urlsegment}</p>
		<p>Selector: {$selector}</p>
		<p>{$comment}</p>
	 </div>
  	";
}; // END if ($user->isLoggedin())
