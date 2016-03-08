// Copyright 2013 William Malone (www.williammalone.com)
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//   http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
 
$( document ).ready(function() {
  var coin,
    coinImage,
    canvas;         

  function gameLoop () {
    window.requestAnimationFrame(gameLoop);

    coin.update();
    coin.render();
  }
  
  function sprite (options) {
    var that = {},
      frameIndex = 0,
      tickCount = 0,
      ticksPerFrame = options.ticksPerFrame || 0,
      numberOfFrames = options.numberOfFrames || 1;
    
    that.context = options.context;
    that.width = options.width;
    that.height = options.height;
    that.image = options.image;
    
    that.update = function () {
      tickCount += 1;

      if (tickCount > ticksPerFrame) {
        tickCount = 0;
        
        // If the current frame index is in range
        if (frameIndex < numberOfFrames - 1) {  
          // Go to the next frame
          frameIndex += 1;
        } else {
          frameIndex = 0;
        }
      }
    };
    
    that.render = function () {
      // Clear the canvas
      that.context.clearRect(0, 0, that.width, that.height);
      
      // Draw the animation
      /*
        The key to creating sprites from one image is that the context's drawImage method allows us to render a cropped section of the source image to the canvas.

        context.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh)

        img Source image object Sprite sheet
        sx  Source x  Frame index times frame width
        sy  Source y  0
        sw  Source width  Frame width
        sh  Source height Frame height
        dx  Destination x 0
        dy  Destination y 0
        dw  Destination width Frame width
        dh  Destination height  Frame height
      */
      that.context.drawImage(
        that.image,
        frameIndex * that.width / numberOfFrames,
        0,
        that.width / numberOfFrames,
        that.height,
        0,
        0,
        that.width / numberOfFrames,
        that.height);
    };
    
    return that;
  }
  
  // Get canvas
  //canvas = document.getElementById("coinAnimation");
  canvas = $('#coinAnimation').get(0);
  canvas.width = 100;
  canvas.height = 100;
  
  // Create sprite sheet
  coinImage = new Image();  
  coinImage.src = '/javascript/tmp/create-html5-canvas-javascript-sprite-animation/images/coin-sprite-animation.png';
  
  // Create sprite
  coin = sprite({
    context: canvas.getContext("2d"),
    width: 1000,
    height: 100,
    image: coinImage,
    numberOfFrames: 10,
    ticksPerFrame: 4
  });
  
  // Load sprite sheet
  //coinImage.addEventListener("load", gameLoop);
  $(coinImage).on('load', gameLoop);
});

