var content = {
    init: function(){
        this.initH5Player();
    },
    initH5Player: function(){
        var oBtn = document.getElementById('btn');
        var isTouchSupported = 'ontouchstart' in window;
        var tap = isTouchSupported ? 'touchstart' : 'click';
        var start = isTouchSupported ? 'touchstart' : 'mousedown';
        var move = isTouchSupported ? 'touchmove' : 'mousemove';
        var end = isTouchSupported ? 'touchend' : 'mouseup';
        var oAudio = document.getElementById('audio');
        var oFan = document.getElementById('fan');
        var oPlay = document.getElementById('icon-play');
        var oPause = document.getElementById('icon-pause');
        var oRange = document.getElementById('range');
        var oTrack = document.getElementById('track');
        var oIndicator = document.getElementById('indicator');
        var oCurrent = document.getElementById('current');
        var duration = dto.duration;
        var status = 'paused';
        var disX = oIndicator.offsetParent.offsetLeft;
        var w = oIndicator.offsetParent.offsetWidth;
        var iW = oIndicator.offsetWidth;
        var tW = w - iW;

        if(isIOS()){
            cssPlay();
        }else{
            if(oAudio.readyState == 4){
                audioLoaded();
            }else{
                oAudio.addEventListener('canplaythrough',audioLoaded,false);
            }
        }


        //播放按钮
        oBtn.addEventListener(tap, function() {
            if(isIOS() && oAudio.readyState != 4){
                cssloading();
            }

            if (status == 'paused') {
                oAudio.play();
                status = 'playing';
                oPlay.style.display = 'none';
                oPause.style.display = 'block';
                duration = oAudio.duration;
            } else {
                oAudio.pause();
                status = 'paused';
                oPlay.style.display = 'block';
                oPause.style.display = 'none';
            }

        }, false);

        //进度条
        oIndicator.addEventListener(start,function(){
            document.addEventListener(move,touchmove,false);
            document.addEventListener(end,touchend,false);
            function touchmove(ev){
                ev.preventDefault();
                var x = ev.touches ? ev.touches[0].pageX : ev.pageX;
                var left = x - disX;
                var val = Math.max(left,0);
                val = Math.min(tW,val);
                var currentTime = duration * val / tW;
                if(currentTime == 0){
                    val = 0;
                }
                updateProcess(val,currentTime);
                oAudio.currentTime = currentTime;
            }

            function touchend(ev){
                document.removeEventListener(move,touchmove,false);
                document.removeEventListener(end,touchend,false);
            }

        },false);

        //播放时
        oAudio.addEventListener('timeupdate', function() {
            if(isIOS() && oAudio.readyState == 4){
                if(oFan.style.display == 'block'){
                    cssPlay();
                }
            }
            var ratio = oAudio.currentTime / duration;
            var val = tW * ratio;
            updateProcess(val,oAudio.currentTime);
        }, false);

        //播放结束
        oAudio.addEventListener('ended', function() {
            reset();
        }, false);

        window.addEventListener('beforeunload', function(event) {
            window.localStorage.setItem(dto.storageId + 'current',oAudio.currentTime);
        });

        function updateProcess(val,currentTime){
            oIndicator.style.left = val + 'px';
            oTrack.style.width = val + 'px';
            oCurrent.textContent = format(currentTime);
        }

        function audioLoaded(){
            cssPlay();
            oAudio.removeEventListener('canplaythrough',audioLoaded,false);
            if(currentTime = window.localStorage.getItem(dto.storageId + 'current')){
                oAudio.currentTime = currentTime;
                updateProcess(tW * currentTime / duration,currentTime);
            }
        }

        function cssloading(){
            oFan.style.display = 'block';
            document.querySelector('.button').style.backgroundColor = '#fff';
        }

        function cssPlay(){
            oFan.style.display = 'none';
            document.querySelector('.button').style.backgroundColor = '#3872cd';
        }

        function reset() {
            status = 'paused';
            oPlay.style.display = 'block';
            oPause.style.display = 'none';
            updateProcess(0,0);
        }

        function format(seconds){
            seconds = Math.round(seconds);
            var m = Math.floor(seconds / 60) || 0;
            var s = seconds % 60 || 0;
            return '已播放' + m + '分' + s + '秒';
        }

        function isIOS(){
            return /IOS|iPad|iPhone|iPod/i.test(navigator.userAgent) && !window.MSStream
        }

    }

}
