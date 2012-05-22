<?php
	global $stuff; //print_r($stuff);
?>


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
			<p class="index_article_title"><a class="index_title_link" href="/cikkek/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></p>
		</div>
		<div class="index_node_lead">
				<?php echo $article['lead']; ?>
		</div>


<?php
  endif;
  endforeach; ?>