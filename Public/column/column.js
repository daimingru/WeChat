var column = {


    init: function(data){
        this.data = data;
        this.bindEvent();
    },


    bindEvent: function(){
        
        this.cont = document.getElementsByClassName('tab-child');
        this.child = document.getElementsByClassName('nav')[0].getElementsByTagName('span');
        document.getElementsByClassName('nav')[0].addEventListener("touchstart",function(e){
            column.tabChange(e);
        },false)
        var _dom = document.getElementsByClassName('list');
        for( var i= 0 ; i<_dom.length; i++){
            
            _dom[i].onclick = function(){
                column.jumpHref(this.getAttribute('data-id'));
            }
        }
    },


    tabChange: function(e){
        
        e.target = e.target || e.srcElement;
        
        if( e.srcElement.tagName.toLowerCase() == "span" ){
            
            var target = e.target;

            for(var i = 0; i < column.child.length; i++ ){
                if( column.child[i] == target ){
                    e.target.className = "select";
                    column.showTabChild(i);
                }else{
                    column.child[i].className = "";
                }
            }
        }
    },
    
    jumpHref: function(id){
        
        var json = {"talkId":id,"topicId":column.data.expertTopic.topicId,"title":column.data.expertTopic.title};
        json = JSON.stringify(json);
        
        if( this.IsIos() ){
       //列表页

            Okayjiaoyu.SendMessageAndInfo(1200, json, "");
        }else{
            
            okay.sendMessage(1200, json, "");
        }
    },


    showTabChild: function(index){
        for(var i = 0; i < column.cont.length; i++ ){
            if( index == i ){
                column.cont[i].className = column.cont[i].className.replace(/ show/, "");
                column.cont[i].className = column.cont[i].className + ' show';
            }else{
                column.cont[i].className = column.cont[i].className.replace(/ show/, "");
            }
        }
    },
    
    IsIos: function(){
        return /IOS|iPad|iPhone|iPod/i.test(window.navigator.userAgent)? true : false;
    }
    
}
