<?php
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Positions
  </li>
</ul>

<div class="row show-grid">
  <div class="span12">
    <div class="span2 innerNav">
      <a id="sbm" class="btn btn-toggle save" href="/admin_positions/add" type="submit">New position</a>
    </div>

    <div class="span2 innerNav">
      <a id="sbm" class="btn btn-toggle save" href="/admin_positions/location" type="submit">New location</a>
    </div>

    <div class="span2 innerNav">
      <a id="sbm" class="btn btn-toggle save" href="/admin_positions/type" type="submit">New type</a>
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
      <!-- div class="span1">
        opció
      </div -->
      <div class="span1">
        opció
      </div>
    </div>

    <div class="span12">&nbsp;</div>

    <?php foreach($this->var['data'] as $article): ?>
      <div class="span12">
        <div class="span2">
          <h4><a class="" href="/admin_positions/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h4>
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
            <input model="Positions" type="checkbox" rel="<?php echo $article['id']; ?>" id="active<?php echo $article['id']; ?>" checked="true" class="activespec" />
          <?php else: ?>
            <input model="Positions" type="checkbox" rel="<?php echo $article['id']; ?>" id="active<?php echo $article['id']; ?>" class="activespec" />
          <?php endif; ?>

      </div>
        <!-- div class="span1">
          <p>
            <a class="btn btn-success" href="/admin_positions/<?php echo $article['id']; ?>/edit">edit</a>
          </p>
        </div -->
        <div class="span1">

          <?php
            echo $form->render(array(

                'form'      => array(
                  'action'    => "/admin_positions/del",
                  'method'    => 'post',
                  'token'     => true,
                  '_method'   => '',
                  'id'        => 'delete_position',
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
                      'class' => 'btn btn-danger',
                      'value' => 'Törlés'
                    )
                )
            ));
          ?>

          <!--p>
            <a class="btn btn-primary" href="/admin_positions/<?php echo $article['id']; ?>/edit">Törlés</a>
          </p-->

        </div>
      </div>
    <?php endforeach; ?>
</div>

<?php echo $paginator; ?>
