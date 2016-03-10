//  Bind scroll to anchor links
$(document).on("click", "a[href^=#]", function(e) {
  // Init controller
  var controller = new ScrollMagic.Controller({
    globalSceneOptions: {
      duration: $('section').height(),
      triggerHook: .025,
      //offset: 200,
      reverse: true
    }
  });

  var scene1 = new ScrollMagic.Scene({ triggerElement: '#intro' })
                  .setClassToggle('#intro-anchor', 'active')
                  .addTo(controller);
  var scene2 = new ScrollMagic.Scene({ triggerElement: '#section-1' })
                  .setClassToggle('#anchor1', 'active')
                  .addTo(controller);
  var scene3 = new ScrollMagic.Scene({ triggerElement: '#section-2' })
                  .setClassToggle('#anchor2', 'active')
                  .addTo(controller);
  var scene4 = new ScrollMagic.Scene({ triggerElement: '#section-3' })
                  .setClassToggle('#anchor3', 'active')
                  .addTo(controller);
  var scene5 = new ScrollMagic.Scene({ triggerElement: '#section-4' })
                  .setClassToggle('#anchor4', 'active')
                  .addTo(controller);
  var scene6 = new ScrollMagic.Scene({ triggerElement: '#section-5' })
                  .setClassToggle('#anchor5', 'active')
                  .addTo(controller);

  // Change behaviour of controller
  // to animate scroll instead of jump
  controller.scrollTo(function(target) {

    TweenMax.to(window, 0.5, {
      scrollTo : {
        y : target,
        autoKill : true // Allow scroll position to change outside itself
      },
      ease : Cubic.easeInOut
    });

  });

  var id = $(this).attr("href");

  if($(id).length > 0) {
    e.preventDefault();

    // trigger scroll
    controller.scrollTo(id);

    // If supported by the browser we can also update the URL
    if (window.history && window.history.pushState) {
      history.pushState("", document.title, id);
    }
  }

});
