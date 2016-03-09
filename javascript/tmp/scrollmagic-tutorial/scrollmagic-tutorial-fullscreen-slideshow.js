/* Using jQuery */
(function($) {
  // Init ScrollMagic
  var ctrl = new ScrollMagic.Controller({
    globalSceneOptions: {
      triggerHook: 'onLeave'
    }
  });

  // Create scene
  $("section").each(function() {
    if ($(this).attr('id') == "four") {
      return true;
    }

    new ScrollMagic.Scene({
      triggerElement: this,
      duration: 0,
    })
    .setPin(this)
    .addIndicators({
      colorStart: "rgba(0,0,0, 1)",
      colorEnd: "rgba(0,0,0, 1)", 
      colorTrigger : "rgba(0,0,0, 1)",
      name: $(this).attr('id'),
    })
    //.loglevel(3)
    .addTo(ctrl);
  });

  // This means that section#four gets a class .is-active when the body is 300% or 3x window heights out of the viewport.
  // get window height
  var wh = window.innerHeight;
  new ScrollMagic.Scene({
    offset: wh*3,
  })
  .setClassToggle("section#four", "is-active")
  .addTo(ctrl);
 
})(jQuery);
