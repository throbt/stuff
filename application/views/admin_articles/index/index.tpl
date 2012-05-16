<?php
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<div class="row show-grid">

    <div class="span12">
      <div class="span2">
        <h4><a class="" href="/admin_articles/<?php echo $article['id']; ?>">Cím</a></h4>
      </div>
      <div class="span2">
        <p>
          <strong>létrehozva</strong>
        </p>
      </div>
      <div class="span2">
        <p>
          <strong>utolsó szerkesztés</strong>
        </p>
      </div>
      <div class="span2">
      </div>
      <div class="span2">
      </div>
    </div>

    <div class="span12">&nbsp;</div>

    <?php foreach($this->var['data'] as $article): ?>
      <div class="span12">
        <div class="span2">
          <h4><a class="" href="/admin_articles/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h4>
        </div>
        <div class="span2">
          <p>
            <?php echo $article['created']; ?>
          </p>
        </div>
        <div class="span2">
          <p>
            <?php echo $article['edited']; ?>
          </p>
        </div>
        <div class="span2">
          <p>
            <a class="btn btn-primary" href="/admin_articles/<?php echo $article['id']; ?>/edit">Szerkesztés</a>
          </p>
        </div>
        <div class="span2">

          <?php
            echo $form->render(array(

                'form'      => array(
                  'action'    => "/admin_articles/{$article['id']}",
                  'method'    => 'post',
                  'token'     => true,
                  '_method'   => 'delete',
                  'id'        => 'delete_article',
                  'template'  => 'default'
                ),

                'elements'  => array(

                    array(
                      'type'  => 'hidden',
                      'id'    => 'id',
                      'name'  => 'id',
                      'value' => $article['id']
                    ),
                    array(
                      'type'  => 'submit',
                      'id'    => 'sbm',
                      'class' => 'btn btn-primary',
                      'value' => 'Törlés'
                    )
                )
            ));
          ?>

          <!--p>
            <a class="btn btn-primary" href="/admin_articles/<?php echo $article['id']; ?>/edit">Törlés</a>
          </p-->

        </div>
      </div>
    <?php endforeach; ?>
</div>

<?php echo $paginator; ?>