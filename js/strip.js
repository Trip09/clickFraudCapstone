/* strip.js
 *
 *  Description: A lightweight script to retreive browser, time spent on pagr, and HTTP refer information.
 */


/* StripController
 *
 */

var StripController = function(){
  return this;
}

StripController.prototype.execute = function ( ) {
  alert("hello, world");

  // TODO: Decide on model to hold retreived information,
  // create an extra function to handle the several kinds of
  // retrieval necessary. Need an interface for this so the code remains clean
  // and we can easily change how this is being done, and reuse.
  // -> Need to keep in mind this information will most likely be
  // concatenated in JSON pairs and send over to the server-side
  // (dabatase).
  // -> data needs to be sanitized, don't imagine it would be too
  // hard to fake http refers and make a mess of our data somehow
  // hopefully no drop tables!
  console.log(" Referrer: " + document.referrer);
}


/* bootstrap() - Initializes code, calls controller.
 *
 */
function bootstrap(){
  var strip = new StripController;
  strip.execute();
}

bootstrap();
