// guide.js
var utils = require('../../pages/components/utils/utils.js');
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgUrls: [
      'https://www.aparesse.com/Public/images/bg1.jpg',
      'https://www.aparesse.com/Public/images/bg2.jpg',
      'https://www.aparesse.com/Public/images/bg3.jpg'
    ],
    article:[]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function () {
    var _self = this;
    wx.showLoading({
      title: '正在加载',
    })
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=WeChat&a=index',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        res.data = utils.replaceHtml(res.data);
        _self.setData({
          article: res.data
        });
      },
      complete: function (res) {
        wx.showToast({
          title: '请检查网络',
        })
        wx.hideLoading()
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

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
