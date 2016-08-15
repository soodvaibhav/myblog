var Backbone = require('backbone');
var EditorView = require('./Editor/View/EditorView');
var EditorModel = require('./Editor/Model/EditorModel');

module.exports = Backbone.Router.extend({
  routes: {
    '': 'adminHome',
    'new': 'showEditor'
  },

  adminHome: function() {
      EditorModel.set({'title': 'hello', 'content': '<p>Byeeee</p>'})
      new EditorView({model: EditorModel});
  },

  showEditor: function() {
    new EditorView({model: EditorModel});
  }
});
