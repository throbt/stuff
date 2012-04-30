var thisUrlEncode = function(str) {
  var result = [];
  for(var i = 0,l = str.length; i < l; i++) {
    result.push(urlencode(str[i]));
  }
  return result.join('');
}
var urlencode = function(str) {
    str = escape(str);
    str = str.replace('+','%2B');
    str = str.replace('%20','+');
    str = str.replace('*','%2A');
    str = str.replace('/','%2F');
    str = str.replace('@','%40');
  return str;
}
var insertInput = function(type,cfg,selector) {
  window.clickedCache = '';
  var selector        = (typeof selector != 'undefined' ? selector : '.editable'),
      thisSelect      = (type == 'select' ? function(id) {
        var arr = [];
        arr.push('<select id="editor" rel="',id,'">');
        for(var i in cfg) {
          arr.push('<option value="',i,'">',i,'</option>');
        }
        arr.push('</select>');
        return arr.join('');
      } : function(id) {
        return ['<input type="text" rel="',id,'" id="editor" />'].join('')
      });
  $(selector).click(function() {
    if(clickedCache != '') {
      writeCell();
    }
    var thisContent = $(this).html();
    if(this.id != clickedCache) {
      $(this).html((type == 'select' ? thisSelect(this.id) : thisSelect(this.id)));
      $('#editor').val(thisContent);
      $('#editor').focus();
      clickedCache = this.id;
    } else {
      writeCell(this);
      clickedCache = '';
    }
  });
  var writeCell = function(obj) {
    $(['#',clickedCache].join('')).html($('#editor').val());
  }
}
var Utf8 = {
  encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = '';
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
	decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}
