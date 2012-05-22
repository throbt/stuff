<div class="well form-horizontal">
  <?php
    //name content language priceglass pricebottle date categories place type winery title keywords description
  ?>

  <label>csv mezők:</label>
  <p class="">(A sorok pontosvesszővel, az oszlopok vesszővel legyenek elválasztva.)</p>

  <p class="lead">
    <ul>
      <li>name</li>
      <li>content</li>
      <li>language</li>
      <li>priceglass</li>
      <li>pricebottle</li>

      <li>date <small>(yyyy-mm-dd | yyyy.mm.dd)</small></li>
      <li>categories</li>
      <li>place</li>
      <li>type</li>
      <li>winery</li>
      <li>title</li>
      <li>keywords</li>
      <li>description</li>
    </ul>
  </p>


<!-- </div>
<div class="container"> -->
  <?php
    echo $this->var['data'];
  ?>
</div>