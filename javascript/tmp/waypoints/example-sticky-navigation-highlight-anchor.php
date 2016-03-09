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
    <script src="/javascript/tmp/waypoints/example-sticky-navigation-highlight-anchor.js"></script>
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

