<div class="page_title">
  <h3 class="first_article_title"><?php echo $this->var['scope']->title; ?></h3>
</div>



<div class="drinks_container">
    <script src="/js/drinks.js" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
      $('.thisButton').click(function() {
        $('.selectBox').slideToggle(100).css('borderTop', 'none');
      });

      $('.selectBox li').click(function() {
        $('.mehidden').val($(this).text());
        $('.default').text($(this).text());
        $('.selectBox').slideUp(100,function() {
          Drinks.get();
        });
      });
    });

    </script>
    <div id="container"> 
        <span class="arrow thisButton">&or;</span> <span class="default thisButton">Kategóriák</span>
        <input type="hidden" value="" class="mehidden"/>
        <ul class="selectBox">
          
          <?php foreach($this->var['data'] as $category): ?>
            <li><?php echo $category['categories']; ?></li>
          <?php endforeach; ?>
        </ul>
    </div>

</div>

<div id="drinks_wrapper" class="">
</div>