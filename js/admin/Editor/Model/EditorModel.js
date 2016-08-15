var Backbone = require('backbone');

var EditorModel = Backbone.Model.extend({
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

module.exports = new EditorModel();
