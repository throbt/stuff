<div class="page_title">
  <h3 class="first_article_title"><?php echo $this->var['scope']->title; ?></h3>
</div>

<?php //print_r($this->var['data']); ?>

<div id="drinks_wrapper" class="">

  <?php foreach($this->var['data'] as $k => $v): ?> <?php //print_r($v); ?>
    <div class="index_node_title">

      <div class="index_left_margin foods"></div>
      <p class="index_article_title"><?php echo $k; ?></p>
    </div>

        <?php foreach($this->var['data'][$k] as $food): ?>

        <div class="line_drinx">
          <div class="line_drinx_left"></div>
          <div class="line_drinx_content"><?php echo $food['title']; ?></div>
          <div class="line_drinx_price"><?php echo $food['price']; ?>.- Ft</div>
        </div>

        <?php endforeach; ?>


  <?php endforeach; ?>

</div>