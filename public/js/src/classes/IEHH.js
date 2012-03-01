// iframe hack for the ie history featureless
Ext.define('IEHH', {

  statics: {

    DEPO: "",
    
    init: function(){
      navigator.appName.match("Microsoft") != null ? this.setup() : "";
    },
  
    setup: function(){
  
      var thisIframe  = document.createElement('<iframe id="thisIframe" style="display:none;" src="about:blank" />'),
          thisBody  = document.getElementsByTagName("body")[0];
        
      document.appendChild(thisIframe);
    
      Ext.TaskManager.start({
        run: IEHH.checkIframeContent,
        interval: 1000
      });
    },
  
    changeContent: function(urlPart){
      var thisIframe    = document.getElementById("thisIframe"),
          thisIframeDoc = thisIframe.contentWindow.document;

      thisIframeDoc.open();
      thisIframeDoc.write(urlPart);
      thisIframeDoc.close();
      IEHH.DEPO = urlPart;
    },
  
    checkIframeContent: function(){
      var thisIframe        = document.getElementById("thisIframe"),
          thisIframContent  = thisIframe.contentWindow.document.body.innerHTML;

      if (window.location.href.match("#") && thisIframContent != "") {
        var thisArr = window.location.href.split("#"),
          thisUrlPart = ["#",thisArr[1]].join("");
        if (thisUrlPart != thisIframContent) {
          window.location.href = [thisArr[0],thisIframContent].join("");
        }
      }
    },
    
    constructor: function() {}
  }
},
  function(){}
);
