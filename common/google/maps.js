var iconBlue = new GIcon(); 
iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
iconBlue.iconSize = new GSize(12, 20);
iconBlue.shadowSize = new GSize(22, 20);
iconBlue.iconAnchor = new GPoint(6, 20);
iconBlue.infoWindowAnchor = new GPoint(5, 1);

var iconRed = new GIcon(); 
iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
iconRed.iconSize = new GSize(12, 20);
iconRed.shadowSize = new GSize(22, 20);
iconRed.iconAnchor = new GPoint(6, 20);
iconRed.infoWindowAnchor = new GPoint(5, 1);

var customIcons = [];
customIcons["restaurant"] = iconBlue;
customIcons["bar"] = iconRed;

function load(lat,lng,name,address) {
  if (GBrowserIsCompatible()) {
    var map = new GMap2(document.getElementById("map"));
    map.addControl(new GSmallMapControl());
    map.addControl(new GMapTypeControl());
    map.setCenter(new GLatLng(lat, lng), 13);

var point = new GLatLng(parseFloat(lat), parseFloat(lng));
    var marker = createMarker(point, name, address, 'bar');
    map.addOverlay(marker);
  }
}

function createMarker(point, name, address, type) {
  var marker = new GMarker(point, customIcons[type]);
  var html = "<b>" + name + "</b> <br/>" + address;
  GEvent.addListener(marker, 'click', function() {
    marker.openInfoWindowHtml(html);
  });
  return marker;
}
