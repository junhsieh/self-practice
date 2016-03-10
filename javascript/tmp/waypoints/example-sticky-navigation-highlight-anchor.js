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

  $(window).on('scroll', function (event) {
    var _scrollTop = $(this).scrollTop();

    console.log(_scrollTop);
  });

  // ======================================
  // Sticky Navigation
  // ======================================
  new Waypoint.Sticky({
    element: $('#sticky-nav')[0],
    stuckClass: 'sticky-nav-stuck',
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
        // when the div hits 3 / 4 of its middle position.
        return (window.innerHeight / 2) - (this.element.clientHeight / 4);
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
        // when the div hits 1 / 4 above its middle position.
        return (window.innerHeight / 2) - (this.element.clientHeight / 4) * 3;
      },
    });
  });
});

