<style>
.gan {
  background: #000;
  color: #fff;
  width: 100px;
  height: 100px;
  position: absolute;
}

.gan2 {
  top: 300px;
  left: 700px;
  background: #c2c3c4;
  color: #fff;
  width: 100px;
  height: 100px;
  position: absolute;
}

.movela {
  transform: translate(600px, 400px);
  transition-duration: 5s;
}
</style>

<div class="gan">test</div>
<div class="gan2">test</div>

<script src="/javascript/jquery/jquery-1.10.2.min.js"></script>

<script>
$('.gan').on('click', function(e){
  //$(this).addClass('movela');

  var pos = $('.gan2').offset();
  console.log(pos);

  $(this).css({
    transform: 'translate(' + pos.left + 'px, ' + pos.top + 'px)',
    'transition-duration': '3s',
  });
});

</script>


