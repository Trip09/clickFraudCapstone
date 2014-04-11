/* ==========================================================================
 * Strip.js 
 * Retreives HTTP Refer information from client pages, and outputs a server request.
 *
 * -> Please look at TODO
 *
 * -> Information Missing
 *    Browser information (the kind of browser it is eg. firefox, etc)
 * ========================================================================== */


/*
 * Pageview
 * Holds the date for each page view request
 * - id is the userID whose website the request is coming from.
 * - httpStrip retrives all header information.
 */
var Pageview = function ( data) {
  this.id = data;

  return this;
};

Pageview.prototype.httpStrip = function() {
  var origin =  document.referrer;
  var current = document.URL;
  var data = [];

  // Retreive additional header information
  var req = new XMLHttpRequest();
  req.open('GET', document.location, false);
  req.send(null);
  var headers = req.getAllResponseHeaders().toLowerCase();

  // Create a JSON Object with all http header information.
  var JSON_Pageview = {"userID": this.id, "origin": origin, "current": current};
  data.push(JSON_Pageview);

  //Retrieve Geolocation + IP
  if (window.XMLHttpRequest){
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() { /* executed upon receive of the request */
   if (xmlhttp.readyState==4 && xmlhttp.status==200) {
     var GeoJSON = JSON.parse( xmlhttp.responseText );

     data.push(GeoJSON);
     return data; /* what happens when request fails? */
   } else {
    // append request timeout?

   }
  }
  xmlhttp.open("GET","http://freegeoip.net/json/",true);
  xmlhttp.send();

  return data;
};


/*
 * View
 * outputs information to a server
 */
var ViewStrip = function ( model ) {
  this.model = model;
  return this;
};

ViewStrip.prototype.push = function () {

  /* jsonData is a json formatted array.
   * json[0] -> httpRefer headers
   * json[1] -> IP + Geolocation information
   * TODO: Make this onto a single list
   */
  var jsonData = this.model.httpStrip();
  
  alert("push() called : data");
  console.log(jsonData);
};


/*
 * Controller
 */
var Strip = function () {
  return this;
};

Strip.prototype.TrackView = function ( id ) {
  // Set id for user request, and performs HTTP Header strip.
  var model = new Pageview( id );
  var view = new ViewStrip(model);

  // Push information to the server
  view.push();
};

