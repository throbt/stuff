<?php
	global $stuff; //print_r($stuff);
?>

<div class="page_title">
	<h3 class="first_article_title"><a class="" href="#">A Manna programajánlója</a></h3>
</div>

<?php
	foreach($this->var['data'] as $article):
  if($article['title'] != 'index_action'):
?>

	<!-- <p class="node_title"><span class="left_margin"></span><?php echo $article['title']; ?></p> -->

	
		<div class="index_node_title">
			<div class="index_left_margin">

				<?php
					$thisDate = $stuff->getDateformatToFe($article['created']);
				?>

				<span class="month"><?php echo $thisDate[1]; ?></span><br />
				<span class="thisDay"><?php echo $thisDate[2]; ?></span>

			</div>
			<p class="index_article_title"><a class="index_title_link" href="<?php echo $this->link("programmes/{$article['id']}"); ?>"><?php echo $article['title']; ?></a></p>
		</div>
		<div class="index_node_lead">
				<?php echo $article['lead']; ?>
		</div>


<?php
  endif;
  endforeach; ?>