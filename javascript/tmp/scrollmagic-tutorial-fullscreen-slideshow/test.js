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
      new ScrollMagic.Scene({
          triggerElement: this
      })
      .setPin(this)
      .addIndicators({
        colorStart: "rgba(0,0,0, 1)",
        colorEnd: "rgba(0,0,0, 1)", 
        colorTrigger : "rgba(0,0,0, 1)",
        name: $(this).attr('id'),
      })
      .addTo(ctrl);
   
  });
 
})(jQuery);
