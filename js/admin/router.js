var Backbone = require('backbone');
var EditorView = require('./Editor/View/EditorView');
var EditorModel = require('./Editor/Model/EditorModel');
var PostsTableView = require('./Dashboard/View/PostsTable');
var PostList = require('./Dashboard/Collection/PostList');

module.exports = Backbone.Router.extend({
    routes: {
        'new': 'showEditor',
        '(:page)': 'adminHome',
        'edit/:id': 'editPost'
    },

    adminHome: function(page) {
        if (null === page) {
            page = 1;
        }
        var postList = new PostList();
        this.loadView(new PostsTableView({ collection: postList }));
        postList.fetch({
            reset: true,
            data: {
                page: page
            }
        });
    },

    showEditor: function() {
        var editorModel = new EditorModel();
        this.loadView(new EditorView({ model: editorModel }));
    },

    editPost: function(id) {
        var editorModel = new EditorModel({id: id});
        this.loadView(new EditorView({ model: editorModel }));
        editorModel.fetch();
    },

    loadView : function(view) {
        this.view && this.view.remove();
        this.view = view;
    }
});
