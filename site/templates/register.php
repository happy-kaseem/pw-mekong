<?php namespace ProcessWire;

if ($user->isLoggedin()) {

	$content .= "
	<!-- Main content -->
	<div class='w3-container'>

	</div>
	";
} else { // ELSE if ($user->isLoggedin())


	// create a new form field (also field wrapper)
	$form = $modules->get("InputfieldForm");
	$form->action = "./";
	$form->method = "post";
	$form->attr("id+name",'subscribe-form');

	// create a text input
	$field = $modules->get("InputfieldText");
	$field->label = "Name";
	$field->attr('id+name','name');
	$field->required = 1;
	$form->append($field); // append the field to the form

	// create email field
	$field = $modules->get("InputfieldEmail");
	$field->label = "E-Mail";
	$field->attr('id+name','email');
	$field->required = 1;
	$form->append($field); // append the field

	// you get the idea
	$field = $modules->get("InputfieldPassword");
	$field->label = "Passwort";
	$field->attr("id+name","pass");
	$field->required = 1;
	$form->append($field);

	// oh a submit button!
	$submit = $modules->get("InputfieldSubmit");
	$submit->attr("value","Subscribe");
	$submit->attr("id+name","submit");
	$form->append($submit);

	// form was submitted so we process the form
	if($input->post->submit) {

	    // user submitted the form, process it and check for errors
	    $form->processInput($input->post);

	    // here is a good point for extra/custom validation and manipulate fields
    	$email = $form->get("email");

	    if($email && (strpos($email->value,'@hotmail') !== FALSE)){        // attach an error to the field
    	    // and it will get displayed along the field
	        $email->error("Sorry we don't accept hotmail addresses for now.");

    	}

	    if($form->getErrors()) {
    	    // the form is processed and populated
        	// but contains errors
    	    $content .= $form->render();
	    } else {

	        // do with the form what you like, create and save it as page
    	    // or send emails. to get the values you can use
        	// $email = $form->get("email")->value;
	        // $name = $form->get("name")->value;
    	    // $pass = $form->get("pass")->value;
        	//
	        // to sanitize input
    	    // $name = $sanitizer->text($input->post->name);
        	// $email = $sanitizer->email($form->get("email")->value);

	        $content .= "<p>Thanks! Your submission was successful.";

    	}
	} else {
	    // render out form without processing
    	$content .= $form->render();
	}

}; // END if ($user->isLoggedin())
