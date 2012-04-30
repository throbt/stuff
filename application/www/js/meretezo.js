function ablakMagassag()
{
    if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName.indexOf("Microsoft")!=-1)  return document.documentElement.clientHeight;
		else return window.innerHeight;
	}
}
function meretezo()
{
	var ref, div;
	ref = ablakMagassag()
	div = document.getElementById('alsodiv')
	if(ref > 400 + div.offsetHeight)  div.style.marginTop=(ref-(div.offsetHeight)-5)+'px'
	else div.style.marginTop='400px'
}
function meretezo2()
{
    var div = document.getElementById('lapdiv')
    var ref = ablakMagassag()
    if(div.offsetHeight < ref-70) div.style.minHeight=ref-70+'px'
}
