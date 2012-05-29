<?php

class Bookings_controller extends Controller {
  
  public function init() {
    $this->model = $this->router->loader->get('Bookings','model');
  }
  
  public function index() {

    $langMod        = $this->router->loader->get('Langelements','model');
    $lang           = $_SESSION['language'];
    $langElements   = $langMod->map($langMod->get(
      '',
      array(
        "select
          *
          from
            langelements
          where
            type = 'booking';
        ",
        array()
      )
    ));

    $form           = $this->router->loader->get('Form');

    $thisForm       = $form->render(array(

      'form'      => array(
        'action'    => "/bookings/create",
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'create',
        'id'        => 'create_booking',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'      => array(

          array(
            'type'  => 'text',
            'label' => $langElements['day_of_booking'][$lang],
            'id'    => 'bookin_day',
            'class' => '',
            'name'  => 'bookin_day'
          ),

          array(
            'type'  => 'text',
            'label' => $langElements['email'][$lang],
            'id'    => 'email',
            'class' => '',
            'name'  => 'email'
          ),

          array(
            'type'  => 'text',
            'label' => $langElements['phone'][$lang],
            'id'    => 'phone',
            'class' => '',
            'name'  => 'phone'
          ),

          array(
            'type'  => 'special',
            'html'  => '
              <div class="control-group ">
                <label>'.$langElements['persons'][$lang].'</label><div class="text"><select id="dateSelect" class="input" name="persons">
                    <option value="">'.$langElements['choose'][$lang].'</option>
                    <option value="1">1 főre</option>
                    <option value="2">2 főre</option>
                    <option value="3">3 főre</option>
                    <option value="4">4 főre</option>
                    <option value="5">5 főre</option>
                    <option value="6">6 főre</option>
                    <option value="7">7 főre</option>
                    <option value="8">8 főre</option>
                    <option value="8+">több főre</option>
                  </select></div>
              </div>
            '
          ),

          array(
            'type'  => 'special',
            'html'  => '
              <div class="control-group ">
                <label>'.$langElements['time'][$lang].'</label><div class="text"><select id="dateSelect" class="input" name="bookin_time">
                    <option value="">'.$langElements['choose'][$lang].'</option>
                    <option value="10:00:00">10:00</option>
                    <option value="11:00:00">11:00</option>
                    <option value="12:00:00">12:00</option>
                    <option value="13:00:00">13:00</option>
                    <option value="14:00:00">14:00</option>
                    <option value="15:00:00">15:00</option>
                    <option value="16:00:00">16:00</option>
                    <option value="17:00:00">17:00</option>
                    <option value="18:00:00">18:00</option>
                    <option value="19:00:00">19:00</option>
                    <option value="20:00:00">20:00</option>
                    <option value="21:00:00">21:00</option>
                    <option value="22:00:00">22:00</option>
                  </select></div>
              </div>
            '
          ),

          /*array(
            'type'  => 'text',
            'label' => 'A foglalás időpontja:',
            'id'    => 'bookin_time',
            'class' => '',
            'name'  => 'bookin_time'
          ),*/

          array(
            'type'  => 'textarea',
            'label' => $langElements['description'][$lang],
            'id'    => 'bookin_description',
            'class' => '',
            'name'  => 'bookin_description'
          ),

          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => $langElements['save'][$lang],
          )
      ),

    )); 

    $this->title    = $langElements['booking'][$lang];
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->title,
        'lang'  => $langElements,
        'form'  => $thisForm
      ),
      $this->view->getTemplatePath('bookings','index')
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

    /*$article        = $this->model->get($this->index);
    $this->title    = $article[0]['title'];
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $article
      ),
      $this->view->getTemplatePath('cikkek','show')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    ); */
  }
  
  public function create() {
    global $session;

    $bookin_time = $this->post['bookin_time'] != '' ? $this->post['bookin_time'] : '00:00:00';

    if($session->checkToken($this->post['token'])) {
      $this->model->create(array(
        'booking_time'  => "{$this->post['bookin_day']} {$bookin_time}",
        'title'         => 'asztalfoglalás',
        'body'          => $this->post['bookin_description'],

        'email'         => $this->post['email'],
        'phone'         => $this->post['phone'],
        'persons'       => $this->post['persons'],

        'created'       => 'now()'
      ));
      $this->redirect("bookings");
    } else {
      $this->redirect("bookings");
    }
  }

  public function update() {
    echo 'update';
  }
  
  public function delete() {
    echo 'delete';
  }
}