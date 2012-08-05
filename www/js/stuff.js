var decodeThis = function(str) {
  return decodeURIComponent(str.replace(/\+/g, ' ').replace(/%2B/g, '+'));
}
