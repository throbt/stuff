<?php
  $all      = $this->var['all'];
  $current  = $this->var['current']
?>

<div class="container">
  <div class="pagination">
      <ul>
        <?php if($current == 1): ?>
          <li class="prev disabled"><a href="#">&larr; Previous</a></li>
        <?php else: ?>
          <li class="prev"><a href="/admin_articles?page=1">&larr; Previous</a></li>
        <?php endif; ?>

        <?php for($i=1;$i<=$all;$i++): ?>
          <?php if($i == $current): ?>
            <li class="active"><a href="/admin_articles?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php else: ?>
            <li><a href="/admin_articles?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if($current == $all): ?>
          <li class="next disabled"><a href="#">Next &rarr;</a></li>
        <?php else: ?>
          <li class="next"><a href="/admin_articles?page=<?php echo $all; ?>">Next &rarr;</a></li>
        <?php endif; ?>
      </ul>
  </div>
</div>