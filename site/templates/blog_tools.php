<?php

	function renderBlogEntry($blog, $homepage, $preview=false) {

		$datetime = wire('datetime');

		$blog_html = '';

	    $image_html = '';
	    $external_html = '';
	    
	    $blog_image = $blog->images->first();
	    if ($blog_image) {
	  		$thumb = $blog_image->size(600, 150, 'center');
	  		$image_html .= "<img src='{$thumb->url}' alt='{$thumb->description}' style='width:100%'>";
	    }
	    if ($blog->external_url != '') {
	      $external_html = "<div class='w3-responsive'><iframe class='w3-mobile' src='{$blog->external_url}' width='640' height='360' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	    }
	    $blog_description = '';
	    if ($blog->description) $blog_description = $blog->description.', ';
	    $tags_text = '';
	    foreach($blog->tags as $tag) {
	      $tags_text .= "<span class='w3-tag'>{$tag->title}</span>&nbsp;";
	    }

	    $blog_link = '<p>&nbsp;</p>';
	    if ($preview)
	    $blog_link = "
	            <p><a href='$blog->url' class='w3-button w3-padding-large w3-theme-l5 w3-border'><b>READ MORE »</b></a></p>
           ";

	    $blog_bodystyle = $preview ? 'max-height:120pt;overflow:scroll' : '';

	    $blog_html .= " 
	    <div class='w3-card-4 w3-margin w3-theme-l5'>
	      {$image_html}
	      {$external_html}
	      <div class='w3-container'>
	        <h3><b>{$blog->title}</b></h3>
	        <h5>{$blog_description}<span class='w3-opacity'>{$datetime->date('F d, Y', $blog->published)} ({$updated_text} {$datetime->relativeTimeStr($blog->modified)})</span></h5>
	      </div>

	      <div class='w3-container'>
	        <div style='{$blog_bodystyle}'>{$blog->body}</div>
	        <div class='w3-row'>
	          <div class='w3-col m8 s12'>
	          	{$blog_link}
	          </div>
	          <div class='w3-col m4 w3-hide-small'>
	            <p><span class='w3-padding-large w3-right'><b>Comments  </b> <span class='w3-tag'>0</span></span></p>
	          </div>
	        </div>
	        <div class='w3-margin-bottom'>{$tags_text}</div>
	      </div>
	    </div>
		  ";

		if (!$preview) {
			$blog_html .= "
		      <div class='w3-container'>
	            <p><a href='$homepage->url' class='w3-button w3-padding-large w3-white w3-border'><b>RETURN »</b></a></p>
	          </div>
	         ";
		}


		return $blog_html;
	}

	function tagList($user) {
		// build a list of all the tags found in all the roles of the user
		$taglist = array();
		foreach($user->roles as $userrole) {
		  foreach($userrole->tags as $tag) {
		    $taglist += array($tag->id => $tag->title);
		  }
		}
		return $taglist;
	}

	function renderBlog() {

		$user = wire('user');
		$pages = wire('pages');
		$datetime = wire('datetime');

		$blog_html = "
			<!-- Blog entries -->
			<div class='w3-col l9'>
		";

		// build a list of all the tags found in all the roles of the user
		$taglist = array_keys(tagList($user));
		$tag_sel = implode('|', $taglist);
		$selector = "template=blog, tags={$tag_sel}";
//		foreach ($tagList as $tag) $selector .= ", tags={$tag}";

		wire('log')->save('messages', 'selector:'.$selector);

		$blog_entries = $pages->find($selector);
		foreach ($blog_entries as $blog) {
			$blog_html .= renderBlogEntry($blog,null,true);
			$blog_html .= "
			    <hr>
			   ";
		}

		$blog_html .= "
			<!-- END Blog entries -->
			</div>
		";

		return $blog_html;

	}

	function renderFilterlist() {


		$html = '';
		$user = wire('user');
		$taglist = tagList($user);

		foreach ($taglist as $key => $tag) {
			$html .= "<p>{$tag}</p>";
		}

		return $html;

	}