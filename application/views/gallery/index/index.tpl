<div class="page_title">
  <h3 class="first_article_title"><?php echo $this->var['scope']->title; ?></h3>
</div>

<link rel="stylesheet" type="text/css" href="/js/fancybox/source/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/js/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript">

  var thisLoader = function(obj) {
        var imageHeight = parseInt($(obj).height());
        if(imageHeight < 226) {
          $(obj).css('margin-top',(226-imageHeight)/2);
        }
      },
      galleryRunner = function(images) {
        if(typeof images == 'object' && typeof images.length != 'undefined') {
          var arr = [],
              res = [];
          for(var i = 0, l = images.length; i < l; i++) {
            arr.push({
              href  : ['/upload/',images[i]['gallery'],'/',images[i]['name']].join(''),
              title : images[i]['title']
            });
          }
          
          $.fancybox.open(arr);
        }
      };

  $(document).ready(function() {
      $('.gallery_image').click(function() {
        $.get(
          '/ajax/getImagesByGallery',
          {'gallery': $(this).attr('rel')},
          function(resp) {
            galleryRunner($.parseJSON(resp));
          }
        );
      });
  });
</script>

<div id='gallery_container'>
  <?php foreach($this->var['data'] as $gallery): ?>
    <?php if($gallery['name'] != ''): ?>
      <div class='gallery_image_comtainer'>
          <img onload="thisLoader(this)" class="gallery_image" width="298" rel="<?php echo $gallery['id']; ?>" src="/upload/<?php echo $gallery['id']; ?>/<?php echo $gallery['name']; ?>">
      </div>
    <?php endif ; ?>
  <?php endforeach; ?>
</div>

