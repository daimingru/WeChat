// qpdetailed.js
var Follow = require('../../pages/components/follow/follow.js');
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    id:'',
    score: {}
  },

  /**
   * 图片预览
   */
  showImg: function (event) {
    var _index = event.currentTarget.dataset.index;
    var _self = this;
    wx.previewImage({
      current: _self.data.score.data[_index],
      urls: _self.data.score.data
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.setData({
      id: options.id
    });
    this.getImg(options.id);
  },

  /**
   * 生命周期函数--监听页面加载
   */
  getImg: function (id) {
    var _self = this;
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=WeChat&a=getImg&id=' + id,
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        _self.setData({
          score: res.data[0]
        });
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
  addFollow: function () {
    var _self = this;
    var data = JSON.stringify(_self.data.score);
    data = JSON.parse(data);
    Follow.isLogin({
      self: _self,
      data: data,
      type: 'score',
      id: _self.data.id
    });
  }

})
