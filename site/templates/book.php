<?php

	include_once('./book_tools.php');

	$page_heading = '';
 	$page_body = '';

 	if($page->bookpagetypes) {
 		$bookpagetype_library = $pages->get('/processwire/book-page-types/library/');
 		$bookpagetype_book = $pages->get('/processwire/book-page-types/book/');
 		$bookpagetype_chapter = $pages->get('/processwire/book-page-types/chapter/');
 		if ($page->bookpagetypes == $bookpagetype_library) {
			$page_heading = '<h1>Library</h1>';
			$books = $page->children("template=book, bookpagetypes={$bookpagetype_book->id}");
			foreach ($books as $book) {
				$page_heading .= "<h2>{$book->title}</h2>";
			}
 		} else if ($page->bookpagetypes == $bookpagetype_book) {
 		} else if ($page->bookpagetypes == $pages->get('/processwire/book-page-types/chapter/')) {
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
	

