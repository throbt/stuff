<?php

  //print_r($this->var['data']);
  //$mainhelper = $loader->get('Main','helper');
	//echo $this->var['data'];
	//echo "asdsadsadsadsad";
	
	global $loader;
	$form = $loader->get('Form');

	echo $form->render(array(
		'form' 			=> array(
			
			'action' 		=> '/test',
			'method' 		=> 'post',
			'type' 			=> 'put',
			'id' 				=> 'nodeForm'
		),
		'elements' 	=> array(

			'text' 			=> array(
				'id' 		=> 'title',
				'class' => 'title',
				'name' 	=> 'title'
			),
			'text' 			=> array(
				'id' 		=> 'lead',
				'class' => 'lead',
				'name' 	=> 'lead'
			),
			'textarea' 	=> array(
				'id' 		=> 'body',
				'class' => 'body',
				'name' 	=> 'body'
			)
		)
	));

?>