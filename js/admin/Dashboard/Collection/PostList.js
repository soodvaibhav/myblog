var Backbone = require('backbone');
var PostListModel = require('../Model/PostList');

module.exports = Backbone.Collection.extend({
    model: PostListModel,
    url: '/admin/post-list'
});
