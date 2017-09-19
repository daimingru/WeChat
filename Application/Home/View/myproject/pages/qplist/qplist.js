// qplist.js
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    title: '1',
    list: [
      {
        name: '',
        author: '',
        time: '',
        id: ''
      }
    ]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getList(options.id);
  },

  /**
   * 获取列表
   */
  getList: function(id){
    var _self = this;
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=WeChat&a=getScorelist&id=' + id,
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        _self.setData({
          list: res.data.data,
          title: res.data.title
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

  }
})
