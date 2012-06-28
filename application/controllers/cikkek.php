<?php

class Cikkek_controller extends Controller {
  
  public function init() {
    $this->model = $this->router->loader->get('Article','model');
  }
  
  public function index() {

    $this->title    = 'Manna';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->model->get(
          '',
          array(
            "
              select
				
					      a.*,
					      i.gallery as gallery,
					      i.name as name
					
				      from
					      article a
					
				      left join
				        images i
			            on
			              a.image = i.id
			          
				      where
					      a.lang = ?;
            ",
            array($_SESSION['language'])
          )
        )
      ),
      $this->view->getTemplatePath('cikkek','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }
  
  public function show() {

    $article        = $this->model->get($this->index);

    $this->title    = $article[0]['title'];

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->model->codeItForContent($article)
      ),
      $this->view->getTemplatePath('front','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }
  
  public function thisTest() {
    echo 'thisTest';
  }

  public function create() {
    print_r($this->router->params);
    echo 'create';
  }

  public function update() {
    echo 'update';
  }
  
  public function delete() {
    echo 'delete';
  }
}
