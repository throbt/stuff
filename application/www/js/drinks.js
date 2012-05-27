var Drinks = {
  get:  function() {

    $.get(
      '/ajax/getDrinksByCat',
      {'cat': $('.mehidden').val()},
      function(resp) {
        Drinks.drinks = $.parseJSON(resp);
        Drinks.build();
      }
    );
  },

  build: function() {
    var drinks  = Drinks.drinks,
        arr     = [],
        content = [],
        notWine = {
          'Rövid Italok és Whiskey'             : '',
          'Sör, Vermut, Likőr és Rövid italok'  : '',
          'Ásványvíz, Üdítő italok, Kávé - Tea' : ''
        };

    for(var i in drinks) {
      arr = [
        '<div class="index_node_title">',
          '<div class="index_left_margin drinx">',
          '</div>',
          '<p class="index_article_title">',
          i,
          '</p>',
          '<p class="index_article_title_price">',

          (typeof notWine[$('.mehidden').val()] != 'undefined' ? '' : '<span class="glass">pohár</span><span class="bottle">üveg</span>'),

          
          '</p>',
        '</div>'
      ];
      arr.push(Drinks.getBody(drinks[i]));
      content.push(arr.join(''));
    }

    $('#drinks_wrapper').html(content.join(''));
  },

  getBody: function(thisDrinks) { 
    var arr     = [],
        content = [];
    for(var i = 0, l = thisDrinks.length; i < l; i++) {
      arr = [
        '<div class="line_drinx">',
          '<div class="line_drinx_left">',
          '</div>',
          '<div class="line_drinx_content">',
            (thisDrinks[i]['body'] != '' ? '<a href="/drinks/'+thisDrinks[i]['id']+'">'+thisDrinks[i]['title']+'</a>' : thisDrinks[i]['title']),
          '</div>',
          '<div class="line_drinx_price_glass">',
            (thisDrinks[i]['priceglass'] != '' ? thisDrinks[i]['priceglass'] + '.- Ft' : ''),
          '</div>',
          '<div class="line_drinx_price">',
            thisDrinks[i]['pricebottle'],
          '.- Ft</div>',
        '</div>'
      ];
      content.push(arr.join(''));
    }
    return content.join('');
  }
}