
var utils = require('../utils/utils.js');
var Config = require('../../../Conf.js');
//login
function Login(options) {
  var options = utils.extend({}, options);
  var _self = this;
    wx.login({
      success: function (code) {
        wx.getUserInfo({
          success: function (res) {
            var data = {
              userInfo: res.userInfo,
              headbg: 'background:url(' + res.userInfo.avatarUrl + ');background-size:cover;'
            }
            wx.request({
              url: Config.requestUrl + '/index.php?m=Home&c=User&a=saveInfo',
              header: {
                'content-type': 'application/x-www-form-urlencoded'
              },
              method: 'POST',
              data: {
                "userinfo": JSON.stringify(data.userInfo),
                "code": code.code
              },
              success: function (res) {
                wx.setStorage({
                  key: "userinfo",
                  data: data
                })
                typeof options.success === 'function' && options.success(data);
              }
            })
          }
        })
      }
    })
}
module.exports = {
  Login: Login
}
