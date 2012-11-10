var Grid = (function() {
	var init = function(arr) {
		if(arr.length > 1) {
			rebuild(arr);
		}
	};
	var rebuild = function(arr) {
		var els = [], thisParent = $(arr[0]).parent();
		for(var i=0,l=arr.length;i<l;++i) {
			els.push(arr[i]);
			//$(arr[i]).remove();
		}
		for(var i=0,l=els.length;i<l;++i) {
			//console.log();
		}
		console.log( thisParent );
	}; 
	return function() {
		init(this);
	};
})();