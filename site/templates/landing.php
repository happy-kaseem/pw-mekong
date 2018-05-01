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
	$selector = "name={$urlsegment}, include=all";
	$log->save('messages', $selector);
	$token = $pages->get('/processwire/landing-tokens/')->find($selector);
	if (count($token)==1) {
		$token = $token[0];
		$exp = $token->getUnformatted('token_expiration');
		$log->save('messages', $exp);
		if ($token->token_expiration>=\time()) {
			$comment = 'valid token!';
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
