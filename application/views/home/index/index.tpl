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
			'type' 			=> 'create',
			'id' 				=> 'nodeForm',
			// its default by empty (default|empty)
			'template'  => 'default' // view: view/form/submit/submit.tpl .. etc
		),
		'elements' 	=> array(
					array(
						'type' 	=> 'text',
						'label' => 'cím',
						'id' 		=> 'title',
						'class' => 'title',
						'name' 	=> 'title'
					),
					array(
						'type' 	=> 'text',
						'label' => 'lead',
						'id' 		=> 'thisLead',
						'class' => 'thisLead',
						'name' 	=> 'lead'
					),
					array(
						'type' 	=> 'text',
						'label' => 'valami',
						'id' 		=> 'valami',
						'class' => 'valami',
						'name' 	=> 'valami'
					),
					array(
						'type' 	=> 'textarea',
						'label' => 'body',
						'id' 		=> 'body',
						'class' => 'body',
						'name' 	=> 'body'
					),
					array(
						'type' 	=> 'submit',
						'id' 		=> 'sbm',
						'class' => 'sbm',
						'value' => 'submit'
					)
		)
	));

?>