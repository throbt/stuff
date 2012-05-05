<?php

class Test_controller extends Controller {
	
  public function init() {
    $this->model = $this->loader->get('Test','model');
  }
  
  public function index() {
		echo 
		'<form action="/test/4" method="post">
			<input type="hidden" name="_method" value="delete" />
			<input type="hidden" name="t1" value="sdfsfsdfsdf" />
			<input type="hidden" name="t2" value="masvalami?sdfsdfsdfsdfsdf" />
			<input type="hidden" name="t3" value="egyebvalamisdfsdfsdfsdf" />
			<input type="submit" value="go" />
		</form>';
  }
  
  public function show() {
		if($this->index != null) {
			$res = $this->model->get($this->index);  print_r($res);
		}
  }
  
  public function thisTest() {
    echo 'thisTest';
  }

  public function create() {
	
    $this->model->create(array(
			't1' => $this->post['t1'],
			't2' => $this->post['t2'],
			't3' => $this->post['t3']
		));
		
		/* or */
		
		$this->model->create('',
			array(
				"
					insert
						into
							test
						(t1,t2,t3)
					values
						(?,?,?);
				",
				array(
					$this->post['t1'],
					$this->post['t2'],
					$this->post['t3']
				)
			)
		);
  }

	public function update() {
		
    $this->model->update($this->index,array(
			't1' => $this->post['t1'],
			't2' => $this->post['t2'],
			't3' => $this->post['t3']
		));

		/* or */

		$this->model->update('','',
			array(
				"
					update
						test
						set
						t1 = ?,
						t2 = ?,
						t3 = ?
					where
						id = ?;
				",
				array(
					'egy',
					'ketto',
					'harom',
					$this->index
				)
			)
		);
  }
	
	public function delete() {
		
    $this->model->delete($this->index);

		/* or */
		
		$this->model->delete('',
			array(
				"
					delete
						from
							test
					where
						id = ?
				",
				array($this->index)
			)
		);
  }
}