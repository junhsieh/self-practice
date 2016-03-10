$(document).ready(function(){
  // ======================================
  // Helper functions
  // ======================================
  // Get section by href
  function getRelatedContent(_element){
    return $($(_element).attr('href'));
  }

  // Get link by section id
  function getRelatedNavigation(_id){
    return $('#sticky-nav a[href=#' + _id + ']');
  }

  // ======================================
  // Smooth scroll to content
  // ======================================
  $('#sticky-nav a').on('click',function(event){
    event.preventDefault();

    var _screenHeightMiddle = (window.innerHeight / 2) - (getRelatedContent(this).height() / 2);

    $('html,body').animate({
      scrollTop: getRelatedContent(this).offset().top - _screenHeightMiddle,
    });
  });

  // ======================================
  // Sticky Navigation
  // ======================================
  new Waypoint.Sticky({
    element: $('#sticky-nav')[0],
    stuckClass: 'sticky-nav-stuck',
  });

  $(window).on('scroll', function (event) {
    var _scrollTop = $(this).scrollTop();

    if (_scrollTop >= 100 && _scrollTop < 200) {
      if (callCountS1 == 0) {
        ++callCountS1;
        setTimeout(fadeImage, 1000);
      }
    }
  });

  // ======================================
  // Creating Waypoint
  // ======================================
  $('.main-section').each(function(){
    // set a Waypoint when scrolling down.
    new Waypoint({
      element: $(this).get(0),
      handler: function(direction) {
        if (direction == 'down') {
          $('.sticky-nav-a').removeClass('sticky-nav-a-active');
          getRelatedNavigation(this.element.id).addClass('sticky-nav-a-active');
        }
      },
      offset: function() {
        // returning the bottom of the div when the div in the middle of the screen.
        return (window.innerHeight / 2) + (this.element.clientHeight / 2);
      },
    });

    // set a Waypoint when scrolling up.
    new Waypoint({
      element: $(this).get(0),
      handler: function(direction) {
        if (direction == 'up') {
          $('.sticky-nav-a').removeClass('sticky-nav-a-active');
          getRelatedNavigation(this.element.id).addClass('sticky-nav-a-active');
        }
      },
      offset: function() {
        // returning the top of the div when the div in the middle of the screen.
        return (window.innerHeight / 2) - (this.element.clientHeight / 2);
      },
    });
  });
});

