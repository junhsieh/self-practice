<html>
  <head>
    <style>
.stuck {
  position:fixed;
  height: 50px !important;
  top:0;
}

.mybutton {
  width: 100px;
  height: 30px;
  display: inline-block;
  background: red;
}

.mysection {
  width: 100%;
  height: 500px;
  border: 1px solid #000;
}

ul.myul li {
  display: inline-block;
}

.active {
  background: yellow;
}

    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/javascript/tmp/waypoints/jquery.waypoints.js"></script>
    <script src="/javascript/tmp/waypoints/shortcuts/sticky.js"></script>
    <script src="/javascript/tmp/waypoints/shortcuts/inview.js"></script>
    <script>
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
    </script>
  </head>
  <body>
    <div style="width: 100%; height: 500px; background: yellow;">
    </div>

    <div id="basic-sticky-example" style="width: 100%; height: 50px; background: green;">
      <nav role="navigation" id="nav">
        <ul class="myul">
          <li><a href="#A1" class="mybutton">Article A1</a></li>
          <li><a href="#A2" class="mybutton">Aritcle A2</a></li>
          <li><a href="#A3" class="mybutton">Aritcle A3</a></li>
          <li><a href="#A4" class="mybutton">Aritcle A4</a></li>
        </ul>
      </nav>
    </div>

    <main>
      <article id="A1" class="mysection">1</article>
      <article id="A2" class="mysection">2</article>
      <article id="A3" class="mysection">3</article>
      <article id="A4" class="mysection">4</article>
    </main>

    <div style="width: 100%; height: 300px;">
    </div>
  </body>
</html>

