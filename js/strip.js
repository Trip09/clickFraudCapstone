/* ==========================================================================
 * Strip.js 
 * Retreives HTTP Refer information from client pages, and outputs a server request.
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

  // Retreive additional header information
  var req = new XMLHttpRequest();
  req.open('GET', document.location, false);
  req.send(null);
  var headers = req.getAllResponseHeaders().toLowerCase();

  //Retrieve Geolocation
  if (window.XMLHttpRequest){
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function() {
   if (xmlhttp.readyState==4 && xmlhttp.status==200) {
     // Code executes only after request is finished.
     alert(xmlhttp.responseText);
    }
  }
  xmlhttp.open("GET","http://freegeoip.net/json/",true);
  xmlhttp.send();

  // Create a JSON Object with all http header information.
  var JSON_Pageview = {"httpStrip:": [
        {"userID": this.id, "origin": origin, "current": current,},
    ]
  };

  alert(JSON.stringify(JSON_Pageview));
  return JSON_Pageview;
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
  var jsonData = this.model.httpStrip();

  //TODO: Create a XMLHttpRequest Object (takes care of the server communication in the back for us).

  alert("push() called");
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

