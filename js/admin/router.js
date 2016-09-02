var Backbone = require('backbone');
var EditorView = require('./Editor/View/EditorView');
var EditorModel = require('./Editor/Model/EditorModel');

module.exports = Backbone.Router.extend({
    routes: {
        '': 'adminHome',
        'new': 'showEditor'
    },

    adminHome: function() {

    },

    showEditor: function() {
        var editorModel = new EditorModel();
        this.loadView(new EditorView({model: editorModel}));
    },

    loadView : function(view) {
        this.view && this.view.remove();
        this.view = view;
    }
});
