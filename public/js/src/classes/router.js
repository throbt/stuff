/**
 * static class Router
 */
Ext.define('Router', {
  
  statics: {
  	
    frontPage 	      : "Main",
    login             : "Login",
    route             : "",
    routeOrders       : [],
    routeParams       : {},
    routeCache        : "",
    routeOrdersCache  : [],
    lang              : "",
    
    ENVIRONMENT       : 'devel', //production 
    
    init      	      : function() {
      
      try {
        console.log();
      }catch(e){
        if(e) {
          window.console      = {};
          window.console.log  = function() {}
        }
      };
      
      if(!Array.indexOf) {
        Array.prototype.indexOf = function(obj) {
          for(var i=0,l=this.length; i<l; i++) {
            if(this[i]==obj) {
              return i;
            }
          }
          return -1;
        }
      }
      
      Array.prototype.isEqual = function(arr) {
        if(this.length != arr.length)
          return false;
        for (var i = 0, l = this.length; i < l; i++) {
          if(this[i] != arr[i])
            return false;
        }
        return true;
      }
      
      if(Router.ie)
        IEHH.setup();
        
      Globals.profile = new ProfileController();
      
      Ext.TaskManager.start({
        run: Router.getRoute,
        interval: 2000
      });
    },
    
    getRoute  	: function() {
      
      var order = Router.getOrder(); //console.log(Router.routeOrders,Router.routeParams);
      
      Router.setLoader();
      
      if(order == "")
        Router.setRoute(Router.frontPage);
      
      // setting up the language
      if(Router.routeParams["lang"])
        Router.lang = Router.routeParams["lang"];
      else {
        if(Router.lang == "")
          Router.lang = "hu";
      }
      
      if(order != null)
        if(Router.route != order)
          if(typeof Globals.DEPO[[order,"Controller"].join("")] == "undefined" || Globals.DEPO[[order,"Controller"].join("")] == null) {
            
            try {
              
              // init and store(its ref) the relevant controller class
              (new Function(['Globals.DEPO["',order,'Controller"] = new ',order,'Controller();'].join("")))();
              
              // set history for ie
              if(Router.ie)
                IEHH.changeContent(["#",order].join(""));
              
              // hiding the previous content
              if(Ext.get(Router.route) != null)
                Ext.get(Router.route).hide();
              
              Router.route = order;
            } catch(err) { console.log(err);
              delete Globals.DEPO[order];
              Message.alert('Routing error', 'There is no implemented class with this namespace', function() {
                Router.setRoute(Router.frontPage);
              });
            }
          } else {
            Globals.DEPO[[order,'Controller'].join('')].init();
            Router.route = order;
          }
        else {
          if(Router.route != order) {
            if(Ext.get(Router.route)) {
              Ext.get(Router.route).hide();
            }
            if(Ext.get(order)) {
              Ext.get(order).show();
            }
            Globals.DEPO[[order,"Controller"].join('')].init();
            Router.route = order;
          }
        }
        
        // if the route has many parts and they are changing we drop the prompt to the root controller again
        if(!Router.routeOrders.isEqual(Router.routeOrdersCache)) { //console.log(Router.routeOrders,Router.routeOrdersCache);
          if(Router.routeOrders.length > 0)
            Globals.DEPO[[Router.routeOrders[0],"Controller"].join('')].init();
            
          //Router.routeOrders = Router.routeOrdersCache;
          Router.routeOrdersCache = Router.routeOrders;
        }
    },
    
    // its a simple redirect
    setRoute    : function(route) {
      window.location.href = [window.location.href.split("#")[0],"#",route].join("");
    },
    
    // reload on the same url
    reload: function() {
      window.location.reload(true)
    },
    
    setLoader: function() {
    
      var matches = (window.location.hash.match(/(.*)(\s)(.*)/) ? window.location.hash.match(/(.*)(\s)(.*)/) : null)
          steps   = ['|','/','--','\\'],
          index = -1;
          
      if(matches != null) {
        if(steps.indexOf(matches[3]) != -1) {
          index = steps.indexOf(matches[3]);
          if(index != -1) {
            if(index == 3)
              index = 0;
            else
              index += 1;
            window.location.href = [matches[1],' ',steps[index]].join('');
          }
        }
      } else {
        window.location.href = [window.location.href,' |'].join('')
      }
    },
    
    getOrder    : function() {
      if(Router.routeCache != window.location.href) {
        Router.routeOrders = [];
        Router.routeParams = {};
        var matches = (window.location.href.match(/(.#)(.*)/) ? window.location.href.match(/(.#)(.*)/) : null), hashes;
        if(matches == null) {
          Router.setRoute(Router.frontPage);
        } else {
          route = matches[2];
          
          if(window.location.hash.match(/(.*)(\s)(.*)/)) {
            // fuckin chromium
            route = route.split(' ')[0];
            // fuckin firefox
            route = route.split('%')[0];
          }
            
          if(route.match(/\//)) {
            var orders = route.split('/'), arr;
            for(var i = 0, len = orders.length;i < len; i++) {
              if(orders[i].match(/=/)) {
                arr = orders[i].split("=");
                Router.routeParams[arr[0]] = arr[1];
              } else {
                Router.routeOrders.push(orders[i]);
              }
            }
            route = Router.routeOrders[0];
          }
          Router.routeCache = window.location.href;
          return route;
        }
      } else {
        return Router.routeOrders[0];
      }
    },
    constructor: function() {}
  }

},
  function(){
    if(navigator.appVersion.match(/MSIE/))
      Router.ie = 1;
      
    /*
      this is the application init
    */
    Router.init();
  }
);
