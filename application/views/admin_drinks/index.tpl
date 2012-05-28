<?php
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<div class="row show-grid">
  <div class="span12">
    <div class="span1">
      <a id="sbm" class="btn btn-primary save" href="/admin_drinks/add" type="submit">Új ital</a>
    </div>
    <div class="span1">
      <a id="sbm" class="btn btn-primary save" href="/admin_drinks/import" type="submit">Import</a>
    </div>
  </div>
  <div class="span12">
  &nbsp;
  </div>
</div>

<div class="row show-grid">

    <div class="span12">
      <div class="span2">
        <h4><a class="" href="">Cím</a></h4>
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
      <div class="span1">
        <p>
          <strong>aktív</strong>
        </p>
      </div>
      <div class="span1">
        opció
      </div>
      <div class="span1">
        opció
      </div>
    </div>

    <div class="span12">&nbsp;</div>

    <?php foreach($this->var['data'] as $article): ?>
      <div class="span12">
        <div class="span2">
          <h4><a class="" href="/admin_drinks/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h4>
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
        <div class="span1">
        
          <?php if($article['active'] == 'true'): ?>
            <input model="Drinks" type="checkbox" rel="<?php echo $article['id']; ?>" id="active<?php echo $article['id']; ?>" checked="true" class="active" />
          <?php else: ?>
            <input model="Drinks" type="checkbox" rel="<?php echo $article['id']; ?>" id="active<?php echo $article['id']; ?>" class="active" />
          <?php endif; ?>
        
      </div>
        <div class="span1">
          <p>
            <a class="btn btn-primary" href="/admin_drinks/<?php echo $article['id']; ?>/edit">edit</a>
          </p>
        </div>
        <div class="span1">

          <?php
            echo $form->render(array(

                'form'      => array(
                  'action'    => "/admin_drinks/{$article['id']}",
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
