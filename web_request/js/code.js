/** code.js
 *  This js file retrieves information from the browser, appends it to a string,
 *  then sends to a php handler as a gif request.
 *
 */

var Driver = function(){
              GifRequest.request({
                  //Set all parameters
                  'httpRefer': document.referrer,
                  'curretAddrs': document.URL,
                  'pluginDetails' : getPlugins(),
                  'timeZone' :  getTimeZone(),
                  'screenSize' : getScreenSize(),
                  'cookieEnabled' : getCookieEnabled(),
                  'systemFonts' : getSystemFonts()
                },
                function(){
                      alert('callback');
                });
}

/* getSystemFonts
 *
 *
 */
var getSystemFonts =  function(){
  var fonts = [];           /* Array of fonts to test again */
  var detected = ' ';       /* String fonts found to be in the system */
  var d = new Detector();

  // TODO: Add more fonts.
  fonts.push('Verdana');
  fonts.push('Arial');

  // Builds string of fonts in the system.
  for(var i = 0; i < fonts.lenght; i++){
    if( d.detect(fonts[i]) )
      detected = detected + fonts[i];
    else
      ;//Do nothing
  }

  return detected;
};

/**
 * JavaScript code to detect available availability of a
 * particular font in a browser using JavaScript and CSS.
 *
 * Author : Lalit Patel
 * Website: http://www.lalit.org/lab/javascript-css-font-detect/
 * License: Apache Software License 2.0
 *          http://www.apache.org/licenses/LICENSE-2.0
 * Version: 0.15 (21 Sep 2009)
 *          Changed comparision font to default from sans-default-default,
 *          as in FF3.0 font of child element didn't fallback
 *          to parent element if the font is missing.
 * Version: 0.2 (04 Mar 2012)
 *          Comparing font against all the 3 generic font families ie,
 *          'monospace', 'sans-serif' and 'sans'. If it doesn't match all 3
 *          then that font is 100% not available in the system
 * Version: 0.3 (24 Mar 2012)
 *          Replaced sans with serif in the list of baseFonts
 */

/**
 * Usage: d = new Detector();
 *        d.detect('font name');
 */
var Detector = function() {
    // a font will be compared against all the three default fonts.
    // and if it doesn't match all 3 then that font is not available.
    var baseFonts = ['monospace', 'sans-serif', 'serif'];

    //we use m or w because these two characters take up the maximum width.
    // And we use a LLi so that the same matching fonts can get separated
    var testString = "mmmmmmmmmmlli";

    //we test using 72px font size, we may use any size. I guess larger the better.
    var testSize = '72px';

    var h = document.getElementsByTagName("body")[0];

    // create a SPAN in the document to get the width of the text we use to test
    var s = document.createElement("span");
    s.style.fontSize = testSize;
    s.innerHTML = testString;
    var defaultWidth = {};
    var defaultHeight = {};
    for (var index in baseFonts) {
        //get the default width for the three base fonts
        s.style.fontFamily = baseFonts[index];
        h.appendChild(s);
        defaultWidth[baseFonts[index]] = s.offsetWidth; //width for the default font
        defaultHeight[baseFonts[index]] = s.offsetHeight; //height for the defualt font
        h.removeChild(s);
    }

    function detect(font) {
        var detected = false;
        for (var index in baseFonts) {
            s.style.fontFamily = font + ',' + baseFonts[index]; // name of the font along with the base font for fallback.
            h.appendChild(s);
            var matched = (s.offsetWidth != defaultWidth[baseFonts[index]] || s.offsetHeight != defaultHeight[baseFonts[index]]);
            h.removeChild(s);
            detected = detected || matched;
        }
        return detected;
    }

    this.detect = detect;
};

/* getCookieEnable
 * Returns 1 if cookies are enabled, and 0 if not.
 */
var getCookieEnable = function(){

  if( navigator.cookieEnabled ){
    return 1;
  } else
    return 0;

};

/* getScreenSize
 * Returns a string using the following format: height x widht x pixelDepth.
 */
var getScreenSize = function(){
  var height = screen.height;
  var width = screen.width;
  var pixel = screen.pixelDepth;

 return height + "x" + width + "x" + pixel;
}

/* getTimeZone
 * returns timezone of the browser.
 */
var getTimeZone = function(){
  var offset = new Date().getTimezoneOffset();

  return offset;
}


/* getPlugins
 * Returns a string contaning all plugins in the browser.
 */
var getPlugins = function(){
  var plugins = navigator.plugins;

  var plugin_list = ''; // text list of all the plugins.
  for(var i =0; i < plugins.length;i++){
    plugin_list += "plugin" + i + ":" + plugins[i].name;
  }

  return plugin_list;
};

/* GifRequest
 * Builds parameters, and sends appended informationa as a gif request to the server.
 */
var GifRequest = function(){
    var url_base = "";
    var gif_name = "__req.gif";

    var httpRefer;    // The refering http address.
    var currentAddrs; // The page the browser is currenlty on.

    function getParamString(param_arr){
        /**
        * This function creates the string to append to the gif. The last parameter is a timestamp,
        * this ensures that the request is made, preventing the browser from getting the gif from the cache
        */
        var param_str = "?";
        for(key in param_arr){
            param_str += key + "=" + param_arr[key] + "&";
        }

        param_str += "timestamp=" + getTimeStamp();
        alert(param_str);
        return param_str;
    }
    function getTimeStamp(){
      alert('getting timestamp');
        /**
        * Creates a timestamp string
        */
        var date = new Date();
        return ""+date.getFullYear() + date.getMonth() + date.getDate() + date.getHours() + date.getMinutes() + date.getSeconds();
    }
    return {
        request: function(params,callback){
            /**
             * Makes the gif request. Takes 2 parameters:
             * params: an associative array with the keys as parameter name, and the value as the parameter value
             * callback: function that's called when the image is loaded
             */
            alert('make a gif request');
            var req_img = new Image();
            req_img.src=url_base + gif_name + getParamString(params);
            if(callback){
                alert('gif request complete');
                req_img.onload = callback; 
            }
        }
    }
}();
