<?php

	include_once('./book_tools.php');

	$page_heading = '';
 	$page_body = '';

 	if($page->bookpagetypes) {
 		if ($page->bookpagetypes == $pages->get('/processwire/book-page-types/library/') {
			$page_heading = '<h1>Library</h1>';
 		} else if ($page->bookpagetypes == $pages->get('/processwire/book-page-types/chapter/') {
			$page_heading = '<h2>Chapter</h2>';
 		}
	}
	$content = "
	<div class='w3-container'>
		{$page_heading}
		{$page->body}
		}
	</div>
	";
	

