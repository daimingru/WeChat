// collectlist.js
var utils = require('../../pages/components/utils/utils.js');
var Config = require('../../Conf.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tabData: {
      selected: true
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getList();
  },

  /**
   * 获取列表
   */
  getList: function () {
    var _self = this;
    wx.request({
      url: Config.requestUrl + '/index.php?m=Home&c=User&a=getCollect',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        res.data.recommend = utils.replaceHtml(res.data.recommend);
        _self.setData({
          list: res.data.score,
          article: res.data.recommend
        });
      }
    })
  },

  /**
   * 改变tab
   */
  Changetap: function (event) {
    var data = utils.copyObj(this.data.tabData);
    data.selected = !!parseInt(event.target.dataset.flag);
    this.setData({
      tabData: data
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
