//utils
module.exports = {
  extend: function(arg1,arg2){
    for (var key in arg2) {
      arg1[key] = arg2[key];
    }
    return arg1;
  },

  copyObj: function(obj){
    if(typeof obj == "object"){
      var obj = JSON.stringify(obj);
      obj = JSON.parse(obj);
      return obj;
    }else{
      throw new Error("please send in the correct object!");
    }
  },

  replaceHtml: function(str){
    for (var i = 0; i < str.length; i++) {
      str[i].content = str[i].content.replace(/<[^>]+>/g, "");
    }
    return str;
  }
}