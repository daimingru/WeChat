var Login = require('../login/login.js');
var Config = require('../../../Conf.js');
var Follow = {
  //添加收藏
  addFollow: function(options){
    var _self = this;
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=User&a=collectorWrite',
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      method: 'POST',
      data: options,
      success: function (res) {
        wx.showToast({
          title: res.data.msg == 1 ? '收藏成功' : '取消成功',
          duration: 1800
        })
        options.data.flag = res.data.msg;
        var porpData = {};
        porpData[options.type] = options.data;
        options.self.setData(porpData);
      }
    })
  },

  //判断登录
  isLogin: function (options) {
    var _self = this;
    var value = wx.getStorageSync('userinfoa');
    if (!value) {
      Login.Login({
        success: function (res) {
          _self.addFollow(options);
        }
      });
    } else {
      _self.addFollow(options)
    }
  }
}

module.exports = Follow;
