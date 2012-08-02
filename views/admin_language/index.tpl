<script src="/js/languages.js" type="text/javascript"></script>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Nyelvi elemek
  </li>
</ul>

<div class="control-group input-xlarge">
  <label for="lang">Típusok</label>
  <div class="text">
    <select id="lang" name="lang" class="input-xlarge">
          <option value="">Válasszon</option>
          <?php foreach($this->var['data']['types'] as $type): ?>
            <option value="<?php echo $type['type']; ?>"><?php echo $type['type']; ?></option>
          <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="container">
  <div id="contentWrapper" class="row show-grid">
  </div>
</div>
