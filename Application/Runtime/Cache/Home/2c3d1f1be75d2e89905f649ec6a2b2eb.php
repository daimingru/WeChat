<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>小程序吉他谱交流</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <style>
      *{
        margin: 0;
        padding: 0;
      }
      html,body{
        height: 100%;
        overflow: hidden;
        background: #000;
      }

    </style>
</head>
<body>
<canvas id="canvas"></canvas>

<script>

  var canvas = {

    _can: document.getElementById("canvas"),

    init: function(){

      this.options = {
        ctx          : this._can.getContext('2d'),
        width        : document.body.offsetWidth,
        height       : document.body.offsetHeight,
        arcArray     : [],
        begin        : 0,
        length       : 500
      }
      canvas.Scale  = window.devicePixelRatio;
      this._can.style.width = this.options.width + "px";
      this._can.style.height = this.options.height + "px";
      this._can.width = this.options.width * canvas.Scale;
      this._can.height = this.options.height * canvas.Scale;
      this.drawFrame();

    },

    buildArc: function(){
      var _self = this;

      var options = {
        opacity: Math.random().toFixed(1),
        r: parseInt(20*Math.random()) * canvas.Scale,
        X: Math.floor(Math.random() * _self.options.width) * canvas.Scale,
        Y: Math.floor(Math.random() * _self.options.height) * canvas.Scale,
        R: Math.floor(Math.random() * 256) * canvas.Scale,
        G: Math.floor(Math.random() * 256) * canvas.Scale,
        B: Math.floor(Math.random() * 256) * canvas.Scale,
        Yx: -0.5 * canvas.Scale,
        Yy: -0.5 * canvas.Scale
      }
      if( options.X < _self._can.width/2 ){
        options.Yx = 0.5;
      }
      if( options.Y > _self._can.height/2 ){
        options.Yy = 0.5;
      }
      _self.options.arcArray.push(options);
      if(_self.options.arcArray.length > 300){
        _self.options.arcArray.shift();
      }
      for(var i = 0; i < _self.options.arcArray.length; i++ ){
        _self.options.arcArray[i].r += 0.5 * canvas.Scale;
        _self.options.arcArray[i].opacity -= 0.003 * canvas.Scale;
        _self.options.arcArray[i].X += _self.options.arcArray[i].Yx * canvas.Scale;
        _self.options.arcArray[i].Y -=_self.options.arcArray[i].Yy * canvas.Scale;
        // _self.options.arcArray[i].X += (Math.random());
        // _self.options.arcArray[i].Y += (Math.random());
        _self.options.ctx.beginPath();
        _self.options.ctx.arc(_self.options.arcArray[i].X, _self.options.arcArray[i].Y, _self.options.arcArray[i].r, 0, Math.PI*2, true);
        _self.options.ctx.fillStyle = "rgba(" + _self.options.arcArray[i].R + "," + _self.options.arcArray[i].G + "," + _self.options.arcArray[i].B + "," + _self.options.arcArray[i].opacity + ")";
        _self.options.ctx.fill();
      }


    },

    drawFrame:function(){
      canvas.options.ctx.clearRect(0, 0, canvas.options.width * canvas.Scale, canvas.options.height * canvas.Scale);
      window.requestAnimationFrame(canvas.drawFrame);
      canvas.buildArc();

    }
  }
  window.onload =function(){
    canvas.init();
  }

</script>
</body>

</html>