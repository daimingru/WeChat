// personal.js
var Login = require('../../pages/components/login/login.js');
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    userInfo:{
      nickName: '请登录',
      avatarUrl: 'https://www.aparesse.com/Public/images/qp1.jpg',
    },
    headbg: 'background: #eee'
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getInfo();
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 获取用户信息
   */

  getInfo: function(){
    var _self = this;
    var value = wx.getStorageSync('userinfo');
    if(!value){
      
      Login.Login({
        success: function(res){
          _self.setData({
            userInfo: res.userInfo,
            headbg: 'background:url(' + res.userInfo.avatarUrl + ');background-size:cover;'
          })
        }
      });
    }else{
      _self.setData({
        userInfo: value.userInfo,
        headbg: 'background:url(' + value.userInfo.avatarUrl + ');background-size:cover;'
      })

    }

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})
