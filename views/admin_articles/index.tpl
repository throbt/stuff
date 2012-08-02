<?php
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<div class="row show-grid">
  <div class="span12">
    <div class="span2">
      <a id="sbm" class="btn btn-primary" href="/node/add/articles" type="submit">Új cikk</a>
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
      <!-- <div class="span1">
        opció
      </div> -->
      <div class="span1">
        opció
      </div>
    </div> <br /><br /><br />

    <div class="span12">&nbsp;</div>

    <?php foreach($this->var['data'] as $article): ?>
      <div class="span12">
        <div class="span2">
          <h4><a class="" href="/node/update/articles/<?php echo $article['nid']; ?>"><?php echo $article['title']; ?></a></h4>
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
        
          <?php if($article['active'] == 1): ?>
            <input model="Article" type="checkbox" rel="<?php echo $article['nid']; ?>" id="active<?php echo $article['nid']; ?>" checked="true" class="active" />
          <?php else: ?>
            <input model="Article" type="checkbox" rel="<?php echo $article['nid']; ?>" id="active<?php echo $article['nid']; ?>" class="active" />
          <?php endif; ?>
        
      </div>
        <!-- <div class="span1">
          <p>
            <a class="btn btn-primary" href="/admin_articles/<?php echo $article['nid']; ?>/edit">edit</a>
          </p>
        </div> -->
        <div class="span1">

          <?php
            echo $form->render(array(

                'form'      => array(
                  'action'    => "/admin_articles/{$article['nid']}",
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
                      'value' => $article['nid']
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
            <a class="btn btn-primary" href="/admin_articles/<?php echo $article['nid']; ?>/edit">Törlés</a>
          </p-->

        </div>
      </div> <br /><br /><br />
    <?php endforeach; ?>
</div>

<?php echo $paginator; ?>
