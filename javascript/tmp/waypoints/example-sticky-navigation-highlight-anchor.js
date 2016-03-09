$(document).ready(function(){
  new Waypoint.Sticky({
    element: $('#basic-sticky-example')[0],
    stuckClass: 'stuck',
  });

  $('.mysection').each(function(){
    new Waypoint({
      element: $(this).get(0),
      handler: function(direction) {
        if (direction == 'down') {
          console.log('hit down');
          $('.mybutton').removeClass('active');
          getRelatedNavigation(this.element.id).addClass('active');
        }
      },
      offset: function() {
        // returning the bottom of the div when it is in the middle of the screen.
        return (window.innerHeight / 2) + (this.element.clientHeight / 2);
      },
    });

    new Waypoint({
      element: $(this).get(0),
      handler: function(direction) {
        if (direction == 'up') {
          console.log('hit up');
          $('.mybutton').removeClass('active');
          getRelatedNavigation(this.element.id).addClass('active');
        }
      },
      offset: function() {
        // returning the top of the div when it is in the middle of the screen.
        return (window.innerHeight / 2) - (this.element.clientHeight / 2);
      },
    });
  });


  // ======================================
  // Helper functions
  // ======================================
  // Get section or article by href
  function getRelatedContent(_element){
    return $($(_element).attr('href'));
  }

  // Get link by section or article id
  function getRelatedNavigation(_id){
    return $('nav a[href=#' + _id + ']');
  }

  // ======================================
  // Smooth scroll to content
  // ======================================
  $('nav a').on('click',function(event){
    event.preventDefault();

    var _screenHeightMiddle = (window.innerHeight / 2) - (getRelatedContent(this).height() / 2);

    $('html,body').animate({
      scrollTop: getRelatedContent(this).offset().top - _screenHeightMiddle,
    });
  });
});

