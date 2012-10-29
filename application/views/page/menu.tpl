<?php
  $liclass      = '';
  $aclass       = '';
  $data_toggle  = '';
  $counter      = 0;
  $liid         = '';
  $target       = '';
?>

  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner thisnavbar">
      <div class="container">
        <a class="brand" href="/home"><?php echo $this->scope->router->sys->brand ?></a>
        <div class="nav-collapse">
          <ul class="nav nav-pills">
            <?php foreach($this->var as $menu): ?>

              <?php

                if(isset($menu['sub'])) {
                  $liclass     .= (strlen($liclass) == 0 ? 'dropdown' : ' dropdown');
                  $aclass       = 'dropdown-toggle';
                  $data_toggle .= ' data-toggle="dropdown"';
                  $liid         = 'target' . $counter;
                  $href         = "href='{$liid}'";
                  $liid         = "id='{$liid}'";
                } else {
                  $liclass      = '';
                  $aclass       = '';
                  $data_toggle  = '';
                  $liid         = '';
                  $href         = "href='/{$menu['url']}'";
                  $target       = '';
                }

                if(preg_match("/{$this->scope->router->orders[0]}/",$menu['url'])) {
                  $liclass .= (strlen($liclass) == 0 ? 'active' : ' active');
                } else {
                  $liclass  .= (strlen($liclass) == 0 ? '' : '');
                }

              ?>

              <li class="<?php echo $liclass ?> <?php echo (isset($menu['spec'])? ' spec_li ' : ''); ?>" <?php echo $liid; ?> >
                <a <?php echo $href; ?> class="<?php echo $aclass ?> <?php echo (isset($menu['spec']) ? ' spec_li_a ' : ''); ?>" <?php echo $data_toggle; ?> ><?php echo $menu['hu']; ?>

                  <?php echo (isset($menu['sub']) ? '<b class="caret"></b>' : ''); ?>

                </a>


                <?php if(isset($menu['sub'])): ?>



                  <ul class="dropdown-menu">

                  <?php foreach($menu['sub'] as $submenu): ?>

                    <li>
                      <a href="/<?php echo $submenu['url'] ?>"><?php echo $submenu['hu']; ?></a>
                    </li>

                  <?php endforeach; ?>

                  </ul>

                <?php endif; ?>
              </li>

            <?php

              $liclass      = '';
              $aclass       = '';
              $data_toggle  = '';
              $liid         = '';
              $target       = '';
              $counter++;
            ?>
            <?php endforeach; ?>

          </ul>
          
            <form class="form-search  pull-right input-append">
              <input id="search" type="text" onclick="$(this).val('');"  value=" Keresés" class="input-small search-query">
            </form>

        </div>
      </div>
    </div>
  </div>