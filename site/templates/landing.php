<?php namespace ProcessWire;

if ($user->isLoggedin()) {

  $content .= "
  <!-- Main content -->
  <div class='w3-container'>

  </div>
  ";
} else { // ELSE if ($user->isLoggedin())

  $content .= "
  <!-- Main content -->
  <div class='w3-container'>
  	<p>Welcome back</p>
  </div>
  ";
}; // END if ($user->isLoggedin())
