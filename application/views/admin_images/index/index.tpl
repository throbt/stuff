<script src="/js/galleries_index.js" type="text/javascript"></script>
<div class="control-group input-xlarge">
  <a id="sbm" class="btn btn-primary save" href="/admin_articles/add" type="submit">Új kép</a>
  <div class="span12">
  &nbsp;
  </div>
</div>
<div class="control-group input-xlarge">
  <label for="lang">galériák</label>
  <div class="text">
    <select id="galleries" name="galleries" class="input-xlarge">
          <option value="">Válasszon</option>
          <?php foreach($this->var['galleries'] as $gallery): ?>
            <option value="<?php echo $gallery['id']; ?>"><?php echo $gallery['title']; ?></option>
          <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="container">
  <div id="contentWrapper" class="row show-grid">
  </div>
</div>
