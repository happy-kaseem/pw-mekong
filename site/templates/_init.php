<?php namespace ProcessWire;

/**
 * Initialize variables output in _main.php
 *
 * Values populated to these may be changed as desired by each template file.
 * You can setup as many such variables as you'd like. 
 *
 * This file is automatically prepended to all template files as a result of:
 * $config->prependTemplateFile = '_init.php'; in /site/config.php. 
 *
 * If you want to disable this automatic inclusion for any given template, 
 * go in your admin to Setup > Templates > [some-template] and click on the 
 * "Files" tab. Check the box to "Disable automatic prepend file". 
 *
 */

if($config->ajax) return;

$loggedin = $user->isLoggedin(); // are we logged in?

// Variables for regions we will populate in _main.php
// Here we also assign default values for each of them.
$title = $page->get('headline|title'); 
$content = $page->body;
$title = "<h5><b><i class='fa fa-$page->ac_page_icon'></i> $page->title</b></h5>";
$header_top = '';
$page_menu = '';
$footer = '';
$page_body = '';

$sidebar = $page->sidebar;

// We refer to our homepage a few times in our site, so 
// we preload a copy here in $homepage for convenience. 
$homepage = $pages->get('/'); 