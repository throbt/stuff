<?php
	global $stuff; //print_r($this->var['data']);
?>


<?php
	$counter = 0;
	foreach($this->var['data'] as $article):
  if($article['title'] != 'index_action'):
?>

	<?php if($counter == 0): ?>

		<div class="page_title">
			<h3 class="first_article_title"><a class="" href="/cikkek/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h3>
		</div>

		<div class="article_wrapper_first">
			<div class="article_img_wrapper">

					<?php

						$imgPath = '';
						if($article['image'] == 0) {
							$imgPath = '/img/article_bianco.jpg';
						} else {
							$imgPath = "/upload/{$article['gallery']}/{$article['name']}";
						}
					?>

					<img class="article_image" src="<?php echo $imgPath; ?>" width="298" />

			</div>

			<div class="article_lead_container">
				<div class="article_lead_wrapper">
					<span class=".index_article_lead"><?php echo $stuff->textCutter($article['lead'], 230) . ' ...'; ?></span>
				</div>
				<div class="article_lead_next_wrapper">
					<a class="article_next" href="/cikkek/<?php echo $article['id']; ?>">Tovább>></a>
				</div>
			</div>

		</div>

	<?php else: ?>

	<div class="article_wrapper">
		<div class="article_header">

			<h3 class="article_title"><a class="" href="/cikkek/<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h3>

		</div>
		<div class="article_img_wrapper">

			<?php

				$imgPath = '';
				if($article['image'] == 0) {
					$imgPath = '/img/article_bianco.jpg';
				} else {
					$imgPath = "/upload/{$article['gallery']}/{$article['name']}";
				}
			?>

			<img class="article_image" src="<?php echo $imgPath; ?>" width="298" />

		</div>

		<div class="article_lead_container">
			<div class="article_lead_wrapper">
				<span class=".index_article_lead"><?php echo $stuff->textCutter($article['lead'], 230) . ' ...'; ?></span>
			</div>
			<div class="article_lead_next_wrapper">
				<a class="article_next" href="/cikkek/<?php echo $article['id']; ?>">Tovább>></a>
			</div>
		</div>

	</div>

<?php endif; ?>

<?php
	$counter++;
  endif;
  endforeach; ?>