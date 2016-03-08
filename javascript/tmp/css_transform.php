<html>
  <head>
    <style>
    .sourceDiv {
      background: #000;
      color: #fff;
      width: 100px;
      height: 100px;
      position: absolute;
    }

    .destinationDiv {
      top: 300px;
      left: 700px;
      background: #c2c3c4;
      color: #fff;
      width: 100px;
      height: 100px;
      position: absolute;
    }

    .moveTo600x400 {
      transform: translate(600px, 400px);
      transition-duration: 5s;
    }
    </style>
    <script src="/javascript/jquery/jquery-1.10.2.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.sourceDiv').on('click', function(e){
          //$(this).addClass('moveTo600x400');

          var pos = $('.destinationDiv').offset();
          console.log(pos);

          $(this).css({
            transform: 'translate(' + pos.left + 'px, ' + pos.top + 'px)',
            'transition-duration': '3s',
          });
        });
      });
    </script>
  </head>
  <body>
    <div class="sourceDiv">test</div>
    <div class="destinationDiv">test</div>
  </body>
</html>
