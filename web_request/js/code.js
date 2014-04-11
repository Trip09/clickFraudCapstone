/** code.js
 *  This js file retrieves information from the browser, appends it to a string,
 *  then sends to a php handler as a gif request.
 *
 *  TODO: Missing information: System Fonts, Cookies Enables, Supercookie?
 */

var Driver = function(){
              GifRequest.request({
                  //Set all parameters
                  'httpRefer': document.referrer,
                  'curretAddrs': document.URL,
                  'pluginDetails' : getPlugins(),
                  'timeZone' : getTimeZone(),
                  'screenSize' getScreenSize()
                },
                function(){
                      alert('callback');
                });

}

var getScreenSize = function(){
  var height = screen.height;
  var width = screen.width;
  var pixel = creen.pixelDepth;

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
  var plugin_list; // text list of all the plugins.

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
