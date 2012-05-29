<?php
  class Admin_newsletter_controller extends Controller {

    public function init() {
      global $session;
      $this->session = $session;
      if(!$this->session->checkProfile()) {
        //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
        $this->redirect('login');
        die();
      }
      $this->model        = $this->router->loader->get('Newsletter','model');
      $this->itemPerPage  = 15;
    }

    public function index() {

      $res = $this->model->getAll(

        "select
            *
            from
              newsletter
          order by
            adate desc",

        "select
          count(*) as counter
            from
              newsletter",

        array(),

        $this->itemPerPage,

        (isset($this->get['page']) ? $this->get['page'] : 1)
      );

      $this->title   = 'Feliratkozott userek';

      $paginator = $this->view->renderTemplate(
        array(
          'all'     => $res['all'],
          'current' => $res['current'],
          'url'     => implode('/',$this->router->orders)
        ),
        $this->view->getTemplatePath('paginator','paginator')
      );

      $this->content = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $res['result'],
          'paginator' => $paginator
        ),
        $this->view->getTemplatePath('admin_newsletter','index')
      );

      echo $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function update() { //print_r($this->post); die();
      global $session;
      $emails = $this->router->loader->get('newsletter_emails','model');
      if($session->checkToken($this->post['token'])) {
        $emails->update(
          $this->index,
          array(
          'title'         => $this->post['title'],
          'body'          => $this->post['body'],
          'image'         => $this->post['image']
        ));
        $this->redirect("admin_newsletter/emails/{$this->index}");
      } else {
        $this->redirect("admin_newsletter/emails");
      }

    }

    public function email_create() {
      global $session;
      $emails = $this->router->loader->get('newsletter_emails','model');
      if($session->checkToken($this->post['token'])) {
        $emails->create(array(
          'title'         => $this->post['title'],
          'body'          => $this->post['body'],
          'image'         => $this->post['image'],
          'created'       => 'now()'
        ));
        $thisId = $emails->db->lastInsertId();
        $this->redirect("admin_newsletter/emails/{$thisId}");
      } else {
        $this->redirect("admin_newsletter/emails");
      }
    }

    public function create() {
      if(isset($this->router->orders[1]) && $this->router->orders[1] == 'email_create') {
        $this->email_create();
        die();
      }
    }

    public function email_add() {
      
      $this->title   = 'Email hozzáadása';

      $form           = $this->router->loader->get('Form');

      $thisForm       = $form->render(array(

        'form'      => array(
          'action'    => '/admin_newsletter/email_create',
          'method'    => 'post',
          'token'     => true,
          '_method'   => 'create',
          'id'        => 'email_create',
          'class'     => 'well form-horizontal',
          'template'  => 'default'
        ),

        'elements'  => array(

            array(
              'type'  => 'text',
              'label' => 'Cím',
              'id'    => 'title',
              'class' => 'input-xlarge',
              'name'  => 'title'
            ),

            array(
              'type'  => 'hidden',
              'value' => '',
              'id'    => 'node_image',
              'name'  => 'image'
            ),

            array(
              'type'  => 'special',
              'html'  => '
                <div class="control-group">
                  <button id="sbm" class="btn btn-primary imager" type="button">Kép választása</button>
                </div>
              '
            ),

            array(
              'type'  => 'textarea',
              'label' => 'Tartalom',
              'id'    => 'body',
              'class' => 'input-xlarge',
              'name'  => 'body'
            ),

            array(
              'type'  => 'submit',
              'id'    => 'sbm',
              'class' => 'btn btn-primary',
              'value' => 'Ment'
            )
        )
      ));

      $this->content = $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $thisForm
        ),
        $this->view->getTemplatePath('admin_newsletter','email_add')
      );

      echo $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function email_edit() {
      $emails       = $this->router->loader->get('newsletter_emails','model');
      $thisEmail    = $emails->get($this->index);
      $this->title  = $thisEmail[0]['title'] . ' - szerkesztés';
      $form         = $this->router->loader->get('Form');

      $thisSpecial    = ($thisEmail[0]['image'] == 0 ? '<button id="sbm" class="btn btn-primary imager" type="button">Kép választása a lista nézethez</button>'
        : "<label>kép:</label><img class='modalGalleryImg imager' rel='{$thisEmail[0]['gallery']}' src='/upload/{$thisEmail[0]['gallery']}/{$thisEmail[0]['name']}'>"
      );

      $thisForm     = $form->render(array(

          'form'      => array(
            'action'    => "/admin_newsletter/{$thisEmail[0]['id']}",
            'method'    => 'post',
            'token'     => true,
            '_method'   => 'update',
            'id'        => 'email_update',
            'class'     => 'well form-horizontal',
            'template'  => 'default'
          ),

          'elements'  => array(

              array(
                'type'  => 'text',
                'label' => 'Cím',
                'id'    => 'title',
                'class' => 'input-xlarge',
                'name'  => 'title',
                'value' => $thisEmail[0]['title']
              ),

              array(
                'type'  => 'hidden',
                'value' => '',
                'id'    => 'node_image',
                'name'  => 'image',
                'value' => $thisEmail[0]['image']
              ),

              array(
                'type'  => 'special',
                'html'  => '
                  <div class="control-group">
                   '.$thisSpecial.'
                  </div>
                '
              ),

              array(
                'type'  => 'textarea',
                'label' => 'Tartalom',
                'id'    => 'body',
                'class' => 'input-xlarge',
                'name'  => 'body',
                'value' => $thisEmail[0]['body']
              ),

              array(
                'type'  => 'submit',
                'id'    => 'sbm',
                'class' => 'btn btn-primary',
                'value' => 'Ment'
              )
          )
        ));
        
        $this->content = $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $thisForm,
            'id'      => $thisEmail[0]['id']
          ),
          $this->view->getTemplatePath('admin_newsletter','email_edit')
        );

        echo $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $this->content
          ),
          $this->view->getTemplatePath('admin','main')
        );
    }

    public function email_show() {
      $emails       = $this->router->loader->get('newsletter_emails','model');
      $thisEmail    = $emails->get($this->index);
      $this->title  = $thisEmail[0]['title'];
      if(isset($this->index) || $this->index != 0) {
        $this->content = $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $thisEmail[0]
          ),
          $this->view->getTemplatePath('admin_newsletter','email_show')
        );

        echo $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $this->content
          ),
          $this->view->getTemplatePath('admin','main')
        );
      }

    }

    public function email_test() {
      
      $this->title  = 'Tesztküldés';
      $form         = $this->router->loader->get('Form');
      $thisForm     = $form->render(array(

          'form'      => array(
            'action'    => "",
            'method'    => 'post',
            'token'     => true,
            '_method'   => 'update',
            'id'        => 'email_update',
            'class'     => 'well form-horizontal',
            'template'  => 'default'
          ),

          'elements'  => array(

              array(
                'type'  => 'hidden',
                'id'    => 'id',
                'class' => '',
                'name'  => 'id',
                'value' => $this->index
              ),

              array(
                'type'  => 'text',
                'label' => 'test1',
                'id'    => 'test1',
                'class' => 'input-xlarge emails',
                'name'  => 'test1'
              ),

              array(
                'type'  => 'text',
                'label' => 'test2',
                'id'    => 'test2',
                'class' => 'input-xlarge emails',
                'name'  => 'test2'
              ),

              array(
                'type'  => 'text',
                'label' => 'test3',
                'id'    => 'test3',
                'class' => 'input-xlarge emails',
                'name'  => 'test3'
              ),

              array(
                'type'  => 'submit',
                'id'    => 'thisSubmit',
                'class' => 'btn btn-primary',
                'value' => 'Elküld'
              )
          )
        ));
        
        $this->content = $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $thisForm
          ),
          $this->view->getTemplatePath('admin_newsletter','test')
        );
        
        echo $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $this->content
          ),
          $this->view->getTemplatePath('admin','main')
        );
    }

    public function email_sendmail() {
    
      $users  = $this->router->loader->get('newsletter','model');
      
      $active = $users->get(
        '',
        array(
          "
            select
              count(*) as counter
                from
                  newsletter
            where
            	active = 'true'
          ",
          array()
        )
      );
      
      $inactive = $users->get(
        '',
        array(
          "
            select
              count(*) as counter
                from
                  newsletter
            where
            	active != 'true'
          ",
          array()
        )
      );
    
      $this->content = $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => array(
              'active'    => $active[0]['counter'],
              'inactive'  => $inactive[0]['counter'],
              'index'     => $this->index
            )
          ),
          $this->view->getTemplatePath('admin_newsletter','sendmail')
        );
        
        echo $this->view->renderTemplate(
          array(
            'scope'   => $this,
            'data'    => $this->content
          ),
          $this->view->getTemplatePath('admin','main')
        );
    }
    
    public function email_send() {
    
      $emails = $this->router->loader->get('newsletter_emails','model');
      $mailer = $this->router->loader->get('Mailer');
      $body   = $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $emails->get($this->index)
        ),
      $this->view->getTemplatePath('admin_newsletter','mail')
      );
      
      $usersMod   = $this->router->loader->get('newsletter','model');
      $users      = $usersMod->get(
        '',
        array(
          "
            select
              *
                from
                  newsletter
            where
            	active = 'true'
          ",
          array()
        )
      );
      
      foreach($users as $user) {
        $mailer->simpleSend($user['email'],$user['name'],'Manna hírlevél',trim($body));
      }
      
      $this->redirect('admin_newsletter');
    }

    public function emails() {

      if(isset($this->router->orders[2]) && $this->router->orders[2] == 'add') {
        $this->email_add();
        die();
      }

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0 && !isset($this->router->orders[3])) {
        $this->index = $this->router->orders[2];
        $this->email_show();
        die();
      }

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0 && isset($this->router->orders[3]) && $this->router->orders[3] == 'edit') {
        $this->index = $this->router->orders[2];
        $this->email_edit();
        die();
      }

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0 && isset($this->router->orders[3]) && $this->router->orders[3] == 'test') {
        $this->index = $this->router->orders[2];
        $this->email_test();
        die();
      }

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0 && isset($this->router->orders[3]) && $this->router->orders[3] == 'sendmail') {
        $this->index = $this->router->orders[2];
        $this->email_sendmail();
        die();
      }
      
      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0 && isset($this->router->orders[3]) && $this->router->orders[3] == 'send') {
        $this->index = $this->router->orders[2];
        $this->email_send();
        die();
      }
      
      $this->title  = 'Emailek';
      $emails       = $this->router->loader->get('newsletter_emails','model');
      $res          = $emails->getAll(

        "select

          e.*,
          i.gallery,
          i.name

        from
          newsletter_emails e

        left join
          images i
        on
          e.image = i.id

        order by
          e.created desc",

        "select
          count(*) as counter
            from
              newsletter_emails",

        array(),

        $this->itemPerPage,

        (isset($this->get['page']) ? $this->get['page'] : 1)
      );

      $paginator = $this->view->renderTemplate(
        array(
          'all'     => $res['all'],
          'current' => $res['current'],
          'url'     => implode('/',$this->router->orders)
        ),
        $this->view->getTemplatePath('paginator','paginator')
      );

      $this->content = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $res['result'],
          'paginator' => $paginator
        ),
        $this->view->getTemplatePath('admin_newsletter','emails')
      );

      echo $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function showemail() {
      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
        $this->index    = (int)$this->router->orders[2];
        $emails         = $this->router->loader->get('newsletter_emails','model');
        $this->content  = $emails->get($this->index);
        //print_r($thisStuff);

        echo $this->view->renderTemplate(
            array(
              'scope'   => $this,
              'data'    => $this->content
            ),
          $this->view->getTemplatePath('admin_newsletter','mail')
        );
      }
    }

  }
?>
