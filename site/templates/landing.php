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
	$selector = "name={$urlsegment}, include=all"; // selector to find the token
	$token = $pages->get('/processwire/landing-tokens/')->find($selector);
	if (count($token)==1) { // did we find excatly one token
		$token = $token[0]; // retrieve the one token from the array
		if ($token->getUnformatted('token_expiration')>=\time()) { // is the token already expired?
			$comment = 'valid token!';
			$session->set('tokenid',$token->name);
			$session->set('tokenvalue',\crypt($token->name,$config->userAuthSalt));
		} else {
			$comment = 'expired token!';
		}
	} else {
		$comment = 'no token!';
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
