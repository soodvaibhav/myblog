var Backbone = require('backbone');

module.exports = Backbone.Model.extend({
  urlRoot: '/admin/post',

  defaults: {
    title: '',
    content: ''
  },

  validate: function(attrs, options) {
    if (attrs.title.length < 10) {
      return "Lord o Lord!! I Beg For Bigger Title.";
    }
  }
});
