// $(window).load(function() {
//   $('#happening').nivoSlider({
//     effect: 'sliceDown'// Specify sets like: 'fold,fade,sliceDown', 'random'
//     // slices: 15, // For slice animations
//     // boxCols: 8, // For box animations
//     // boxRows: 4, // For box animations
//     // animSpeed: 500, // Slide transition speed
//     // pauseTime: 3000, // How long each slide will show
//     // startSlide: 0, // Set starting Slide (0 index)
//     // directionNav: true, // Next & Prev navigation
//     // directionNavHide: true, // Only show on hover
//     // controlNav: false, // 1,2,3... navigation
//     // controlNavThumbs: false, // Use thumbnails for Control Nav
//     // controlNavThumbsFromRel: false, // Use image rel for thumbs
//     // controlNavThumbsSearch: '.jpg', // Replace this with...
//     // controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
//     // keyboardNav: true, // Use left & right arrows
//     // pauseOnHover: true, // Stop animation while hovering
//     // manualAdvance: false, // Force manual transitions
//     // captionOpacity: 0.8, // Universal caption opacity
//     // prevText: 'Vissza', // Prev directionNav text
//     // nextText: 'Tovább', // Next directionNav text
//     // randomStart: false, // Start on a random slide
//     // beforeChange: function(){}, // Triggers before a slide transition
//     // afterChange: function(){}, // Triggers after a slide transition
//     // slideshowEnd: function(){}, // Triggers after all slides have been shown
//     // lastSlide: function(){}, // Triggers when last slide is shown
//     // afterLoad: function(){} // Triggers when slider has loaded
//   });

//   $('.langLink').click(function() {
//     var link = window.location.href;
//     if(link.match(/\?/)) {
//       if(link.match("lang")) {
//         window.location.href = window.location.href.replace(/lang=(hu|en|de)/, ["lang=",this.id].join(""));
//       } else {
//         window.location.href = [link,'&lang=',this.id].join('');
//       }
//     } else {
//       window.location.href = [link,'?lang=',this.id].join('');
//     }
//     return false;
//   });
// });