var column = {


    init: function(data){
        this.data = data;
        this.bindEvent();
    },


    bindEvent: function(){
        
        document.getElementsByClassName('subscribe')[0].addEventListener("touchstart",function(e){
            column.sendMessageSubscribe(e);
        },false);

        document.getElementsByClassName('share')[0].addEventListener("touchstart",function(e){
            column.sendMessageShare(e);
        },false);

    },

    sendMessageSubscribe: function(e){
        if( this.IsIos ){
            Okayjiaoyu.SendMessageAndInfo(1201, _self.id, "");
        }else{
            okayJiaoYu.sendMessage(1201, _self.id, "");
        }
    },

    sendMessageShare: function(e){

        var url = 'https://www.baidu.com/';

        var str = {
            title: column.data.expertTopic.title,
            describe: '教你一招让孩子不用熬夜就能快速进步！',
            imgurl: 'https://hd.okjiaoyu.cn/title712.png ',
            url: url
        }

        if( this.IsIos() ){
            Okayjiaoyu.SendMessageAndInfo(1005, JSON.stringify(str), "");
        }else{
            okayJiaoYu.sendMessage(1005, JSON.stringify(str), "");
        }

    },

    IsIos: function(){
        return /IOS|iPad|iPhone|iPod/i.test(window.navigator.userAgent)? true : false;
    },

}
