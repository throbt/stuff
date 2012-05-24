<?php
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<div class="row show-grid">
  <div class="span12">
    <div class="span2">
      <a id="sbm" class="btn btn-primary save" href="/admin_booking/add" type="submit">Új foglalás</a>
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
          <strong> a foglalás időpontja</strong>
        </p>
      </div>
      <!-- <div class="span1">
        <p>
          <strong>aktív</strong>
        </p>
      </div> -->
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
          <h4><a class="" href="/admin_booking/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h4>
        </div>
        <div class="span2">
          <p>
            <?php echo $article['created']; ?>
          </p>
        </div>
        <div class="span2">
          <p>
            <?php echo $article['booking_time']; ?>
          </p>
        </div>
        <div class="span1">
        
      </div>
        <div class="span1">
          <p>
            <a class="btn btn-primary" href="/admin_booking/<?php echo $article['id']; ?>/edit">edit</a>
          </p>
        </div>
        <div class="span1">

          <?php
            echo $form->render(array(

                'form'      => array(
                  'action'    => "/admin_booking/{$article['id']}",
                  'method'    => 'post',
                  'token'     => true,
                  '_method'   => 'delete',
                  'id'        => 'delete_booking',
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
