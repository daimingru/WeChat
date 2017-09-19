// article.js
var WxParse = require('../../wxParse/wxParse.js');
var Follow = require('../../pages/components/follow/follow.js');
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    id:'',
    article: {
      title: '',
      author: '',
      time: '',
      count: '',
      flag: 1
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.setData({
      id: options.id
    });
    this.getArticle(options.id);
  },

  /**
   * 相册
   */
  wxParseImgTap: function (e) {
    var that = this
    WxParse.wxParseImgTap(e, that)
  },

  /**
   * 生命周期函数--监听页面加载
   */
  getArticle: function(id){
    var _self = this;
    wx.showLoading({
      title: '请稍等',
    })
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=WeChat&a=getArticle&id=' + id,
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        _self.setData({
          article: res.data
        });
        WxParse.wxParse('text', 'html', res.data.content, _self, 0);
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

  },

  /**
   * 绑定事件
   */
  addFollow: function (){
    var _self = this;
    var data = JSON.stringify(_self.data.article);
    data = JSON.parse(data);
    Follow.isLogin({
      self: _self,
      data: data,
      type: 'article',
      id: _self.data.id
    });
  }

})
