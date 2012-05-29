<?php
  $article = $this->var['data'][0]; //print_r($article);
?>
<div class="page_title">
  <h3 class="first_article_title"><a class="" href="/<?php echo $this->link("cikkek/{$article['id']}"); ?>"><?php echo $article['title']; ?></a></h3>
</div>

<div class="page_content">
  <?php echo $article['body']; ?>
</div>