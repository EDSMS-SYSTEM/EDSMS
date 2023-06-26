<?php 

function output_errors($errors){
	 $output=array();

	foreach ($errors as $error) {
		$output[]= '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>'. $error ;
		
	}
	return '<div class="alert alert-danger" role="alert">  '. implode(' ', $output) . '</div>';
	}

function output_success($success){
	 $outputs=array();

	foreach ($success as $succ) {
		$outputs[]= '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only"></span>'. $succ ;
		
	}
	return '<div class="alert alert-success" role="alert">  '. implode(' ', $outputs) . '</div>';
	}
?>