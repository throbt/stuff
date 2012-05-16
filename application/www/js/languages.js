$(document).ready(function() {
  $('#lang').change(function() {
    if($(this).val() != '') {
      Lang.getElementsByType($(this).val());
    }
  });
});

var Lang = {

  getElementsByType: function(type) {
    var self = this;
    $.get(
      '/admin_ajax/getLangElementsByType',
      {'type' : type},
      self.displayElements
    );
  },
  
  displayElements: function(resp) {
    console.log($.parseJSON(resp));
  }
}
